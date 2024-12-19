@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between px-3">
        <h4>
            {{ __('Service List') }}
        </h4>
    </div>

    <div class="container-fluid mt-3">

        <div class="card my-3">
            <div class="card-body">

                <div class="d-flex gap-2 pb-2">
                    <h5>
                        {{ __('Filter Services') }}
                    </h5>
                </div>

                <form action="" method="GET">
                    <div class="row">

                        <div class="col-md-9 mb-3">
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

                        <div class="col-md-3 mb-3 d-flex justify-content-end">
                            <div class="d-flex gap-2 justify-content-end " 
                            style="align-items: end"
                            >
                                <a href="{{ route('admin.service.index') }}" class="btn btn-light py-2 px-4">
                                    {{ __('Reset') }}
                                </a>
                                <button type="submit" class="btn btn-primary py-2 px-4">
                                    {{ __('Filter Data') }}
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
                            placeholder="{{ __('Search by service name') }}" value="{{ request('search') }}">
                        <button type="submit" class="input-group-text btn btn-primary">
                            <i class="fa fa-search"></i> {{ __('Search') }}
                        </button>
                    </div>
                    @hasPermission('shop.product.create')
                    <a href="{{ route('admin.service.create') }}" class="btn py-2 btn-primary">
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
                                <th>{{ __('Service Name') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                <th class="text-center">{{ __('Discount Price') }}</th>
                                
                                @hasPermission('shop.product.toggle')
                                <th class="text-center">{{ __('Status') }}</th>
                                @endhasPermission
                                <th class="text-center">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        @forelse($services as $key => $service)
                            <tr>
                                <td class="text-center">{{ ++$key }}</td>

                                <td>
                                    <div class="product-image">
                                        <img src="{{ $service->thumbnail }}">
                                    </div>
                                </td>

                                <td>{{ Str::limit($service->name, 50, '...') }}</td>
                                <td>{{ $service->code }}</td>

                                <td class="text-center">
                                    {{ showCurrency($service->price) }}
                                </td>

                                <td class="text-center">
                                    {{ showCurrency($service->discounted_price) }}
                                </td>

                                @hasPermission('shop.product.toggle')
                                <td class="text-center">
                                    <label class="switch mb-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                        data-bs-title="{{ __('Update service status') }}">
                                        <a href="{{ route('admin.service.toggle', $service->id) }}">
                                            <input type="checkbox" {{ $service->is_active ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </a>
                                    </label>
                                </td>
                                @endhasPermission

                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        @hasPermission('shop.product.show')
                                        <a href="{{ route('admin.service.show', $service->id) }}"
                                            class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                            data-bs-placement="left" data-bs-title="{{ __('View Service') }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        @endhasPermission
                                    
                                        @hasPermission('shop.product.edit')
                                        <a href="{{ route('admin.service.edit', $service->id) }}"
                                            class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                            data-bs-placement="left" data-bs-title="{{ __('Edit Service') }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        @endhasPermission


                                        @hasPermission('shop.product.edit')
                                        <a href="{{ route('admin.service.destroy', $service->id) }}"
                                            class="btn btn-outline-primary circleIcon" data-bs-toggle="tooltip"
                                            data-bs-placement="left" data-bs-title="{{ __('Delete Service') }}">
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
            {{ $services->links() }}
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
