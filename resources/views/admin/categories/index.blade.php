@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between px-3">

        <h4>
            {{ __('Service Category List') }}
        </h4>

        @hasPermission('shop.category.create')
        <a href="{{ route('admin.serviceCategory.create') }}" class="btn py-2 btn-primary">
            <i class="fa fa-plus-circle"></i>
            {{__('Create New')}}
        </a>
        @endhasPermission
    </div>

    <div class="container-fluid mt-3">

        <div class="mb-3 card">
            <div class="card-body">
                <div class="cardTitleBox">
                    <h5 class="card-title chartTitle">
                        {{__('Categories')}}
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('SL') }}</th>
                                <th>{{ __('Thumbnail') }}</th>
                                <th>{{ __('Name') }}</th>
                                @hasPermission('shop.category.toggle')
                                <th>{{ __('Status') }}</th>
                                @endhasPermission
                                @hasPermission('shop.category.edit')
                                <th class="text-center">{{ __('Action') }}</th>
                                @endhasPermission
                            </tr>
                        </thead>
                        @forelse($categories as $key => $service_category)
                            @php
                                $serial = $categories->firstItem() + $key;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $serial }}</td>

                                <td>
                                    <img src="{{ $service_category->thumbnail }}" width="50">
                                </td>

                                <td>{{ $service_category->name }}</td>

                                @hasPermission('shop.category.toggle')
                                <td>
                                    <label class="switch mb-0">
                                        <a href="{{ route('admin.serviceCategory.toggle', $service_category->id) }}">
                                            <input type="checkbox" {{ $service_category->status ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </a>
                                    </label>
                                </td>
                                @endhasPermission
                                @hasPermission('shop.category.edit')
                                <td class="text-center">
                                    <div class="d-flex gap-3 justify-content-center">

                                        <a href="{{ route('admin.serviceCategory.edit', $service_category->id) }}" class="btn btn-outline-primary circleIcon">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <a href="{{ route('admin.serviceCategory.destroy', $service_category->id) }}" class="btn btn-outline-primary circleIcon">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>

                                    </div>
                                </td>
                                @endhasPermission
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
