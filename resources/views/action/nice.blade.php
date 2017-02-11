@extends('layouts.master')

@section('content')
    <div>
        <a href="{{ route('home') }}">Home</a>
        <h1>I {{ $nice_action->name.' '.$name }}</h1>
    </div>
@endsection