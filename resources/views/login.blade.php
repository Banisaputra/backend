@extends('layouts.auth')

@section('title', 'Log In')

@section('content')
@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert class="mb-8" label="{{ $error }}" />
  @endforeach
@endif

<h3 class="text-2xl font-semibold mb-8 text-green-500">Sign in to your account</h3>
<form class="mt-6 space-y-6" method="post">
  @csrf
  
  <x-text-input required autofocus name="username" type="text" label="Username" />
  <x-text-input required name="password" type="password" label="Password" />
  <x-button label="Log in" />
</form>
@endsection