@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            <i class="fa-solid fa-shop"></i> {{__('Edit Post')}}
        </div>
    </div>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mt-3">
            <div class="card-body">

                <div class="">
                    <x-input label="Post Title" name="title" type="text" placeholder="Post Title"
                        required="true" value="{{ $post->title }}" />
                </div>

                <div class="mt-3">
                    <label for="">
                        {{ __('Short Description') }}
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="short_description" class="form-control" rows="2" placeholder="Short Description">{{ old('short_description') ?? $post->short_description }}</textarea>
                </div>

                <div class="mt-3">
                    <label for="">
                        {{ __('Description') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div id="editor">
                        {!! old('description') ?? $post->description !!}
                    </div>
                    <input type="hidden" id="description" name="description"
                        value="{{ old('description') ?? $post->description }}">
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
                           
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, $post->categories?->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="col-md-6 col-lg-6">
                        <label class="form-label">
                            {{ __('Select Tags') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="tags[]" class="form-control select2"
                            style="width: 100%" multiple>
                           
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $post->tags?->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tag')
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
                    <input type="checkbox" class="form-check-input" id="addToKnowledgeHub" name="add_to_knowledge_hub" value="1" {{ $post->add_to_knowledge_hub ? 'checked' : '' }}>
                    <label class="form-check-label" for="addToKnowledgeHub">{{ __('Check to include in Knowledge Hub') }}</label>
                </div>
        
                <!-- Additional Fields for Resources -->
                <div id="knowledgeHubFields" class="mt-3" style="{{ $post->add_to_knowledge_hub ? 'display: block;' : 'display: none;' }}">
                    <label>{{ __('Add Resources') }}</label>
                    
                    <!-- PDFs Section -->
                    <div class="mb-3">
                        <label for="pdf" class="form-label">{{ __('Upload PDF') }}</label> 
                        <input type="file" class="form-control" name="pdf[]" id="pdf" accept="application/pdf" multiple>
                        <div id="pdfPreview">
                            @foreach(json_decode($post->pdfs) as $pdf)
                                <div class="pdf-item position-relative">
                                    <!-- Make the PDF name clickable for download -->
                                    <a href="{{ asset('storage/' . $pdf->path) }}" class="pdf-name" download>
                                        {{ $pdf->name }}
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger btn-sm remove-pdf position-absolute top-0 end-0">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input type="hidden" name="pdfs[]" value="{{ $pdf->path }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
        
                    <!-- Images Section -->
                    <div class="mb-3">
                        <label for="images" class="form-label">{{ __('Upload Images') }}</label>
                        <input type="file" class="form-control" name="images[]" id="images" accept="image/*" multiple>
                        <div id="imagePreview" class="d-flex flex-wrap mt-2">
                            @foreach(json_decode($post->images) as $image)
                                <div class="thumbnail-wrapper position-relative">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->name }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                    <button type="button" class="btn btn-danger btn-sm remove-image position-absolute top-0 end-0"><i class="fa fa-trash"></i></button>
                                    <input type="hidden" name="images[]" value="{{ $image->path }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
        
                    <!-- Video Links Section -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('Video Links') }}</label>
                        <div id="videoLinks">
                            @php
                                $videoLinks = json_decode($post->video_links);
                            @endphp

                            @if(is_array($videoLinks) || is_object($videoLinks))
                            @foreach($videoLinks as $link)
                                <div class="video-link-item d-flex justify-content-between mb-2">
                                    <input type="text" class="form-control" name="video_links[]" value="{{ $link }}" placeholder="https://example.com/video">
                                    <button type="button" class="btn btn-danger btn-sm remove-video-link"><i class="fa fa-trash"></i></button>
                                </div>
                            @endforeach
                            @endif
                        </div>
                        <button type="button" id="addVideoLink" class="btn btn-secondary mt-2">Add Video Link</button>
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
                            <span class="text-primary">(Ratio 1:1 (500 x 500 px)</span> *
                        </h5>
                        @error('thumbnail')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="thumbnail" class="additionThumbnail">
                        <img src="{{ $post->thumbnail ?? asset('defualt/upload.png') }}" id="preview"
                            alt="" width="100%">
                    </label>
                    <input id="thumbnail" accept="image/*" type="file" name="thumbnail" class="d-none"
                        onchange="previewFile(event, 'preview')">
                </div>
            </div>

     
        </div>

        <div class="d-flex gap-3 justify-content-end align-items-center mb-3">
            <button type="reset" class="btn btn-lg btn-outline-secondary rounded py-2">
                {{ __('Reset') }}
            </button>
            <button type="submit" class="btn btn-lg btn-primary rounded py-2 px-5">
                {{ __('Update') }}
            </button>
        </div>

    </form>
@endsection
@push('scripts')

<style>

.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

.top-0 {
    top: 0;
}

.end-0 {
    right: 0;
}

.thumbnail-wrapper img {
    max-width: 100px;
    max-height: 100px;
}

.thumbnail-wrapper .remove-image,
.pdf-item .remove-pdf {
    background: transparent;
    border: none;
    color: red;
    cursor: pointer;
}

.remove-video-link {
    background: transparent;
    border: none;
    color: red;
    cursor: pointer;
}

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
    // Toggle visibility based on checkbox state
    document.getElementById('addToKnowledgeHub').addEventListener('change', function() {
        const knowledgeHubFields = document.getElementById('knowledgeHubFields');
        knowledgeHubFields.style.display = this.checked ? 'block' : 'none';
    });

    // Add new video link input field
    document.getElementById('addVideoLink').addEventListener('click', function() {
        const videoLinksDiv = document.getElementById('videoLinks');
        const newLinkDiv = document.createElement('div');
        newLinkDiv.classList.add('video-link-item');
        newLinkDiv.innerHTML = `
            <input type="text" class="form-control" name="video_links[]" placeholder="https://example.com/video">
            <button type="button" class="btn btn-danger btn-sm remove-video-link">Remove</button>
        `;
        videoLinksDiv.appendChild(newLinkDiv);

        // Add remove functionality for the new link
        newLinkDiv.querySelector('.remove-video-link').addEventListener('click', function() {
            videoLinksDiv.removeChild(newLinkDiv);
        });
    });

    // Remove PDF file
    document.querySelectorAll('.remove-pdf').forEach(button => {
        button.addEventListener('click', function() {
            const pdfItem = this.closest('.pdf-item');
            pdfItem.remove();
        });
    });

    // Remove image file
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function() {
            const imageWrapper = this.closest('.thumbnail-wrapper');
            imageWrapper.remove();
        });
    });

    // Remove video link
    document.querySelectorAll('.remove-video-link').forEach(button => {
        button.addEventListener('click', function() {
            const videoLinkItem = this.closest('.video-link-item');
            videoLinkItem.remove();
        });
    });
</script>
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

           var productName = $('input[name="name"]').val();

           var replace = productName.replace(/&amp;/g, '&');
           $('input[name="name"]').val(replace);

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

            // Get the category ID
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
