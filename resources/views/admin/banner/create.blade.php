@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            <i class="fa-solid fa-image"></i> {{__('Add New Banner')}}
        </div>
    </div>
    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

                <div class="card mt-3 h-100">
                    <div class="card-body row">
                        <div class="col-md-6">

                        <div class="">
                            <x-input label="Title" name="title" type="text" placeholder="Enter Short Title" />
                        </div>

                        
                        <div class="mt-3">
                            <label for="">
                                {{__('Short Description')}}
                                <span class="text-danger">*</span>
                            </label>
                            <textarea required name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="4" placeholder="Enter short description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text text-danger m-0">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="ratio4x1">
                                    <img src="https://placehold.co/2000x500/f1f5f9/png" id="banner" alt="" width="100%">
                                </div>
                            </div>
                            <x-file name="banner" label="Banner Ratio 4:1 (2000 x 500 px)" preview="banner" required="true"/>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="">
                                <x-input label="CTA Button Text" name="cta_text" type="text" placeholder="CTA Button Text" />
                            </div>

                            <div class="mt-3">
                                <x-input label="CTA URL Text" name="cta_url" type="text" placeholder="CTA URL Text" />
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button class="btn btn-primary py-2 px-5">
                                    {{__('Submit')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </form>
@endsection

