@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>
                    {{ __('Bookings') }}
                </div>
            </div>
        </div>
    </div>

    <div class="card">


        <div class="card-body">
            <form action="" class="d-flex align-items-center justify-content-between gap-3 mb-3">
                <div class="input-group ">
                   
                    <input type="text" style="max-width: 300px" name="search" class="form-control" 
                           placeholder="{{ __('Search by customer name, booking code') }}" 
                           value="{{ request('search') }}">
                        @php
                           $selectedStatus = $status ?? 'All';
                       @endphp
                    
                 
                 
                    <div style="max-width: 300px" class="dropdown w-100 w-md-auto mt-2 mt-md-0 ms-md-2 ">
                        <a class="btn border text-start dropdown-toggle w-100" href="#" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                         {{ __($selectedStatus) }}
                     </a>
                        
                        @hasPermission(['admin.order.status.change'])
                        <ul class="dropdown-menu w-100">
                            @if ($selectedStatus != 'All')
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.booking.index') }}">
                                    {{ __('All') }}
                                </a>
                            </li>
                            @endif
                            @foreach ($orderStatus as $stat)
                                <li>
                                    <a class="dropdown-item" 
                                       href="{{ route('admin.booking.index') }}?status={{ $stat->value }}">
                                        {{ __($stat->value) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @endhasPermission
                    </div>
                
                    <button type="submit" class="input-group-text btn btn-primary mt-2 mt-md-0 ms-md-2">
                        <i class="fa fa-search"></i> {{ __('Search') }}
                    </button>
                </div>
                
              
            </form>

            <div class="table-responsive">

                <table class="table border table-responsive-lg">
                    <thead>
                        <tr>
                            <th style="min-width: 85px">{{ __('Booking ID') }}</th>
                            <th>{{ __('Order Date') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{__('Total Amount') }}</th>
                            <th>{{__('Payment Method') }}</th>
                            <th>{{__('Booking Status') }}</th>
                            <th>{{__('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $order)
                            <tr>
                                <td class="w-auto">{{ $order->prefix . $order->booking_code }}</td>
                                <td class="w-min">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                <td class="w-min">{{ $order->customer?->user?->name }}</td>

                               
                                <td class="w-min">
                                    {{ showCurrency($order->payable_amount) }}
                                    <br>
                                    <span class="badge rounded-pill text-bg-primary">{{ $order->payment_status }}</span>
                                </td>
                                <td class="w-min">{{ $order->payment_method }}</td>
                                <td class="w-min">{{ $order->order_status }}</td>
                                <td class="w-min">
                                    @hasPermission('admin.order.show')
                                    <a href="{{ route('admin.booking.show', $order->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-title="{{__('view details')}}"
                                        class="circleIcon btn-outline-primary">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    @endhasPermission
                                    <a href="{{ route('shop.booking-download-invoice', $order->id) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left"
                                        data-bs-title="{{__('Download Invoice')}}" class="circleIcon btn-outline-success btn">
                                        <i class="bi bi-arrow-down-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <div class="my-3">
        {{ $bookings->links() }}
    </div>

@endsection
