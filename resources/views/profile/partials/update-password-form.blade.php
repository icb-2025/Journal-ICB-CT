<div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Current Password') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('New Password') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
            @error('password', 'updatePassword')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4 pt-2">
            <button 
                type="submit" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 2000)" 
                    class="text-sm text-green-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</div>