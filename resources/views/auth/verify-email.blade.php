<x-guest-layout>

    <div class=" mb-4 underline text-sm text-gray-600 dark:text-gray-400">
            {{ __('Thanks for signin up! Please verify your email by clicking the link below') }}
    </div>

        <div class="flex items-center justify-end mt-4">
            @if (session('status') == 'verification-link-sent')
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            @endif

        </div>

         <form method="POST" action="{{ route('verification.send') }}">
        @csrf

          <x-primary-button class="ms-3">
                {{ __('Resend Verification Email') }}
            </x-primary-button>

         </form>

         <form method="POST" action="{{ route('logout') }}">
        @csrf

          <x-primary-button class="ms-3">
                {{ __('Log Out') }}
            </x-primary-button>

         </form>

         <div class="flex justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                    {{ __('Don\'t have an account?') }}
                </a>
        </div>


</x-guest-layout>
