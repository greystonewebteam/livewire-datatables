<div class="relative flex" x-data="{ open: false }">
    <button @click.prevent="open = !open" class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:border-gray-500">
     Columns
    </button>
    <div x-cloak x-show="open" @click.away="open = false"
        class="absolute bg-white border border-gray-300 rounded py-4 z-10 md:right-0 top-full mt-2 w-56 text-gray-700">
        <div class="overflow-y-auto max-h-96">
            @foreach ($columns as $column)
                @if (empty($column->getName()))
                    @continue
                @endif
                <label class="py-2 px-4 flex items-center gap-2 cursor-pointer hover:bg-gray-100">
                    <x-input type="checkbox" wire:model="selectedColumns" value="{{ $column->getColumn() }}" /> {{ $column->getName() }}
                </label>
            @endforeach
        </div>
        <div class="px-4">
            <button
                class="mt-2 w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:border-gray-500"
                wire:click="resetColumns">
                Reset
            </button>
        </div>
    </div>
</div>