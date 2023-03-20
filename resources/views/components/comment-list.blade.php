@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-updated date="{{ $comment->created_at->diffForHumans() }}" message="added by" name="{{ $comment->user->name }}" userId={{ $comment->user->id }}  />
@empty
    <p>No comments yet!</p>
@endforelse