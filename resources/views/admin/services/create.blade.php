@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            <i class="fa-solid fa-shop"></i> {{__('Add New Service')}}
        </div>
    </div>
    <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mt-3">
            <div class="card-body">

                <div class="">
                    <x-input label="Service Name" name="name" type="text" placeholder="Enter Service Name"
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

                <div class="d-flex gap-2 border-bottom pb-2">
                    <i class="fa-solid fa-user"></i>
                    <h5>
                        {{ __('Generale Information') }}
                    </h5>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 col-lg-6">
                        <label class="form-label">
                            {{ __('Select Category') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="service_category" class="form-control select2"
                            style="width: 100%">
                            <option value="" selected disabled>
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

                    

                    <div class="col-md-6 col-lg-6 ">
                        <label class="form-label d-flex align-items-center gap-2 justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span>
                                    {{ __('Service Code') }}
                                    <span class="text-danger">*</span>
                                </span>
                                <span class="info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="{{__('Create a unique service code. This will be used generate barcode')}}">
                                    <i class="bi bi-info"></i>
                                </span>
                            </div>
                            <span class="text-primary cursor-pointer" onclick="generateCode()">
                                {{__('Generate Code')}}
                            </span>
                        </label>
                        <input type="text" id="barcode" name="code" placeholder="Ex: 134543" class="form-control"
                            value="{{ old('code') }}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                        @error('code')
                            <p class="text text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>

                

                </div>
            </div>
        </div>

        <!--######## Price Information ##########-->
        <div class="card mt-4 mb-4">
            <div class="card-body">

                <div class="d-flex gap-2 border-bottom pb-2">
                    <i class="fa-solid fa-user"></i>
                    <h5>
                        {{ __('Price Information') }}
                    </h5>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4 col-md-6">
                        <x-input type="text" name="price" label="Price" placeholder="Price" required="true" onlyNumber="true" value="0" />
                    </div>

                    <div class="col-lg-4 col-md-6  mt-md-0">
                        <x-input type="text" name="discount_price" label="Discount Price"
                            placeholder="Discount Price" onlyNumber="true" value="0" />
                    </div>

                    <div class="col-lg-4 col-md-6  mt-md-0">
                        <x-input type="text" name="duration" label="Duration (Days)"
                            placeholder="Duration" onlyNumber="true" value="1" />
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

            <div class="col-md-7 col-xl-9 mt-3 mt-md-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-2">
                            <h5>
                                {{ __('Additional Thumbnail') }}
                                <span class="text-primary">(Ratio 1:1 (500 x 500 px)</span>
                                <span class="text-danger">*</span>
                            </h5>
                            @error('additionThumbnail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-3" id="additionalElements">

                            <div id="addition">
                                <label for="additionThumbnail1" class="additionThumbnail">
                                    <img src="https://placehold.co/500x500/f1f5f9/png" id="preview2" alt=""
                                        width="100%" height="100%">
                                    <button onclick="removeThumbnail('addition')" id="removeThumbnail1" type="button"
                                        class="delete btn btn-sm btn-outline-danger" style="display: none"><i
                                            class="fa fa-trash"></i></button>
                                </label>
                                <input id="additionThumbnail1" accept="image/*" type="file"
                                    name="additionThumbnail[]" class="d-none"
                                    onchange="previewAdditionalFile(event, 'preview2', 'removeThumbnail1')">
                            </div>

                        </div>


                    </div>
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
