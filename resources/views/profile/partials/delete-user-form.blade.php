<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <!-- Trigger Modal -->
    <button 
        x-data 
        @click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
    >
        Delete Account
    </button>

    <!-- Modal -->
    <div 
        x-data="{ show: @js($errors->userDeletion->isNotEmpty()) }" 
        x-show="show" 
        @open-modal.window="if ($event.detail === 'confirm-user-deletion') show = true"
        @close.window="show = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50"
    >
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.
                </p>

                <div class="mt-4">
                    <label for="password" class="sr-only">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none"
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button 
                        type="button" 
                        @click="show = false"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                    >
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
