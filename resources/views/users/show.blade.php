@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url():'' }}" class="img-thumbnail avatar" />
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>
            <x-commentForm route="{{ route('users.comments.store', ['user'=> $user->id] ) }}" /> 
            
            
                {{-- <x-commentList comments={{ $user->commentsOn }} /> --}}

                @forelse($user->commentsOn as $comment)
                    <p>
                        {{ $comment->content }}
                    </p>
                    <x-updated date="{{ $comment->created_at->diffForHumans() }}" message="added by" name="{{ $comment->user->name }}" userId={{ $comment->user->id }}  />
                @empty
                    <p>No comments yet!</p>
                @endforelse
        </div>
    </div>
@endsection