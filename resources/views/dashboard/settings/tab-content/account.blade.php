<div class="p-10 bg-gray-50 rounded-b-lg">
  <form class="space-y-6 xl:w-1/2" method="post" action="{{route('me')}}">
    @csrf
    @method('PUT')
    
    <x-text-input :value="Auth()->user()->raw_display_name" name="display_name" type="text" placeholder="DKP Boyolali" label="Your Display Name" />
    <x-text-input disabled :value="Auth()->user()->username" helperText="Your username must be 15 characters or less and contain only letters, numbers, and underscores and no spaces." name="username" type="text" placeholder="dkpboyolali" label="Your Username" />
    <x-text-input :value="Auth()->user()->email" name="email" type="email" placeholder="dkp@boyolali.go.id" label="Your Email" />
    <div>
      <div class="border-t border-gray-200 my-10"></div>
    </div>
    <x-text-input name="password" type="password" placeholder="********" label="Your Password" />
    <x-text-input name="password_confirmation" type="password" placeholder="********" label="Retype Password" />
    <x-button label="Perbarui Data" />
  </form>
</div>
