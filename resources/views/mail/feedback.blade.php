@extends('layouts.email') <!-- Optional: Use a layout for the email -->

@section('content')
    <p>{{ $fullname }} has sent feedback about your website. Below are the comments left by the user:</p>
    <p>{{ $comment }}</p>
@endsection