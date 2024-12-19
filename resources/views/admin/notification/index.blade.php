@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <!-- Tabs for switching between forms -->
        <ul class="nav nav-tabs" id="notificationTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="sendNotification-tab" data-bs-toggle="tab" href="#sendNotification" role="tab" aria-controls="sendNotification" aria-selected="true">
                    {{ __('Send Notification') }}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="serviceDateNotification-tab" data-bs-toggle="tab" href="#serviceDateNotification" role="tab" aria-controls="serviceDateNotification" aria-selected="false">
                    {{ __('Service Date Notification') }}
                </a>
            </li>
        </ul>

        <div class="tab-content mt-4" id="notificationTabsContent">
            <!-- Send Notification Form -->
            <div class="tab-pane fade show active" id="sendNotification" role="tabpanel" aria-labelledby="sendNotification-tab">
                
                <form method="GET" action="{{ url()->current() }}">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center gap-1">
                            <input 
                                type="search" 
                                name="search1" 
                                class="form-control" 
                                id="search1" 
                                placeholder="Search by name, email, phone" 
                                value="{{ request('search1') }}"
                            >
                            <button type="submit" class="btn btn-primary py-2 px-4">
                                {{ __('Search') }}
                            </button>
                        </div>

                    </div>
                </form>
                <form action="{{ route('admin.customerNotification.send') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8  card mt-3">
                            <div class="card-body">
    
                                
    
                                @error('user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
    
                                <div class="table-responsive-md maxScroll mt-2">
                                    <table class="table table-bordered table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="px-0 text-center" style="width: 42px">
                                                    <input type="checkbox" onclick="toggle(this);" />
                                                </th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Contact') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="notificationUsers">
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="py-2 px-0 text-center">
                                                        <input type="checkbox" name="user[]" value="{{ $user->id }}">
                                                    </td>
                                                   
                                                    <td class="py-2">{{ $user->name }}</td>
                                                    <td>{{ $user->email ?? '-' }}

                                                        <br>
                                                        {{ $user->phone ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                  {{-- <div class="my-3">
                                        {{ $users->links() }}
                                    </div>--}}
                            </div>
                        </div>
                        <div class="col-md-4 card">
                            <div class="card-header bg-custom">
                                <h4 class="card-title m-0 py-2">
                                    <i class="bi bi-bell"></i> {{ __('Send Notification') }}
                                </h4>
                            </div>
                            <div class="card-body">
    
                                <x-input name="title" type="text" label="Title" placeholder="Notification Title" required="true" />
    
                                <div class="mt-3">
                                    <label class="mb-1">
                                        {{ __('Message') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="{{ __('Notification Message...') }}">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @hasPermission('admin.customerNotification.send')
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        {{ __('Send Message') }}
                                    </button>
                                </div>
                                @endhasPermission
                            </div>
                        </div>
                    </div>

                  
                </form>
            </div>

            <!-- Service Date Notification Form -->
            <div class="tab-pane fade" id="serviceDateNotification" role="tabpanel" aria-labelledby="serviceDateNotification-tab">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center gap-1">
                            <input 
                                type="search" 
                                name="search2" 
                                class="form-control" 
                                id="search2" 
                                placeholder="Search by name, email, phone" 
                                value="{{ request('search2') }}"
                            >
                            <button type="submit" class="btn btn-primary py-2 px-4">
                                {{ __('Search') }}
                            </button>
                        </div>

                    </div>
                </form>
                <form action="{{ route('admin.customerNotification.send') }}" method="POST">
                    @csrf

                    <div class="row  mt-3">
                        <div class="col-md-8 card">
                            <div class="card-header bg-custom">
                                <h4 class="card-title m-0 py-2">
                                    <i class="bi bi-bell"></i> {{ __('Users with Service Dates This Week') }}
                                </h4>
                            </div>
                            <div class="card-body">
    
                                @error('user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
    
                                <div class="table-responsive-md maxScroll mt-2">
                                    <table class="table table-bordered table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="px-0 text-center" style="width: 42px">
                                                    <input type="checkbox" onclick="toggle(this);" />
                                                </th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Contact') }}</th>
                                                <th>{{ __('Service Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="notificationUsers">
                                            @foreach ($serviceUsers as $user)
                                                <tr>
                                                    <td class="py-2 px-0 text-center">
                                                        <input type="checkbox" name="user[]" value="{{ $user->id }}">
                                                    </td>
                                                  
                                                    <td class="py-2">{{ $user->name }}</td>
                                                    <td>{{ $user->email ?? '-' }} <br>
                                                        {{ $user->phone ?? '-' }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($user->customer->vehicle->service_date)->format('M d, Y (l)') ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="my-3">
                                    {{ $serviceUsers->links() }}
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-4 card">
                         
                            <div class="card-body">
    
                                <x-input name="title" type="text" label="Title" placeholder="Notification Title" required="true" />
    
                                <div class="mt-3">
                                    <label class="mb-1">
                                        {{ __('Message') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="{{ __('Notification Message...') }}">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @hasPermission('admin.serviceDateNotification.send')
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        {{ __('Send Message') }}
                                    </button>
                                </div>
                                @endhasPermission
                            </div>
                        </div>

                    </div>

                  
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        };

        $(document).ready(function() {
            $("#deviceType").change(function() {
                var deviceType = $('#deviceType').val();
                if (deviceType) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('admin.customerNotification.filter') }}",
                        dataType: 'json',
                        data: {
                            device_type: deviceType
                        },
                        success: function(response) {
                            $('#notificationUsers').empty()
                            $.each(response.data.users, function(key, value) {
                                $('#notificationUsers').append(
                                    "<tr style='display: table-row;'>\
                                            <td> <input type='checkbox' name='user[]' value='" + value.id + "'></td>\
                                             <td><img src='" + value.profile_photo + "' width='40' height='40' loading='lazy' class='rounded'/></td>\
                                            <td>" + value.name + "</td>\
                                            <td>" + (value.email ?? '-') + "</td>\
                                            <td>" + (value.phone ?? '-') + "</td>\
                                        </tr>"
                                );
                            });
                            if (!response.data.users.length) {
                                $('#notificationUsers').append(
                                    "<tr>\
                                            <td colspan='4'> User list is empty</td>\
                                        </tr>"
                                );
                            }
                        },
                        error: function(e) {
                            $('#notificationUsers').empty()
                            $('#notificationUsers').append(
                                "<tr>\
                                            <td colspan='4'>" + e.responseText + "</td>\
                                        </tr>"
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
