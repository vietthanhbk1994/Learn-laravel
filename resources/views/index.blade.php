@extends('layouts.master')

@section('title')
    Trending quotes
@endsection

@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection

@section('content')
    <section class="quotes">
        <h1>Latest quote</h1>
        <article class="quote">
            <div class="delete">
                <a href="#">x</a>
            </div>
            Quote text
            <div class="info">
                Created by
                <a href="">Maximilian</a>
                 on ...
            </div>
        </article>
        Pagination
    </section>

    <section class="edit-quote">
        <h1>Add a Quote</h1>
        <form action="{{ route('create') }}" method="post">
            <div class="input-group">
                <label for="author">Your Name</label>
                <input type="text" name="author" id="author" placeholder="Your name"/>
            </div>
            <div class="input-group">
                <label for="quote">Your quote</label>
                <input type="text" name="quote" id="quote" placeholder="Quote"/>
            </div>
            <button type="submit" class="btn" />Submit Quote</button>
            {{ csrf_field() }}
        </form>
    </section>
@endsection