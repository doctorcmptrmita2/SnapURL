@props(['slot' => 'content', 'format' => 'auto'])

@php
    $clientId = \App\Models\SiteSetting::get('adsense_client_id');
    $slotId = \App\Models\SiteSetting::get("adsense_{$slot}_slot");
@endphp

@if($clientId && $slotId)
    <div class="adsense-container my-4">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-{{ $clientId }}"
             data-ad-slot="{{ $slotId }}"
             data-ad-format="{{ $format }}"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@else
    <!-- Ad Placeholder: {{ $slot }} -->
    <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-6 my-4 text-center">
        <div class="text-gray-400 text-sm">
            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Advertisement Area ({{ ucfirst($slot) }})
        </div>
    </div>
@endif
