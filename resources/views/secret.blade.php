@extends('layout.app')

@section('title', 'secret')
@section('content')
<h2>Secret</h2>

<p>Hello this is Secret</p>

@can('home.secret')
    <p>Here is special link</p>
@endcan
@endsection