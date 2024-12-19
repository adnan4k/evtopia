@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between px-3">

        <h4>
            {{ __('Category List') }}
        </h4>

        
    </div>

    <div class="container-fluid mt-3">

        <div class="mb-3 card">
            <div class="card-body">
                <form action="" class="d-flex align-items-center justify-content-between gap-3 mb-3">
                    <div class="input-group" style="max-width: 400px">
                        <input type="text" name="search" class="form-control"
                            placeholder="{{ __('Search by category name') }}" value="{{ request('search') }}">
                        <button type="submit" class="input-group-text btn btn-primary">
                            <i class="fa fa-search"></i> {{ __('Search') }}
                        </button>
                    </div>
                    <a href="{{ route('admin.post_categories.create') }}" class="btn py-2 btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        {{__('Create New')}}
                    </a>
                </form>
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('SL') }}</th>
                                <th>{{ __('Thumbnail') }}</th>
                                <th>{{ __('Name') }}</th>
                                @hasPermission('admin.post_categories.toggle')
                                <th>{{ __('Status') }}</th>
                                @endhasPermission
                                @hasPermission('admin.post_categories.edit')
                                <th class="text-center">{{ __('Action') }}</th>
                                @endhasPermission
                            </tr>
                        </thead>
                        @forelse($categories as $key => $category)
                            @php
                                $serial = $categories->firstItem() + $key;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $serial }}</td>

                                <td>
                                    <img src="{{ $category->thumbnail }}" width="50">
                                </td>

                                <td>{{ $category->name }}</td>

                                @hasPermission('admin.post_categories.toggle')
                                <td>
                                    <label class="switch mb-0">
                                        <a href="{{ route('admin.post_categories.toggle', $category->id) }}">
                                            <input type="checkbox" {{ $category->status ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </a>
                                    </label>
                                </td>
                                @endhasPermission
                                <td class="flex gap-1 text-center"
                                style="display: flex; justify-content: center; align-items: center;"
                                >
                                    @hasPermission('admin.post_categories.edit')
                                    <div class="d-flex gap-3 justify-content-center">

                                        <a href="{{ route('admin.post_categories.edit', $category->id) }}" class="btn btn-outline-primary circleIcon">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                    </div>
                                    @endhasPermission

                                    
                                    @hasPermission('admin.post_categories.edit')
                                    <a href="{{ route('admin.post_categories.delete', $category->id) }}"
                                        class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                        data-bs-placement="left" data-bs-title="{{ __('Delete Category') }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    @endhasPermission
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
            {{ $categories->withQueryString()->links() }}
        </div>

    </div>
@endsection
