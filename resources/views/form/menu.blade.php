@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/form/component.css">
    @yield('form-styles')
@endsection

@section('scripts')
    <script src="/js/form/component.js"></script>
    @yield('form-scripts')
@endsection

@section('content')
    @yield('form-content')
@endsection
