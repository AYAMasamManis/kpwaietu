<section>
    <header>
        {{-- Mengubah warna teks header menjadi putih --}}
        <h2 class="text-lg font-medium" style="color: white !important;">
            {{ __('Profile Information') }}
        </h2>

        {{-- Mengubah warna teks deskripsi menjadi putih --}}
        <p class="mt-1 text-sm" style="color: white !important;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" :value="old('email', $user->email)" required autocomplete="username" />
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    {{-- Mengubah warna teks --}}
                    <p class="text-sm mt-2" style="color: white !important;">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            {{-- Menggunakan kelas cta-button untuk tombol Save --}}
            <button type="submit" class="cta-button bg-blue-600">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
