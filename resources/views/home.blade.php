@extends('layouts.master')
@section('content')
    <div>
        @foreach ($actions as $action)
            <a href="{{ route('niceaction',['action' => lcfirst($action->name)]) }}">{{ ucfirst($action->name) }}</a>
        @endforeach
        @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('add_action') }}" method="post">
            <label for="select-action">I want to ....</label>   
            <label for="name">Name for action</label>
            <input type="text" name="name" id="name"/>
            <label for="niceness">Niceness:</label>
            <input type="text" name="niceness" id="niceness"/>
            <button type="submit" onclick="send(event);">Submit</button>
            {{ csrf_field() }}
        </form>
        <ul>
            @foreach ($logged_actions as $logged_action)
                <li>
                    {{ $logged_action->nice_action->name }}
                    @foreach ($logged_action->nice_action->categories as $category)
                        {{ $category->name }}
                    @endforeach
                </li>
            @endforeach
        </ul>
        {!! $logged_actions->links() !!}
        @if ($logged_actions->lastPage() > 1)
            <a href="{{ $logged_actions->previousPageUrl() }}">Previous</a>
            @for ($i = 1; $i <= $logged_actions->lastPage(); $i++)
                <a href="{{ $logged_actions->url($i) }}">{{ $i }}</a>
            @endfor
            <a href="{{ $logged_actions->nextPageUrl() }}">Next</a>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="javascript">
        function send(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('add_action') }}",
                data: {
                    name: $("#name").val(),
                    niceness: $("#niceness").val(),
                    _token: "{{ csrf_field() }}"
                }
            });
        }
    </script>
@endsection