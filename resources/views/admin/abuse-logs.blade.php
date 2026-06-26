<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Abuse Log') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-5">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Blocked by reason</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($byReason as $r)
                            <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-sm text-gray-700 dark:text-gray-200">
                                {{ $r->reason }} <strong>{{ $r->hits }}</strong>
                            </span>
                        @empty
                            <span class="text-gray-400 text-sm">No abuse recorded yet.</span>
                        @endforelse
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-5">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Top offending IPs</h3>
                    <div class="space-y-1 text-sm">
                        @forelse ($topIps as $ip)
                            <div class="flex justify-between text-gray-700 dark:text-gray-300">
                                <span class="font-mono">{{ $ip->ip_address }}</span>
                                <span class="font-semibold">{{ $ip->hits }}</span>
                            </div>
                        @empty
                            <span class="text-gray-400">—</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Log table -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 text-sm text-gray-500 dark:text-gray-400">
                    {{ $logs->total() }} blocked attempts (most recent first)
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/40 text-gray-500 dark:text-gray-400 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">Time</th>
                                <th class="px-4 py-3 text-left">Reason</th>
                                <th class="px-4 py-3 text-left">IP</th>
                                <th class="px-4 py-3 text-left">Attempted URL / detail</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                            @forelse ($logs as $log)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $log->created_at?->format('Y-m-d H:i:s') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                            @if (in_array($log->reason, ['safe_browsing','safe_browsing_rescan','blocklist','ssrf','internal'])) bg-red-100 text-red-700
                                            @elseif ($log->reason === 'captcha') bg-yellow-100 text-yellow-700
                                            @else bg-gray-100 text-gray-600 @endif">
                                            {{ $log->reason }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-mono text-xs whitespace-nowrap">{{ $log->ip_address ?? '—' }}</td>
                                    <td class="px-4 py-3 max-w-md truncate" title="{{ $log->detail }}">{{ $log->detail }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">No abuse blocked yet — that's good!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $logs->links() }}</div>
        </div>
    </div>
</x-app-layout>
