@extends('layout.app')

@section('title','Create post')


@section('content')
{{-- @if ($errors->any())
<div>
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>    
@endif --}}
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    @include('posts.partials.form')
    <button type="submit" class="btn btn-primary btn-block">Create!</button>
</form>

@endsection