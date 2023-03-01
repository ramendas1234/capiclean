@extends('layout.app')

@section('title', 'home page')
@section('content')
<?php 
// echo '<pre>';
// print_r($user_details);
    

?>
<h2>Home Page</h2>
<p>Hello {{ $user_details['name'] }}</p>
<p>Address: {{ $user_details['address'] }}</p>
@if ($user_details['age']<30)
<p>Less than 30 years old</p>
@else 
<p>Above 30 years old</p>   
@endif
{{-- @component('components.alert')
@slot('message')
Forbidden
@endslot
@endcomponent --}}

<x-alert />
<x-alert.danger />






@empty(!$user_details['meta_data']['contact'])
<p>Contact: {{ $user_details['meta_data']['contact'] }}</p>
@endempty

@isset($user_details['meta_data']['fav_subject'])
<p>Favrioute Movies show : @forelse ( $user_details['meta_data']['fav_subject'] as $sub)
<span>{{ $sub }}</span>    
@empty
 <span>No movies found</span>   
@endforelse
</p>
@endisset


@if(!empty($user_details['meta_data']['fav_tv_show']))
favourite tv shows:
{{ implode(',',$user_details['meta_data']['fav_tv_show']) }}
@endif

{{-- The current UNIX timestamp is {{ time() }}. --}}
@endsection