@extends('layout.app')

@section('title','Update the post')


@section('content')
@if ($errors->any())
<div>
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>    
@endif
<form method="POST" action="{{ route('posts.update', ['post'=> $post->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('posts.partials.form')
    <button type="submit" class="btn btn-primary btn-block">Update!</button>
</form>

@endsection