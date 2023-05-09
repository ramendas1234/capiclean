@extends('layout.app')

@section('title', 'home page')
@section('content')


@include('posts.partials.hero-slider');

@include('posts.partials.posts-grid-section')

@include('posts.partials.posts-list-section')

@include('posts.partials.posts-grid-section2')

@endsection