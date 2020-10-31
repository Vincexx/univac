@extends('layouts.admin-app')

@section('content')
    @if (Auth::check())
        <admin-navigation :authUser="{{ Auth::user() }}"  />
    @endif
@endsection
