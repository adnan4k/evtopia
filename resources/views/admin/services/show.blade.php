@extends('layouts.app')

@section('content')
    <div>
        <h4>
            {{__('Service Details')}}
        </h4>
    </div>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex gap-3">
                <div class="text-center">
                    <div class="rounded overflow-hidden ratio1x1">
                        <img src="{{ $service->thumbnail }}" alt="" width="140">
                    </div>
                    <a href="/services/{{ $service->id }}/details" target="_blank" class="btn btn-outline-primary mt-3">
                        <i class="fa-solid fa-globe"></i> {{__('View Live')}}
                    </a>
                </div>

                <div class="flex-grow-1">
                    <div class="d-flex flex-wrap gap-3 justify-content-between">
                        <div class="d-flex gap-3 productThumbnail">
                            @foreach ($service->thumbnails() as $photo)
                                <img src="{{ $photo->thumbnail }}" alt="Service" />
                            @endforeach
                        </div>

                    </div>
                    <h3 class="mb-2 mt-3 pb-1">{{ $service->name }}</h3>

                    <div>
                        <h6 class="mb-1 text-muted">
                            {{__('Short Description')}}
                        </h6>
                        <p>{{ $service->short_description }}</p>
                    </div>
                </div>
            </div>

            <div class="border-top my-3"></div>

            <!-- General Information -->
            <div class="d-flex gap-4 flex-wrap justify-content-lg-between">

                <div>
                    <h5 class="text-dark fw-bold">{{__('General Information')}}</h5>
                    <table class="table table-borderless mb-0 border-0">
                       
                        <tr>
                            <td class="ps-0 py-1">
                                {{__('Categories')}}
                            </td>
                            <td class="py-1">
                                :@foreach ($service->categories as $category)
                                    {{ $category->name }}@if (!$loop->last), @endif
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <h5 class="text-dark fw-bold">
                        {{__('Price Information')}}
                    </h5>
                    <table class="table table-borderless mb-0 border-0">
                        <tr>
                            <td class="ps-0 py-1">Price</td>
                            <td class="py-1">: {{ showCurrency($service->price) }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 py-1">
                                {{__('Discount Price')}}
                            </td>
                            <td class="py-1">
                               : {{ showCurrency($service->discounted_price) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="border-top my-3"></div>

            <div>
                <h5 class="text-dark fw-bold">
                    {{__('Description')}}
                </h5>
                <p>
                    {!! $service->description !!}
                </p>
            </div>

        </div>
    </div>
@endsection
