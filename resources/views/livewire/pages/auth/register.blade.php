<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\StudentType;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $address = '';
    public string $school_name = '';
    public string $school_address = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string|int $student_type_id = '';
    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'student_type_id' => ['required', 'exists:student_types,id'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'school_name' => ['required', 'string'],
            'school_address' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 3,
        ]);

        // Simpan profil mahasiswa terkait student_type_id
        $user->studentProfile()->create([
            'student_type_id' => $validated['student_type_id'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'school_name' => $validated['school_name'],
            'school_address' => $validated['school_address'],
        ]);

        event(new Registered($user));
        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('No. Handphone')" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" name="phone"
                required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Alamat')" />
            <x-text-input wire:model="address" id="address" class="block mt-1 w-full" type="text" name="address"
                required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- School Name -->
        <div class="mt-4">
            <x-input-label for="school_name" :value="__('Nama Sekolah')" />
            <x-text-input wire:model="school_name" id="school_name" class="block mt-1 w-full" type="text"
                name="school_name" required autofocus autocomplete="school_name" />
            <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
        </div>

        <!-- School Address -->
        <div class="mt-4">
            <x-input-label for="school_address" :value="__('Alamat Sekolah')" />
            <x-text-input wire:model="school_address" id="school_address" class="block mt-1 w-full" type="text"
                name="school_address" required autofocus autocomplete="school_address" />
            <x-input-error :messages="$errors->get('school_address')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="student_type_id" :value="__('Tipe Mahasiswa')" />

            <select wire:model="student_type_id" id="student_type_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Pilih Tipe Mahasiswa</option>
                @foreach (StudentType::all() as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('student_type_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
