<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';

    public string $phone = '';
    public string $address = '';
    public string $school_name = '';
    public string $school_address = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;

        $this->phone = $user->studentProfile->phone ?? '';
        $this->address = $user->studentProfile->address ?? '';
        $this->school_name = $user->studentProfile->school_name ?? '';
        $this->school_address = $user->studentProfile->school_address ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'school_name' => ['required', 'string'],
            'school_address' => ['required', 'string'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update student profile
        $user->studentProfile->update([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'school_name' => $validated['school_name'],
            'school_address' => $validated['school_address'],
        ]);

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-cyan-900 ">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-600 ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-neutral-800 ">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification"
                            class="underline text-sm text-neutral-600 -neutral-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 ">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        @if (!in_array(auth()->user()->role_id, [1, 2]))
            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('No. Handphone')" />
                <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 block w-full"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('Alamat')" />
                <x-text-input wire:model="address" id="address" name="address" type="text"
                    class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <!-- School Name -->
            <div>
                <x-input-label for="school_name" :value="__('Nama Sekolah')" />
                <x-text-input wire:model="school_name" id="school_name" name="school_name" type="text"
                    class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('school_name')" />
            </div>

            <!-- School Address -->
            <div>
                <x-input-label for="school_address" :value="__('Alamat Sekolah')" />
                <x-text-input wire:model="school_address" id="school_address" name="school_address" type="text"
                    class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('school_address')" />
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
