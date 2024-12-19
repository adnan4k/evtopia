@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between px-3">

        <h4>
            {{ __('Tag List') }}
        </h4>

        
    </div>

    <div class="container-fluid mt-3">

        <div class="mb-3 card">
            <div class="card-body">
                <form action="" class="d-flex align-items-center justify-content-between gap-3 mb-3">
                    <div class="input-group" style="max-width: 400px">
                        <input type="text" name="search" class="form-control"
                            placeholder="{{ __('Search by tag name') }}" value="{{ request('search') }}">
                        <button type="submit" class="input-group-text btn btn-primary">
                            <i class="fa fa-search"></i> {{ __('Search') }}
                        </button>
                    </div>
                    <a href="{{ route('admin.post_tags.create') }}" class="btn py-2 btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        {{__('Create New')}}
                    </a>
                </form>
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                @hasPermission('admin.post_tags.edit')
                                <th class="text-center">{{ __('Action') }}</th>
                                @endhasPermission
                            </tr>
                        </thead>
                        @forelse($tags as $key => $category)
                            @php
                                $serial = $tags->firstItem() + $key;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $serial }}</td>


                                <td>{{ $category->name }}</td>

                                <td class="flex gap-1 text-center"
                                style="display: flex; justify-content: center; align-items: center;"
                                >
                                    @hasPermission('admin.post_tags.edit')
                                    <div class="d-flex gap-3 justify-content-center">

                                        <a href="{{ route('admin.post_tags.edit', $category->id) }}" class="btn btn-outline-primary circleIcon">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                    </div>
                                    @endhasPermission

                                    
                                    @hasPermission('admin.post_tags.edit')
                                    <a href="{{ route('admin.post_tags.delete', $category->id) }}"
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
            {{ $tags->withQueryString()->links() }}
        </div>

    </div>
@endsection
