<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Link Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Link Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Link Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Short URL</label>
                                    <div class="mt-1 flex items-center space-x-2">
                                        <input type="text" value="{{ $link->short_url }}" readonly class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="shortUrl">
                                        <button onclick="copyToClipboard()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors" id="copyButton">
                                            Copy
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Destination URL</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 break-all">{{ $link->destination_url }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-mono">{{ $link->slug }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Clicks</label>
                                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $link->click_count }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unique Clicks</label>
                                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $link->unique_click_count }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $link->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 
                                           ($link->status === 'paused' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' : 
                                           'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100') }}">
                                        {{ ucfirst($link->status) }}
                                    </span>
                                </div>

                                <div class="flex space-x-4">
                                    <a href="{{ route('links.edit', $link) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
                                    <a href="{{ route('links.qrcode', ['link' => $link->id, 'format' => 'png']) }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Download QR Code
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Chart -->
                    @if($analytics->count() > 0)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Click Analytics (Last 30 Days)</h3>
                                <canvas id="analyticsChart" height="100"></canvas>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- QR Code -->
                <div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">QR Code</h3>
                            <div class="flex justify-center">
                                <img src="{{ route('links.qrcode', ['link' => $link->id, 'format' => 'svg']) }}" alt="QR Code" class="w-64 h-64">
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('links.qrcode', ['link' => $link->id, 'format' => 'png']) }}" download class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    Download PNG
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            function copyToClipboard() {
                const shortUrlInput = document.getElementById('shortUrl');
                const copyButton = document.getElementById('copyButton');
                const originalText = copyButton.textContent;
                
                // Select the text
                shortUrlInput.select();
                shortUrlInput.setSelectionRange(0, 99999); // For mobile devices
                
                try {
                    // Try modern clipboard API first
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(shortUrlInput.value).then(function() {
                            copyButton.textContent = 'Copied!';
                            copyButton.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                            copyButton.classList.add('bg-green-500');
                            
                            setTimeout(function() {
                                copyButton.textContent = originalText;
                                copyButton.classList.remove('bg-green-500');
                                copyButton.classList.add('bg-blue-500', 'hover:bg-blue-700');
                            }, 2000);
                        }).catch(function() {
                            // Fallback to execCommand
                            fallbackCopy();
                        });
                    } else {
                        // Fallback to execCommand for older browsers or non-secure contexts
                        fallbackCopy();
                    }
                } catch (err) {
                    // Fallback to execCommand
                    fallbackCopy();
                }
                
                function fallbackCopy() {
                    try {
                        const successful = document.execCommand('copy');
                        if (successful) {
                            copyButton.textContent = 'Copied!';
                            copyButton.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                            copyButton.classList.add('bg-green-500');
                            
                            setTimeout(function() {
                                copyButton.textContent = originalText;
                                copyButton.classList.remove('bg-green-500');
                                copyButton.classList.add('bg-blue-500', 'hover:bg-blue-700');
                            }, 2000);
                        } else {
                            alert('Failed to copy. Please select and copy manually.');
                        }
                    } catch (err) {
                        alert('Failed to copy. Please select and copy manually.');
                    }
                }
            }

            @if($analytics->count() > 0)
            const ctx = document.getElementById('analyticsChart');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($analytics->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))->values()) !!},
                    datasets: [{
                        label: 'Clicks',
                        data: {!! json_encode($analytics->pluck('clicks')->values()) !!},
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1
                    }, {
                        label: 'Unique Clicks',
                        data: {!! json_encode($analytics->pluck('unique_clicks')->values()) !!},
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            @endif
        </script>
    @endpush
</x-app-layout>

