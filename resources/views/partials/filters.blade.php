<div class="relative flex" x-data="{ open: false }">
    <button @click.prevent="open = !open" class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <i class="fas fa-filter mr-1"></i> <span class="mr-2 bg-indigo-800 h-5 w-5 flex items-center text-xs justify-center text-white p-1 rounded-full">{{ $filterCount = count(array_filter($this->filters ?? [])) }}</span> {{ str()->plural('Filter', $filterCount) }}
    </button>
    <div x-cloak x-show="open" @click.away="open = false"
        class="absolute bg-white border border-gray-300 rounded p-4 z-10 md:right-0 top-full mt-2 w-56 text-gray-700">
        @foreach ($filterOptions as $filter)
            <div class="py-1">
                {{ $filter->render() }}
            </div>
        @endforeach
        <button
            class="mt-2 w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            wire:click="resetFilters">
            Clear
        </button>
    </div>
</div>
