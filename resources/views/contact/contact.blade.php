@extends('layout.app')

@section('title', 'contact')
@section('content')
<h2>Contact</h2>

<p>Hello this is contact</p>

@can('home.secret')
    <p><a href="{{ route('secret') }}">Here is special contact details link</a></p>
@endcan
@endsection