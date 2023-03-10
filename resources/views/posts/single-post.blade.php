@extends('layout.app')

@section('title', $post->title)
@section('content')

<div class="row">
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1>
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
        @forelse ($post->comments as $comment)
            <div class="list-group mb-3">
                <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start active">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-2">{{ $comment->content }}</p>
                        <x-updated date="{{ $comment->created_at->diffForHumans() }}" message="added by" name="{{ $comment->user->name }}" />
                    </div>
                </a>
            </div>
        @empty
            <div class="alert alert-danger">No comments on this post</div>
        @endforelse
            

            <form method="post" action="{{ route('posts.comments.store', ['post'=> $post->id]) }}">
                @csrf
                <div class="form-group">
                <label for="exampleFormControlTextarea1">Comment on this post</label>
                <textarea class="form-control" name="blog_post_comment" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">Submit</button>
                </div>
            </form>

        
    </div>
    <div class="col-md-4">
        @include('posts.partials.__sidebar');
    </div>
</div>    
@endsection