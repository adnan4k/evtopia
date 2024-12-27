@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            <i class="fa-solid fa-shop"></i> {{__('Add New Post')}}
        </div>
    </div>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mt-3">
            <div class="card-body">

                <div class="">
                    <x-input label="Post Title" name="title" type="text" placeholder="Enter Post Title"
                        required="true" />
                </div>

                <div class="mt-3">
                    <label for="">
                        {{__('Short Description')}}
                        <span class="text-danger">*</span>
                    </label>
                    <textarea required name="short_description" class="form-control @error('short_description') is-invalid @enderror"
                        rows="2" placeholder="Enter short description">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <p class="text text-danger m-0">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="">
                        {{__('Description')}}
                        <span class="text-danger">*</span>
                    </label>
                    <div id="editor">
                        {!! old('description') !!}
                    </div>
                    <input type="hidden" id="description" name="description" value="{{ old('description') }}">
                    @error('description')
                        <p class="text text-danger m-0">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!--######## General Information ##########-->
        <div class="card mt-4">
            <div class="card-body">

                <div class="row mt-3">
                    <div class="col-md-6 col-lg-6">
                        <label class="form-label">
                            {{ __('Select Category') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="post_category[]" class="form-control select2"
                            style="width: 100%" multiple>
                            <option value=""  disabled>
                                {{ __('Select Category') }}
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <label class="form-label">
                            {{ __('Add Tags') }}
                        </label>
                        <select name="tags[]" class="form-control select2"
                            style="width: 100%" multiple>
                          
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                            <p class="text text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <label class="form-label">
                    {{ __('Add to Knowledge Hub') }}
                </label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="addToKnowledgeHub" name="add_to_knowledge_hub" value="1">
                    <label class="form-check-label" for="addToKnowledgeHub">{{ __('Check to include in Knowledge Hub') }}</label>
                </div>
                
                <!-- Additional Fields for Resources -->
                <div id="knowledgeHubFields" class="mt-3" style="display: none;">
                    <label>{{ __('Add Resources') }}</label>
                    <div class="mb-3">
                        <label for="pdf" class="form-label">{{ __('Upload PDF') }}</label> 
                        <input type="file" class="form-control" name="pdf[]" id="pdf" accept="application/pdf" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">{{ __('Upload Images') }}</label>
                        <input type="file" class="form-control" name="images[]" id="images" accept="image/*" multiple>
                        <!-- Thumbnail Preview -->
                        <div id="thumbnailPreview" class="d-flex flex-wrap mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Videos') }}</label>
                        <ul class="list-group">
                            {{-- <li class="list-group-item">
                                <label for="videoFile" class="form-label">{{ __('Upload Video') }}</label>
                                <input type="file" class="form-control" name="video_file[]" id="videoFile" accept="video/*" multiple>
                            </li> --}}
                            <li class="list-group-item">
                                <label for="videoLinkInput" class="form-label">{{ __('Add Video Links') }}</label>
                                <input type="text" class="form-control" id="videoLinkInput" placeholder="https://example.com/video">
                                <ul id="videoLinksList" class="list-group mt-2"></ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--######## Thumbnail Information ##########-->
        <div class="row mb-3">
            <div class="col-md-5 col-xl-3">
                <div class="card card-body h-100">
                    <div class="mb-2">
                        <h5>
                            {{ __('Thumbnail') }}
                            <span class="text-primary">(Ratio 1:1 (500 x 500 px)</span>
                            <span class="text-danger">*</span>
                        </h5>
                        @error('thumbnail')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="thumbnail" class="additionThumbnail">
                        <img src="https://placehold.co/500x500/f1f5f9/png" id="preview" alt="" width="100%">
                    </label>
                    <input id="thumbnail" accept="image/*" type="file" name="thumbnail" class="d-none" onchange="previewFile(event, 'preview')">
                </div>
            </div>

        </div>


        

        <div class="d-flex gap-3 justify-content-end align-items-center mb-3">
            <button type="reset" class="btn btn-lg btn-outline-secondary rounded py-2">
                {{ __('Reset') }}
            </button>
            <button type="submit" class="btn btn-lg btn-primary rounded py-2 px-5">
                {{ __('Submit') }}
            </button>
        </div>

    </form>
@endsection
@push('scripts')

<!-- Thumbnail Preview Section -->
<div id="thumbnailPreview" class="d-flex flex-wrap mt-2"></div>

<style>
    #thumbnailPreview {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .thumbnail-wrapper {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .thumbnail-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .thumbnail-wrapper .delete-icon {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<script>
     document.addEventListener('DOMContentLoaded', function() {
        const knowledgeHubCheckbox = document.getElementById('addToKnowledgeHub');
        const knowledgeHubFields = document.getElementById('knowledgeHubFields');

        knowledgeHubCheckbox.addEventListener('change', function() {
            if (this.checked) {
                knowledgeHubFields.style.display = 'block';
            } else {
                knowledgeHubFields.style.display = 'none';
            }
        });
    });
    document.getElementById('videoLinkInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();

            const input = event.target;
            const link = input.value.trim();

            if (link) {
                const list = document.getElementById('videoLinksList');

                // Create a new list item
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                // Add the link text
                listItem.textContent = link;

                // Add a hidden input to submit the link value
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'video_links[]';
                hiddenInput.value = link;
                listItem.appendChild(hiddenInput);

                // Add a delete button
                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'btn btn-danger btn-sm';
                deleteBtn.innerHTML = '&times;';
                deleteBtn.onclick = function() {
                    list.removeChild(listItem);
                };
                listItem.appendChild(deleteBtn);

                // Add the new list item to the list
                list.prepend(listItem);

                // Clear the input field
                input.value = '';
            }
        }
    });
</script>

<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        thumbnailPreview.innerHTML = ''; // Clear existing previews

        const files = Array.from(event.target.files);

        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Create thumbnail wrapper
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('thumbnail-wrapper');
                    wrapper.dataset.index = index;

                    // Create image element
                    const img = document.createElement('img');
                    img.src = e.target.result;

                    // Create delete icon
                    const deleteIcon = document.createElement('div');
                    deleteIcon.classList.add('delete-icon');
                    deleteIcon.innerHTML = '&times;';
                    deleteIcon.addEventListener('click', () => {
                        wrapper.remove();
                    });

                    // Append image and delete icon to wrapper
                    wrapper.appendChild(img);
                    wrapper.appendChild(deleteIcon);

                    // Append wrapper to thumbnail preview container
                    thumbnailPreview.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>

    <script>

   
        $(document).ready(function() {
            $('.sizeSelector').select2();

            $('.sizeSelector').on('change', function() {

                // Get the selected options
                var selectedOptions = $(this).find(':selected');

                // Check if there are selected options
                if (selectedOptions.length > 0) {
                    $('#sizeBox').show();
                } else {
                    $('#sizeBox').hide();
                }

                selectedOptions.each(function() {
                    var sizeName = $(this).data('size');
                    var sizeId = $(this).val();

                    // Check if the row already exists
                    if (!$(`#selectedSizeRow_${sizeId}`).length) {
                        $('#selectedSizesTableBody').append(`
                        <tr id="selectedSizeRow_${sizeId}" style="display: table-row !important">
                            <td>
                                <h4>${sizeName}</h4>
                                <input type="hidden" name="size[${sizeId}][name]" value="${sizeName}">
                                <input type="hidden" name="size[${sizeId}][id]" value="${sizeId}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="size[${sizeId}][price]" value="0" style="max-width: 320px">
                            </td>
                        </tr>
                    `);
                    }
                });

                $(this).find(':not(:selected)').each(function() {
                    var sizeId = $(this).val();

                    // Remove the row from the table
                    $(`#selectedSizeRow_${sizeId}`).remove();
                });
            });

            $('select[name="category"]').on('change', function() {
                var categoryId = $(this).val();

                if (categoryId) {
                    $.ajax({
                        url: '/api/sub-categories?category_id=' + categoryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var subCategorySelect = $('select[name="sub_category[]"]');
                            subCategorySelect.empty();

                            $.each(data.data.sub_categories, function(key, value) {
                                subCategorySelect.append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                            subCategorySelect.trigger('change');
                        },
                        error: function() {
                            alert('Error retrieving subcategories. Please try again.');
                        }
                    });
                } else {
                    $('select[name="subCategory[]"]').empty();
                }
            });

        });
    </script>

    <!-- additional thumbnail script -->
    <script>
        var thumbnailCount = 1;

        const previewAdditionalFile = (event, id, removeId) => {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(id);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);

            // increment count
            thumbnailCount++;

            document.getElementById(removeId).style.display = 'block';

            // Create a new box dynamically
            const newThumbnailId = `additionThumbnail${thumbnailCount + 1}`;
            const newPreviewId = `preview${thumbnailCount + 1}`;
            const mainId = 'addition' + thumbnailCount + 1;

            // Add the new box
            const newThumbnailBox = document.createElement('div');
            newThumbnailBox.id = mainId;

            newThumbnailBox.innerHTML = `
            <label for="${newThumbnailId}" class="additionThumbnail">
                <img src="{{ asset('defualt/upload.png') }}" id="${newPreviewId}" alt="" width="100%" height="100%">
                <button onclick="removeThumbnail('${mainId}')" type="button" id="removeThumbnail${thumbnailCount + 1}" class="delete btn btn-sm btn-outline-danger" style="display: none"><i class="fa fa-trash"></i></button>
                <input id="${newThumbnailId}" accept="image/*" type="file" name="additionThumbnail[]" class="d-none" onchange="previewAdditionalFile(event, '${newPreviewId}', 'removeThumbnail${thumbnailCount +1 }')">
            </label>
        `;

            document.getElementById('additionalElements').appendChild(newThumbnailBox);

            // get current file
            var inputElement = event.target;
            var newOnchangeFunction = `previewFile(event, '${id}')`;
            // Set the new onchange attribute
            inputElement.setAttribute("onchange", newOnchangeFunction);

        }

        const removeThumbnail = (thumbnailId) => {
            const thumbnailToRemove = document.getElementById(thumbnailId);
            if (thumbnailToRemove) {
                thumbnailToRemove.parentNode.removeChild(thumbnailToRemove);
            }
        }

        const generateCode = () => {
            const code = document.getElementById('barcode');
            code.value = Math.floor(Math.random() * 900000) + 100000;
        }
    </script>

    <!-- color select2 script -->
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span class="d-flex align-items-center"> <span style="background-color:' + state.element.dataset
                .color +
                ';width:20px;height:20px;display:inline-block; border-radius:5px;margin-right:5px;"></span>' + state
                .text + '</span>'
            );
            return $state;
        };

        $(document).ready(function() {
            $('.colorSelect').select2({
                templateResult: formatState
            });
        });
    </script>

    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        'font': []
                    }],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'align': []
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    ['link', 'image', 'video', 'formula']
                ]
            }
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            document.getElementById('description').value = quill.root.innerHTML;
        });
    </script>
@endpush
