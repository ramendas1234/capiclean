@component('mail::message')
# New Comment found to your Advertisement

Hello {{ $comment->commentable->user->name }}
{{ $comment->content }}
@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View Advertisement
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
