<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Billing & Plans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($activeSubscription)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Current Subscription</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400">Plan: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $activeSubscription->plan->name }}</span></p>
                                <p class="text-gray-600 dark:text-gray-400">Status: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ ucfirst($activeSubscription->status) }}</span></p>
                                @if($activeSubscription->ends_at)
                                    <p class="text-gray-600 dark:text-gray-400">Ends at: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $activeSubscription->ends_at->format('M d, Y') }}</span></p>
                                @endif
                            </div>
                            @if($activeSubscription->status === 'active')
                                <form action="{{ route('billing.cancel') }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel your subscription?')">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Cancel Subscription
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Available Plans</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($plans as $plan)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 {{ $plan->slug === 'pro' ? 'ring-2 ring-blue-600 dark:ring-blue-400' : '' }}">
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $plan->name }}</h4>
                        <div class="mb-4">
                            <span class="text-4xl font-bold text-gray-900 dark:text-white">${{ number_format($plan->price, 2) }}</span>
                            <span class="text-gray-600 dark:text-gray-400">/{{ $plan->interval }}</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            @if($plan->max_links)
                                <li class="flex items-center text-gray-600 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ $plan->max_links }} links
                                </li>
                            @else
                                <li class="flex items-center text-gray-600 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Unlimited links
                                </li>
                            @endif
                            @if($plan->analytics)
                                <li class="flex items-center text-gray-600 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Advanced analytics
                                </li>
                            @endif
                            @if($plan->api_access)
                                <li class="flex items-center text-gray-600 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    API access
                                </li>
                            @endif
                        </ul>
                        @if(!$activeSubscription || $activeSubscription->plan_id !== $plan->id)
                            <a href="{{ route('billing.checkout', $plan) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                                {{ $activeSubscription ? 'Switch Plan' : 'Subscribe' }}
                            </a>
                        @else
                            <button disabled class="block w-full text-center bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold cursor-not-allowed">
                                Current Plan
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

