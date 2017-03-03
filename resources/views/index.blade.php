@extends('layouts.master')

@section('title')
    Trending quotes
@endsection

@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection

@section('content')
    @if(!empty(Request::segment(1)))
        <section>
            A filter has been set!
            <a href="{{ route('index') }}">Show all quote</a>
        </section>
    @endif

    @if(count($errors) > 0)
        <section class="info-box fail">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif
    @if(Session::has('success'))
        <section class="info-box success">
             {{ Session::get('success') }}
        </section>
    @endif
    <section class="quotes">
        <h1>Latest quote</h1>
        @foreach ($quotes as $quote)
        <article class="quote">
            <div class="delete">
                <a href="{{ route('delete', ['quote_id' => $quote->id]) }}">x</a>
            </div>
            {{ $quote->quote }} 
            <div class="info">
                Created by
                <a href="{{ route('index', ['author' => $quote->author->name]) }}">{{ $quote->author->name }}</a>
                on {{ $quote->created_at }} 
            </div>
        </article>
        @endforeach
        @if(empty($quotes))
        <div class="paginate">
            @if($quotes->currentPage() !== 1)
                <a href="{{ $quotes->previousPageUrl() }}">
                    <span class="fa fa-caret-left"></span>
                </a>
            @endif
            @if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
                <a href="{{ $quotes->nextPageUrl() }}">
                    <span class="fa fa-caret-right"></span>
                </a>
            @endif
        </div>
        @endif
    </section>

    <section class="edit-quote">
        <h1>Add a Quote</h1>
        <form action="{{ route('create') }}" method="post">
            <div class="input-group">
                <label for="author">Your Name</label>
                <input type="text" name="author" id="author" placeholder="Your name"/>
            </div>
            
            <div class="input-group">
                <label for="email">Your Email</label>
                <input type="text" name="email" id="email" placeholder="Your email"/>
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