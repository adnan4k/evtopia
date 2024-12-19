@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between px-3">

        <h4>
            {{ __('Transmission List') }}
        </h4>

        @hasPermission('shop.transmission.create')
        <button type="button" data-bs-toggle="modal" data-bs-target="#createBrand" class="btn py-2 btn-primary">
            <i class="fa fa-plus-circle"></i>
            {{__('Create New')}}
        </button>
        @endhasPermission
    </div>

    <div class="container-fluid mt-3">

        <div class="mb-3 card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                @hasPermission('shop.transmission.toggle')
                                <th>{{ __('Status') }}</th>
                                @endhasPermission
                                @hasPermission('shop.transmission.edit')
                                <th class="text-center">{{ __('Action') }}</th>
                                @endhasPermission
                            </tr>
                        </thead>
                        @forelse($transmissions as $key => $transmission)
                            @php
                                $serial = $transmissions->firstItem() + $key;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $serial }}</td>
                                <td>{{ $transmission->name }}</td>

                                @hasPermission('shop.transmission.toggle')
                                <td>
                                    <label class="switch mb-0">
                                        <a href="{{ route('shop.transmission.toggle', $transmission->id) }}">
                                            <input type="checkbox" {{ $transmission->is_active ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </a>
                                    </label>
                                </td>
                                @endhasPermission

                                @hasPermission('shop.transmission.edit')
                                <td class="text-center">
                                    <div class="d-flex gap-3 justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm circleIcon"
                                            onclick="opentransmissionUpdateModal({{ $transmission }})">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <a href="{{ route('shop.transmission.destroy', $transmission->id) }}"  class="btn btn-outline-primary btn-sm circleIcon"
                                            >
                                            <i class="fa-solid fa-trash"></i>
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
            {{ $transmissions->withQueryString()->links() }}
        </div>

    </div>


    <!--=== Create Brand Modal ===-->
    <form action="{{ route('shop.transmission.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="createBrand" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Create Transmission') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('Name') }}" required />
                            @error('name')
                                <p class="text text-danger m-0">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--=== update transmission Modal ===-->
    <form action="" id="updatetransmission" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="updateBrand" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Update Transmission') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="updateName" class="form-label">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="updateName" name="name"
                                placeholder="{{ __('Name') }}" required value="" />
                            @error('name')
                                <p class="text text-danger m-0">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        const opentransmissionUpdateModal = (transmission) => {

            $("#updateName").val(transmission.name);
            $("#updatetransmission").attr('action', `{{ route('shop.transmission.update', ':id') }}`.replace(':id', transmission.id));

            $("#updateBrand").modal('show');
        }
    </script>
@endpush
