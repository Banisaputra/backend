@extends('layouts.auth')

@section('title', 'Get Started')

@section('content')
<h3 class="text-4xl font-semibold mt-8 mb-4 first:mt-0 text-green-500">Welcome!</h3>
<p class="leading-relaxed text-gray-500 text-sm">Please provide the following information. Don't worry, you can always change these settings later.</p>
<form class="mt-8 space-y-6" method="post" action="{{ route('installation') }}">
  @csrf
  
  <x-text-input required name="site_name" type="text" placeholder="DKP Boyolali" label="Site Title" />
  <x-text-input helperText="Your username must be 15 characters or less and contain only letters, numbers, and underscores and no spaces." required name="username" type="text" placeholder="dkpboyolali" label="Username" />
  <x-text-input required name="email" type="email" placeholder="dkp@boyolali.go.id" label="Email" />
  <x-text-input required name="password" type="password" placeholder="********" label="Password" />
  <x-text-input required name="password_confirmation" type="password" placeholder="********" label="Retype Password" />
  <x-button label="Get Started" />
</form>
@endsection