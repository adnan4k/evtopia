@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between px-3">
        <h4>
            {{ __('Posts List') }}
        </h4>
    </div>

    <div class="container-fluid mt-3">

        <div class="card my-3">
            <div class="card-body">

                <div class="d-flex gap-2 pb-2">
                    <h5>
                        {{ __('Filter Posts') }}
                    </h5>
                </div>

                <form action="" method="GET">
                    <div class="row">

                        <div class="col-md-5 mb-3">
                            <x-select label="Category" name="category" placeholder="Select Category">
                                <option value="">
                                    {{ __('Select Category') }}
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <x-select label="Type" name="type" placeholder="Select Type">
                                <option value="">
                                    {{ __('Select Type') }}
                                </option>
                                    <option value="1"
                                        {{ request('type') == 1 ? 'selected' : '' }}>
                                        Knowledge Hub Posts
                                    </option>

                                    <option value="2"
                                    {{ request('type') == 2 ? 'selected' : '' }}>
                                    Blog Posts
                                </option>
                            </x-select>
                        </div>

                        <div class="col-md-3 mb-3 d-flex justify-content-end">
                            <div class="d-flex gap-2 justify-content-end " 
                            style="align-items: end"
                            >
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-light py-2 px-4">
                                    {{ __('Reset') }}
                                </a>
                                <button type="submit" class="btn btn-primary py-2 px-4">
                                    {{ __('Filter') }}
                                </button>
                            </div>
                        </div>

                    </div>

                    
                </form>
            </div>
        </div>

        <div class="mb-3 card">
            <div class="card-body">

                <form action="" class="d-flex align-items-center justify-content-between gap-3 mb-3">
                    <div class="input-group" style="max-width: 400px">
                        <input type="text" name="search" class="form-control"
                            placeholder="{{ __('Search by post name') }}" value="{{ request('search') }}">
                        <button type="submit" class="input-group-text btn btn-primary">
                            <i class="fa fa-search"></i> {{ __('Search') }}
                        </button>
                    </div>
                    @hasPermission('shop.product.create')
                    <a href="{{ route('admin.posts.create') }}" class="btn py-2 btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        {{ __('Create New') }}
                    </a>


                    @endhasPermission
                </form>

                <div class="table-responsive">
                    <table class="table border table-responsive-lg">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('SL') }}</th>
                                <th>{{ __('Thumbnail') }}</th>
                                <th>{{ __('Post Title') }}</th>
                                
                                {{-- @hasPermission('shop.product.toggle') --}}
                                <th class="text-center">{{ __('Status') }}</th>
                                {{-- @endhasPermission --}}
                                {{-- <th>{{ __('Comments') }}</th> --}}

                                <th class="text-center">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        @forelse($posts as $key => $post)
                            <tr>
                                <td class="text-center">{{ ++$key }}</td>

                                <td>
                                    <div class="product-image">
                                        <img src="{{ $post->thumbnail }}">
                                    </div>
                                </td>

                                <td>
                                    
                                    {{ Str::limit($post->title, 50, '...') }}

                                    {{-- Display categories --}}
                                    <div>
                                        Category :
                                        @foreach ($post->categories as $category)
                                            <span class="badge bg-primary">{{ $category->name }}</span>@if(!$loop->last), @endif
                                        @endforeach
                                    </div>

                                    {{-- Display tags --}}
                                    <div>
                                        Tags :
                                        @foreach ($post->tags as $tag)
                                            <span class="badge bg-secondary">{{ $tag->name }}</span>@if(!$loop->last), @endif
                                        @endforeach
                                    </div>                                
                                </td>
                                

                                {{-- @hasPermission('shop.product.toggle') --}}
                                <td class="text-center">
                                    <label class="switch mb-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                        data-bs-title="{{ __('Update posts status') }}">
                                        <a href="{{ route('admin.posts.toggle', $post->id) }}">
                                            <input type="checkbox" {{ $post->is_active ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </a>
                                    </label>
                                </td>
                                {{-- @endhasPermission --}}

                                {{-- <td>
                                    @if ($post->comments->where('status', 1)->count() > 0)
                                        <span class="badge bg-success">{{ $post->comments->where('status', 1)->count() }}</span>
                                    @endif
                                    @if($post->comments->where('status', 0)->count() > 0)
                                        <span class="badge bg-danger">{{ $post->comments->where('status', 1)->count() }}</span>
                                    @endif
                                </td> --}}

                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">

                                        @hasPermission('shop.product.show')
                                        <a href="{{ route('admin.posts.show', $post->id) }}"
                                            class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                            data-bs-placement="left" data-bs-title="{{ __('View posts') }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        @endhasPermission
                                    
                                        @hasPermission('shop.product.edit')
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"
                                            class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                            data-bs-placement="left" data-bs-title="{{ __('Edit posts') }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        @endhasPermission


                                        @hasPermission('shop.product.edit')
                                        <a href="{{ route('admin.posts.delete', $post->id) }}"
                                            class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                            data-bs-placement="left" data-bs-title="{{ __('Delete posts') }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        @endhasPermission
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="my-3">
            {{ $posts->links() }}
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(".confirmApprove").on("click", function(e) {
            e.preventDefault();
            const url = $(this).attr("href");
            Swal.fire({
                title: "Are you sure?",
                text: "You want to approve this product",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Approve it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endpush
