<div 
    x-data="{ show: !localStorage.getItem('cookie-consent') }" 
    x-show="show" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed bottom-0 left-0 right-0 z-50 p-4 bg-gray-900 dark:bg-black border-t border-gray-700"
    style="display: none;"
>
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-300 text-center sm:text-left">
            <p>
                We use cookies to enhance your experience, serve personalized ads, and analyze traffic. 
                By clicking "Accept All", you consent to our use of cookies. 
                <a href="{{ route('pages.privacy') }}" class="text-blue-400 hover:underline">Learn more</a>
            </p>
        </div>
        <div class="flex gap-3 flex-shrink-0">
            <button 
                x-on:click="localStorage.setItem('cookie-consent', 'essential'); show = false"
                class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors"
            >
                Essential Only
            </button>
            <button 
                x-on:click="localStorage.setItem('cookie-consent', 'all'); show = false"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors"
            >
                Accept All
            </button>
        </div>
    </div>
</div>
