@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<h3 class="text-3xl font-semibold mb-8 text-green-500">Create a new account</h3>
<form class="mt-6 space-y-6" method="post">
  @csrf
  
  <x-text-input helperText="Your username must be 15 characters or less and contain only letters, numbers, and underscores and no spaces." name="username" required type="text" placeholder="dkpboyolali" label="Your Username" />
  <x-text-input name="email" required type="email" placeholder="dkp@boyolali.go.id" label="Your Email" />
  <x-text-input name="password" required type="password" placeholder="********" label="Your Password" />
  <x-text-input required name="password_confirmation" type="password" placeholder="********" label="Retype Password" />
  <x-button label="Create Account" />
</form>
@endsection