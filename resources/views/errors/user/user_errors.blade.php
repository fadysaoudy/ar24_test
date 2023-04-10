@extends('layouts.app')

@section('user_not_found')
    <div class="container">
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    </div>
@endsection
