@extends('app')

@section('sidebar')
    @include('partials.client_sidebar')
@endsection

@section('content')
    <div class="p-4 sm:ml-64 mt-16">@yield('content')</div>
@endsection
