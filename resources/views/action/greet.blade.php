@extends('layouts.master')

@section('content')
    <div class="centerd">
        <a href="{{ route('home') }}">Home</a>
        <h1>I greet {{ $name === null ? 'you' : $name }}</h1>
    </div>
@endsection