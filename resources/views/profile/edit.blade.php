<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
                <p class="text-gray-500 mt-1">Manage your account information and preferences</p>
            </div>

            <!-- Ad Banner -->
            <x-adsense slot="header" />

            <div class="space-y-6">
                <!-- Profile Information -->
                <div class="bg-white rounded-2xl soft-shadow p-6 sm:p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 brand-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Profile Information</h2>
                            <p class="text-gray-500 text-sm">Update your account's profile information and email address</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus">
                            @error('name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus">
                            @error('email')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="brand-gradient text-white px-6 py-2.5 rounded-xl font-semibold hover:opacity-90 transition-opacity">
                                Save Changes
                            </button>
                        </div>

                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-green-600">Profile updated successfully.</p>
                        @endif
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-2xl soft-shadow p-6 sm:p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Update Password</h2>
                            <p class="text-gray-500 text-sm">Ensure your account is using a secure password</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus">
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" id="password" name="password" autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus">
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus">
                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2.5 rounded-xl font-semibold transition-colors">
                                Update Password
                            </button>
                        </div>

                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-green-600">Password updated successfully.</p>
                        @endif
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="bg-white rounded-2xl soft-shadow p-6 sm:p-8 border-2 border-red-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Delete Account</h2>
                            <p class="text-gray-500 text-sm">Permanently delete your account and all data</p>
                        </div>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                        <p class="text-red-700 text-sm">
                            <strong>Warning:</strong> Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.
                        </p>
                    </div>

                    <form method="post" action="{{ route('profile.destroy') }}" x-data="{ confirmDelete: false }">
                        @csrf
                        @method('delete')

                        <div x-show="!confirmDelete">
                            <button type="button" x-on:click="confirmDelete = true" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-xl font-semibold transition-colors">
                                Delete Account
                            </button>
                        </div>

                        <div x-show="confirmDelete" x-transition class="space-y-4">
                            <div>
                                <label for="delete_password" class="block text-sm font-medium text-gray-700 mb-2">Enter your password to confirm</label>
                                <input type="password" id="delete_password" name="password"
                                    class="w-full px-4 py-3 border border-red-200 rounded-xl text-gray-800 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200">
                                @error('password', 'userDeletion')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex gap-3">
                                <button type="button" x-on:click="confirmDelete = false" class="px-6 py-2.5 border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 font-medium">
                                    Cancel
                                </button>
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-xl font-semibold transition-colors">
                                    Yes, Delete My Account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Ad -->
            <x-adsense slot="footer" />
        </div>
    </div>
</x-app-layout>
