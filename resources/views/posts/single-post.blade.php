@extends('layout.app')

@section('title', $post->title)
@section('content')

<div class="row">
    <div class="col-md-8">
        @if($post->image)
        <div style="background-image: url('{{ $post->image->url() }}');" class="banner-fixed">
            <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
        @else
            <h1>
        @endif
            {{ $post->title }}
            <x-badge show="{{ now()->diffInMinutes($post->created_at) < 25 }}" type="primary" message="New!"/>
        @if($post->image)    
            </h1>
        </div>
        @else
            </h1>
        @endif

        <p>{{ $post->content }}</p>
        
        <x-updated date="{{ $post->created_at->diffForHumans() }}" name="{{ $post->user->name }}">
            added by
        </x-updated>    

        <x-updated date="{{ $post->updated_at->diffForHumans() }}" >
            updated by
        </x-updated>

        <x-tag :tags="$post->tags"  />


        <x-badge show="{{ now()->diffInMinutes($post->created_at) < 25 }}" type="primary" message="New!"/>


        <h4>Comments</h4>
        {{-- @include('comments._form') --}}
        <x-commentForm route="{{ route('posts.comments.store', ['post'=> $post->id] ) }}" />  
        <x-commentList comments={{ $post->comments }} />
       
        
    </div>
    <div class="col-md-4">
        @include('posts.partials.__sidebar');
    </div>
</div>    
@endsection