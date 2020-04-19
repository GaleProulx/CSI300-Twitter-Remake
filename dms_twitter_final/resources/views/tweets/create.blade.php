@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('post') }}">
    @csrf
    <label for="content">Write a Tweet:</label>
    <input id="content" type="text" name="content" value="{{ old('content') }}" required autofocus>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit" class="submit">
        Post
    </button>
</form>
@endsection
