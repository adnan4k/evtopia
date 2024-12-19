@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            <i class="fa-solid fa-border-all"></i> {{__('Create New Tag')}}
        </div>
    </div>
    <form action="{{ route('admin.post_tags.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card mt-3">
                    <div class="card-body">

                        <div class="d-flex gap-2 border-bottom pb-2">
                            <i class="fa-solid fa-user"></i>
                            <h5>
                                {{__('Tag Information')}}
                            </h5>
                        </div>

                        <div class="mt-3">
                            <x-input label="Name" name="name" type="text" placeholder="Enter Name" required="true"/>
                        </div>

                        <div class="mt-5 d-flex gap-2 justify-content-between">
                            <a href="{{ route('admin.post_tags.index')}}" class="btn btn-secondary py-2 px-4">
                            {{__('Back')}}
                            </a>

                            <button type="submit" class="btn btn-primary py-2 px-4">
                                {{__('Submit')}}
                            </button>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </form>
@endsection
