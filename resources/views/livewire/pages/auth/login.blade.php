<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

        $user = Auth::user();

    // Check if the user has Admin or Super Admin role
    if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    } else {
        // Redirect regular users to home or another route
        $this->redirectIntended(default: route('products.index', absolute: false), navigate: true);
        
    }
    }
}; ?>

<div class="max-w-md w-full mx-auto bg-white rounded-lg  overflow-hidden p-8">
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Welcome Back</h2>
        <p class="text-gray-600 mt-2">Please sign in to your account</p>
    </div>

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-text-input wire:model="form.email" id="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                            type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-text-input wire:model="form.password" id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <!-- Remember Me -->
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-gray-600">
            {{ __("Don't have an account?") }}
            <a wire:navigate href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                {{ __('Sign up') }}
            </a>
        </div>
    </form>
</div>