<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(
            default: route('dashboard', absolute: false),
            navigate: true
        );
    }
};
?>

<div
    class="relative min-h-screen w-full overflow-hidden bg-slate-900"
    style="
        background-image: url('{{ asset('images/client-login.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    "
>

    {{-- =========================================================
         BACKGROUND OVERLAY
         Keeps the client's artwork visible while improving
         readability of the login card.
    ========================================================== --}}
    <div class="absolute inset-0 bg-slate-950/20"></div>


    {{-- =========================================================
         SOFT GRADIENT FOR FORM READABILITY
    ========================================================== --}}
    <div
        class="absolute inset-0 bg-gradient-to-r
               from-transparent
               via-transparent
               to-slate-950/25
               pointer-events-none"
    ></div>


    {{-- =========================================================
         LOGIN AREA
    ========================================================== --}}
    <div
        class="relative z-10 min-h-screen
               flex items-center justify-center
               lg:justify-end
               px-4 sm:px-6 lg:px-16
               py-8"
    >

        {{-- =====================================================
             LOGIN CARD
        ====================================================== --}}
        <div class="w-full max-w-md">

            <div
                class="rounded-3xl
                       bg-white/96
                       backdrop-blur-xl
                       shadow-2xl
                       border border-white/70
                       px-6 py-8
                       sm:px-9 sm:py-10"
            >

                {{-- =================================================
                     SYSTEM ICON
                ================================================== --}}
                <div class="flex justify-center mb-6">

                    <div
                        class="w-16 h-16
                               rounded-2xl
                               bg-blue-600
                               flex items-center justify-center
                               shadow-xl
                               shadow-blue-600/30"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-9 h-9 text-white"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 2.5C12 2.5 5.5 10 5.5 14.5A6.5 6.5 0 0012 21a6.5 6.5 0 006.5-6.5C18.5 10 12 2.5 12 2.5z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.5 15.5c.5 1.2 1.4 1.9 2.8 2"
                            />

                        </svg>

                    </div>

                </div>


                {{-- =================================================
                     WELCOME TEXT
                ================================================== --}}
                <div class="text-center mb-8">

                    <h1
                        class="text-3xl sm:text-4xl
                               font-extrabold
                               tracking-tight
                               text-slate-800"
                    >
                        Welcome Back
                    </h1>

                    <p
                        class="mt-2
                               text-sm sm:text-base
                               text-slate-500"
                    >
                        Sign in to your Maji Mazuri account
                    </p>

                </div>


                {{-- =================================================
                     SESSION STATUS
                ================================================== --}}
                <x-auth-session-status
                    class="mb-5"
                    :status="session('status')"
                />


                {{-- =================================================
                     LOGIN FORM
                ================================================== --}}
                <form
                    wire:submit="login"
                    class="space-y-5"
                >

                    {{-- =================================================
                         EMAIL
                    ================================================== --}}
                    <div>

                        <x-input-label
                            for="email"
                            :value="__('Email Address')"
                            class="font-semibold text-slate-700"
                        />

                        <div class="relative mt-2">

                            {{-- Email Icon --}}
                            <div
                                class="absolute inset-y-0 left-0
                                       pl-4
                                       flex items-center
                                       pointer-events-none"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-5 h-5 text-slate-400"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.75L2.25 6.75"
                                    />

                                </svg>

                            </div>


                            <x-text-input
                                wire:model="form.email"
                                id="email"
                                class="block w-full
                                       pl-11 pr-4 py-3.5
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       text-slate-800
                                       placeholder-slate-400
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       transition"
                                type="email"
                                name="email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your email address"
                            />

                        </div>


                        <x-input-error
                            :messages="$errors->get('form.email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         PASSWORD
                    ================================================== --}}
                    <div>

                        <div
                            class="flex items-center justify-between gap-4"
                        >

                            <x-input-label
                                for="password"
                                :value="__('Password')"
                                class="font-semibold text-slate-700"
                            />


                            {{-- Forgot Password --}}
                            @if (Route::has('password.request'))

                                <a
                                    href="{{ route('password.request') }}"
                                    wire:navigate
                                    class="text-sm
                                           font-semibold
                                           text-blue-600
                                           hover:text-blue-700
                                           hover:underline
                                           transition
                                           whitespace-nowrap"
                                >
                                    Forgot password?
                                </a>

                            @endif

                        </div>


                        <div class="relative mt-2">

                            {{-- Password Icon --}}
                            <div
                                class="absolute inset-y-0 left-0
                                       pl-4
                                       flex items-center
                                       pointer-events-none"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-5 h-5 text-slate-400"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V7.875a4.5 4.5 0 00-9 0V10.5m-1.125 0h11.25A1.875 1.875 0 0119.5 12.375v6.75A1.875 1.875 0 0117.625 21h-11.25A1.875 1.875 0 014.5 19.125v-6.75A1.875 1.875 0 016.375 10.5z"
                                    />

                                </svg>

                            </div>


                            <x-text-input
                                wire:model="form.password"
                                id="password"
                                class="block w-full
                                       pl-11 pr-4 py-3.5
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       text-slate-800
                                       placeholder-slate-400
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       transition"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            />

                        </div>


                        <x-input-error
                            :messages="$errors->get('form.password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         REMEMBER ME
                    ================================================== --}}
                    <div>

                        <label
                            for="remember"
                            class="inline-flex
                                   items-center
                                   cursor-pointer
                                   select-none"
                        >

                            <input
                                wire:model="form.remember"
                                id="remember"
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4
                                       rounded
                                       border-slate-300
                                       text-blue-600
                                       shadow-sm
                                       focus:ring-blue-500
                                       focus:ring-offset-0"
                            >

                            <span
                                class="ms-2
                                       text-sm
                                       font-medium
                                       text-slate-600"
                            >
                                {{ __('Remember me') }}
                            </span>

                        </label>

                    </div>


                    {{-- =================================================
                         LOGIN BUTTON
                    ================================================== --}}
                    <div class="pt-1">

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="w-full
                                   min-h-[52px]
                                   flex items-center
                                   justify-center
                                   gap-2
                                   px-6 py-3.5
                                   rounded-xl
                                   bg-blue-600
                                   hover:bg-blue-700
                                   active:bg-blue-800
                                   text-white
                                   font-bold
                                   shadow-lg
                                   shadow-blue-600/25
                                   hover:shadow-blue-600/35
                                   transition-all
                                   duration-200
                                   disabled:opacity-60
                                   disabled:cursor-not-allowed
                                   disabled:hover:bg-blue-600"
                        >

                            {{-- Loading --}}
                            <svg
                                wire:loading
                                class="animate-spin w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >

                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                />

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                                />

                            </svg>


                            {{-- Login Icon --}}
                            <svg
                                wire:loading.remove
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 12h9m0 0l-3.75-3.75M21 12l-3.75 3.75"
                                />

                            </svg>


                            <span wire:loading.remove>
                                {{ __('Log in') }}
                            </span>


                            <span wire:loading>
                                Signing in...
                            </span>

                        </button>

                    </div>

                </form>


                {{-- =================================================
                     FOOTER
                ================================================== --}}
                <div
                    class="mt-8
                           pt-6
                           border-t
                           border-slate-200"
                >

                    <p
                        class="text-xs
                               font-medium
                               text-slate-400
                               text-center"
                    >
                        Maji Mazuri Water Billing & Customer
                        Management System
                    </p>

                    <p
                        class="text-xs
                               text-slate-400
                               mt-1
                               text-center"
                    >
                        Secure access for authorized users
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

