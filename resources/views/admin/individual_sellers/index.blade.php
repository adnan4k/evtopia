@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="w-100 page-title-heading d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    {{__('Individual Sellers')}}
                    <div class="page-title-subheading">
                        {{__('This is a individual Sellers List')}}
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center gap-md-4">
                    <div class="d-flex gap-2 gap-md-3">
                        <button class="gridBtn" id="listView" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="{{__('List View')}}">
                            <i class="fa-solid fa-list-ul"></i>
                        </button>
                        <button class="gridBtn" id="gridView" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="{{__('Grid View')}}">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>
                    </div>

                    @hasPermission('admin.individual.create')
                    <a href="{{ route('admin.individual.create') }}" class="btn py-2 btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        {{__('Create New Shop')}}
                    </a>
                    @endhasPermission
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="mb-4 d-none" id="listItem">
            <div class="table-responsive">

                <table class="table shopTable table-striped table-responsive-lg">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Contacts') }}</th>
                            @hasPermission('admin.individual.status.toggle')
                            <th>{{ __('Status') }}</th>
                            @endhasPermission
                            @hasPermission('admin.individual.products')
                            <th class="text-center">{{ __('Products') }}</th>
                            @endhasPermission
                            @hasPermission('admin.individual.orders')
                            <th class="text-center">{{ __('Orders') }}</th>
                            @endhasPermission
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                           
                                <td>{{ $user->name }} {{$user->last_name}}</td>
                                <td>{{ $user->email }}

                                    <br>
                                    {{ $user->phone }}
                                </td>
                                @hasPermission('admin.individual.status.toggle')
                                <td>
                                    <label class="switch mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Click here to change status')}}">
                                        <a href="{{ route('admin.individual.status.toggle', $user->shop->id) }}">
                                            <input type="checkbox" {{ $user->shop->user?->is_active ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </a>
                                    </label>
                                </td>
                                @endhasPermission
                                @hasPermission('admin.individual.products')
                                <td class="text-center">
                                    <a href="{{ route('admin.individual.products', $user->shop->id) }}" class="badge badge-square badge-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{__('Click here to view total products')}}">
                                        {{ $user->shop->products->count() }}
                                    </a>
                                </td>
                                @endhasPermission
                                @hasPermission('admin.individual.orders')
                                <td class="text-center">
                                    <a href="{{ route('admin.individual.orders', $user->shop->id) }}"
                                        class="badge badge-square badge-info" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{__('Click here to view total orders')}}">
                                        {{ $user->shop->orders->count() }}
                                    </a>
                                </td>
                                @endhasPermission
                                <td class="text-center">
                                    @hasPermission('admin.individual.show')
                                    <a class="btn btn-outline-primary circleIcon"
                                        href="{{ route('admin.individual.show', $user->shop->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endhasPermission
                                    @hasPermission('admin.individual.edit')
                                    <a href="{{ route('admin.individual.edit', $user->shop->id) }}"
                                        class="btn btn-outline-secondary circleIcon" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    @endhasPermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row row-gap mb-4 d-none" id="gridItem">
            @foreach ($users as $key => $user)
                <div class="col-12 col-md-6 col-xl-4 col-xxl-3">
                    <div class="card shadow-sm rounded-12 show-card position-relative overflow-hidden">
                        <div class="card-body shop p-2">
                            <div class="banner">
                                <img class="img-fit" src="{{ $user->shop->logo }}" />
                            </div>
                            <div class="main-content">
                                
                                <div class="personal">
                                    <span class="name">{{ $user->name }} {{ $user->last_name }}</span>
                                    <span class="email">{{ $user->email }} <br>
                                    {{ $user->phone }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-2 px-3 mt-2">
                                <div class="item">
                                    <strong>{{ __('Status') }}</strong>
                                    <label class="switch mb-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                        data-bs-title="{{__('Click here to change status')}}">
                                        @hasPermission('admin.individual.status.toggle')
                                            <a href="{{ route('admin.individual.status.toggle', $user->shop->id) }}">
                                                <input type="checkbox" {{ $user->shop->user?->is_active ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </a>
                                        @else
                                            <input type="checkbox" {{ $user->shop->user?->is_active ? 'checked' : '' }}>
                                        @endhasPermission
                                    </label>
                                </div>
                                @hasPermission('admin.individual.products')
                                <div class="item">
                                    <strong>{{ __('Products') }}</strong>
                                    <a href="{{ route('admin.individual.products', $user->shop->id) }}" class="btn btn-secondary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        data-bs-title="{{__('Click here to see products')}}">
                                        {{ $user->shop->products->count() }}
                                    </a>
                                </div>
                                @endhasPermission

                                @hasPermission('admin.individual.orders')
                                <div class="item">
                                    <strong>{{ __('Orders') }}</strong>
                                    <a href="{{ route('admin.individual.orders', $user->shop->id) }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        data-bs-title="{{__('Click here to see orders')}}">
                                        {{ $user->shop->orders->count() }}
                                    </a>
                                </div>
                                @endhasPermission
                            </div>
                        </div>
                        <div class="overlay">
                            @hasPermission('admin.individual.edit')
                            <a class="icons" href="{{ route('admin.individual.edit', $user->shop->id) }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endhasPermission
                            @hasPermission('admin.individual.show')
                            <a class="icons" href="{{ route('admin.individual.show', $user->shop->id) }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endhasPermission
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



        <div class="my-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
