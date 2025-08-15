<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;

new #[Layout('layouts.guest')] class extends Component 
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));
        // Assign "User" role
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $user->assignRole($userRole);

        Auth::login($user);

        // Redirect to home page
        $this->redirect(route('products.index', absolute: false), navigate: true);
        //  $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="max-w-md w-full mx-auto bg-white rounded-lg overflow-hidden p-8">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
        <p class="text-gray-600 mt-2">Join us today to get started</p>
    </div>

    <form wire:submit="register" class="space-y-5">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-text-input wire:model="name" id="name"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-text-input wire:model="email" id="email"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="email" name="email" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-text-input wire:model="password" id="password"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="pt-2">
            <x-primary-button
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-gray-600 pt-2">
            {{ __('Already have an account?') }}
            <a wire:navigate href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                {{ __('Sign in') }}
            </a>
        </div>
    </form>
</div>
