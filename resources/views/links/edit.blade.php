<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('links.update', $link) }}">
                        @csrf
                        @method('PUT')

                        <!-- Destination URL -->
                        <div class="mb-4">
                            <x-input-label for="destination_url" :value="__('Destination URL')" />
                            <x-text-input id="destination_url" class="block mt-1 w-full" type="url" name="destination_url" :value="old('destination_url', $link->destination_url)" required />
                            <x-input-error :messages="$errors->get('destination_url')" class="mt-2" />
                        </div>

                        <!-- Slug -->
                        <div class="mb-4">
                            <x-input-label for="slug" :value="__('Custom Slug')" />
                            <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug', $link->slug)" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $link->title)" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">{{ old('description', $link->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password Protection (leave empty to keep current)')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Expires At -->
                        <div class="mb-4">
                            <x-input-label for="expires_at" :value="__('Expiration Date')" />
                            <x-text-input id="expires_at" class="block mt-1 w-full" type="datetime-local" name="expires_at" :value="old('expires_at', $link->expires_at?->format('Y-m-d\TH:i'))" />
                            <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                        </div>

                        <!-- Max Clicks -->
                        <div class="mb-4">
                            <x-input-label for="max_clicks" :value="__('Max Clicks')" />
                            <x-text-input id="max_clicks" class="block mt-1 w-full" type="number" name="max_clicks" :value="old('max_clicks', $link->max_clicks)" min="1" />
                            <x-input-error :messages="$errors->get('max_clicks')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                                <option value="active" {{ old('status', $link->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="paused" {{ old('status', $link->status) === 'paused' ? 'selected' : '' }}>Paused</option>
                                <option value="expired" {{ old('status', $link->status) === 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('links.show', $link) }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 mr-4">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

