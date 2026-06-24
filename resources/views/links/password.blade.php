<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
                <h2 class="text-center text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Password Protected Link
                </h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
                    This link is password protected. Please enter the password to continue.
                </p>
                <form method="GET" action="{{ route('redirect', $link->slug) }}">
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Password
                        </label>
                        <input type="password" name="password" id="password" required 
                               class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    </div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Continue
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

