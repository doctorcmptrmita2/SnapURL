<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Users') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">{{ session('success') }}</div>
            @endif
            @error('error')
                <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-800 rounded-lg">{{ $message }}</div>
            @enderror

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 text-sm text-gray-500 dark:text-gray-400">
                    Total: {{ $users->total() }} users
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/40 text-gray-500 dark:text-gray-400 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">Name</th>
                                <th class="px-4 py-3 text-left">Email</th>
                                <th class="px-4 py-3 text-left">Role</th>
                                <th class="px-4 py-3 text-left">Links</th>
                                <th class="px-4 py-3 text-left">Joined</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-4 py-3">{{ $user->id }}</td>
                                    <td class="px-4 py-3">{{ $user->name }}</td>
                                    <td class="px-4 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        @if ($user->is_admin)
                                            <span class="px-2 py-0.5 rounded-full bg-purple-100 text-purple-700 text-xs font-medium">Admin</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 text-xs">User</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $user->links_count }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->created_at?->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-3 text-right">
                                        @unless ($user->is_admin || $user->id === auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                  onsubmit="return confirm('Delete this user and all their links?')">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                            </form>
                                        @endunless
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-400">No users yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>
