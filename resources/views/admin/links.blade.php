<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Links / URL Shortening Activity') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between gap-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $links->total() }} links</span>
                    <form method="GET" class="flex gap-2">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search URL or slug..."
                               class="px-3 py-1.5 text-sm rounded-md border-gray-300 dark:bg-gray-900 dark:border-gray-600">
                        <button class="px-3 py-1.5 text-sm bg-gray-800 text-white rounded-md">Search</button>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/40 text-gray-500 dark:text-gray-400 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">Short</th>
                                <th class="px-4 py-3 text-left">Destination</th>
                                <th class="px-4 py-3 text-left">By</th>
                                <th class="px-4 py-3 text-left">Clicks</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">Created</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                            @forelse ($links as $link)
                                <tr>
                                    <td class="px-4 py-3">{{ $link->id }}</td>
                                    <td class="px-4 py-3 font-mono text-xs">{{ $link->slug }}</td>
                                    <td class="px-4 py-3 max-w-xs truncate" title="{{ $link->destination_url }}">
                                        <a href="{{ $link->destination_url }}" target="_blank" rel="noopener nofollow"
                                           class="text-blue-600 hover:underline">{{ \Illuminate\Support\Str::limit($link->destination_url, 60) }}</a>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $link->user?->email ?? 'anonymous' }}
                                    </td>
                                    <td class="px-4 py-3">{{ $link->click_count }}</td>
                                    <td class="px-4 py-3">
                                        @if ($link->status === 'active')
                                            <span class="px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs">active</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-700 text-xs">{{ $link->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $link->created_at?->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <form method="POST" action="{{ route('admin.links.destroy', $link) }}"
                                              onsubmit="return confirm('Delete this link?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="px-4 py-6 text-center text-gray-400">No links found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $links->links() }}</div>
        </div>
    </div>
</x-app-layout>
