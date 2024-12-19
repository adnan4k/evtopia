@extends('layouts.app')

@section('content')
    <div>
        <h4>
            {{__('Post Details')}}
        </h4>
    </div>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column gap-3">

                <div class="flex-grow-1">
                    <h3 class="mb-2 mt-3 pb-1">{{ $post->title }}</h3>

                    <div>
                           <span>
                            {{__('By : ')}}
                            </span> 
                        <span>{{ $post->user->name }}</span>  
                        , <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                </div>
                <div >
                        <img class="object-fit-cover" src="{{ $post->thumbnail }}" alt="" style="width: 100%;" width="100">
                    {{-- <a href="/services/{{ $post->id }}/details" target="_blank" class="btn btn-outline-primary mt-3">
                        <i class="fa-solid fa-globe"></i> {{__('View Live')}}
                    </a> --}}
                </div>

                <div class="flex-grow-1">
                   

                    <div>
                        {{-- <h6 class="mb-1 text-muted">
                            {{__('Short Description')}}
                        </h6> --}}
                        <p>{{ $post->short_description }}</p>
                    </div>
                </div>
            </div>

            <div class="border-top my-3"></div>

            <!-- General Information -->
            <div class="d-flex gap-4 flex-wrap justify-content-md-between">

                <div>
                    <table class="table table-borderless mb-0 border-0">
                       
                        <tr>
                            <td class="ps-0 py-1">
                                {{__('Categories')}}
                            </td>
                            <td class="py-1">
                                :@foreach ($post->categories as $category)
                                    {{ $category->name }}@if (!$loop->last), @endif
                                @endforeach
                            </td>
                        </tr>

                    </table>
                </div>

                <div>
                    <table class="table table-borderless mb-0 border-0">

                        <tr>
                            <td class="ps-0 py-1">
                                {{__('Tags')}}
                            </td>
                            <td class="py-1">
                                :@foreach ($post->tags as $category)
                                    {{ $category->name }}@if (!$loop->last), @endif
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="border-top my-3"></div>

            <div class="mb-5">
                <h5 class="text-dark fw-bold">
                    {{__('Description')}}
                </h5>
                <p>
                    {!! $post->description !!}
                </p>
            </div>

            {{-- render comments --}}

            <hr>
            {{-- <div class="mt-5">
                <h5 class="text-dark fw-bold">
                    {{__('Comments')}}
                </h5>
                <div class="card mt-1">
                    <div class="card-body">
                        @forelse ($post->comments as $comment)
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <div class="d-flex gap-3 my-4">
                                <div>
                                    <img src="{{ $comment->customer->user->thumbnail }}" alt="" class="rounded-circle" width="40" height="40">
                                </div>
                                <div>
                                    <span class="mb-1">
                                        {{ $comment->customer->user->name }}
                                    </span>
                                    <p class="text-muted text-[8px]">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                    <p class="my-1">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            </div>
                        
                            <!-- Right Side - Action Buttons -->
                            <div class="d-flex gap-2">
                                @if (!$comment->status)
                                <a href="{{ route('admin.posts.comment.status', ['comment' => $comment->id,'post'=>$post->id]) }}" class="btn btn-outline-primary">
                                    <i class="fa fa-check"></i> 
                                </a>
                                @else
                                    <a href="{{ route('admin.posts.comment.status', ['comment' => $comment->id, 'post'=>$post->id]) }}" class="btn btn-outline-danger">
                                        <i class="fa fa-times"></i> 
                                    </a>
                                @endif
                                <a href="{{ route('admin.posts.comment.delete', ['comment' => $comment->id, 'post'=>$post->id]) }}" class="btn btn-outline-danger ">
                                    <i class="fa fa-trash"></i> 
                                </a>
                            </div>
                        </div>
                        <hr>
                        
                        @empty
                            <p class="text-muted">
                                {{__('No Comments')}}
                            </p>
                        @endforelse
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
