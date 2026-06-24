<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('links.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Links
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Create New Link</h1>
                <p class="text-gray-500 mt-1">Shorten a long URL and track its performance</p>
            </div>

            <!-- Ad Banner -->
            <x-adsense slot="header" />

            <!-- Form -->
            <div class="bg-white rounded-2xl soft-shadow p-6 sm:p-8">
                <form method="POST" action="{{ route('links.store') }}" class="space-y-6">
                    @csrf

                    <!-- Destination URL -->
                    <div>
                        <label for="destination_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Destination URL <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>
                            <input type="url" id="destination_url" name="destination_url" value="{{ old('destination_url') }}" required autofocus
                                class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus"
                                placeholder="https://example.com/your-long-url">
                        </div>
                        @error('destination_url')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Custom Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            Custom Slug <span class="text-gray-400">(optional)</span>
                        </label>
                        <div class="flex items-center">
                            <span class="px-4 py-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-gray-500 text-sm">{{ config('app.url') }}/</span>
                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                class="flex-1 px-4 py-3 border border-gray-200 rounded-r-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus"
                                placeholder="my-custom-link">
                        </div>
                        <p class="mt-1 text-xs text-gray-400">Leave empty for auto-generated slug</p>
                        @error('slug')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-gray-400">(optional)</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus"
                            placeholder="My awesome link">
                        @error('title')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-gray-400">(optional)</span>
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus resize-none"
                            placeholder="Add a note about this link...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Advanced Options -->
                    <div x-data="{ showAdvanced: false }">
                        <button type="button" x-on:click="showAdvanced = !showAdvanced" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
                            <svg class="w-4 h-4 transition-transform" x-bind:class="{ 'rotate-90': showAdvanced }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Advanced Options
                        </button>

                        <div x-show="showAdvanced" x-transition class="mt-4 space-y-4 p-4 bg-gray-50 rounded-xl">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password Protection
                                </label>
                                <input type="password" id="password" name="password"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus"
                                    placeholder="Enter password to protect link">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expiration -->
                            <div>
                                <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-2">
                                    Expiration Date
                                </label>
                                <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at') }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:outline-none input-focus">
                                @error('expires_at')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Max Clicks -->
                            <div>
                                <label for="max_clicks" class="block text-sm font-medium text-gray-700 mb-2">
                                    Max Clicks
                                </label>
                                <input type="number" id="max_clicks" name="max_clicks" value="{{ old('max_clicks') }}" min="1"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none input-focus"
                                    placeholder="Unlimited">
                                @error('max_clicks')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t">
                        <a href="{{ route('links.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-900 font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="brand-gradient text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Create Link
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Ad -->
            <x-adsense slot="footer" />
        </div>
    </div>
</x-app-layout>
