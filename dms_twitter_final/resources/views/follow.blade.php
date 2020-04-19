@extends('layouts.app')

@section('content')
    @foreach ($follows as $follow)
        <div class="tweet">
            <div class="header">
                {{ $follow->handle_id }} followed
                <a href="/handle/{{ $follow->follow_id }}">{{ $follow->follow_id }}</a> on
                {{ $follow->follow_date }}
            </div>
        </div>
    @endforeach
@endsection
