@props(['class' => 'h-8', 'snapWhite' => false])

<div class="flex items-center space-x-2 {{ $class }}">
    <!-- Icon: Link chain with arrow -->
    <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-full w-auto">
        <!-- First chain link -->
        <rect x="8" y="12" width="8" height="8" rx="1.5" 
              fill="currentColor" class="text-blue-600 dark:text-blue-400"/>
        <!-- Second chain link -->
        <rect x="16" y="12" width="8" height="8" rx="1.5" 
              fill="currentColor" class="text-blue-600 dark:text-blue-400"/>
        <!-- Arrow pointing right -->
        <path d="M24 16L28 16M28 16L25.5 13.5M28 16L25.5 18.5" 
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
              class="text-blue-600 dark:text-blue-400"/>
    </svg>
    
    <!-- Text -->
    <span class="text-xl md:text-2xl font-bold whitespace-nowrap">
        <span class="{{ $snapWhite ? 'text-white' : 'text-gray-900 dark:text-white' }}">Snap</span><span class="text-blue-600 dark:text-blue-400">URL</span><span class="text-gray-500 dark:text-gray-400 font-normal">.to</span>
    </span>
</div>
