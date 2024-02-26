<div class="greystoneweb-datatable">
    @assets
        <link rel="stylesheet" href="/vendor/livewire-datatables/css/styles.css" />
    @endassets

    <div class="flex justify-between flex-wrap items-center relative">
        <div class="flex gap-2 flex-wrap-reverse">
            @if ($showSearch)
                <x-livewire-datatables::input type="search" class="sm:w-64 flex-1" wire:model.live.debounce.350ms="search"
                    placeholder="{{ $searchPlaceholder }}" />
            @endif
            @if (!empty($filterOptions))
                @include('livewire-datatables::partials.filters')
            @endif
            @if ($selectableColumns)
                @include('livewire-datatables::partials.columns-dropdown')
            @endif
        </div>
        <div class="flex items-center gap-4 sm:mb-0 mb-2">
            @if ($actionsView)
                <div class="flex items-center gap-2">
                    @include($actionsView)
                </div>
            @endif
        </div>
        <div>
            @if ($showPerPage)
                <x-livewire-datatables::select wire:model.live="perPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </x-livewire-datatables::select>
            @endif
        </div>
        <div class="w-full mt-6"></div>
        <div class="w-full h-0.5 bg-white overflow-hidden" wire:loading.delay>
            <div class="w-3/4 h-full bg-blue-800 animate-slide"></div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle" wire:loading.class="opacity-50">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="shadow">
                            <tr class="divide-x divide-gray-200 border-t border-gray-200">
                                @foreach ($this->selectedColumnObjects ?? $columns as $column)
                                    @if ($column->getHide())
                                        @continue
                                    @endif
                                    <th scope="col"
                                        @class(['px-6 py-3.5 text-left text-sm font-semibold text-gray-900', ...$column->getClasses()])>
                                        @if ($column->isSortable())
                                            <button type="button" class="flex font-bold gap-2 items-center group" wire:click.prevent="toggleSort('{{ $column->getColumn() }}')">
                                                {{ $column->getName() }}
                                                @if (isset($sorts[$column->getColumn()]))
                                                    <i @class(['fas', 'fa-angle-up' => $sorts[$column->getColumn()] === 'asc', 'fa-angle-down' => $sorts[$column->getColumn()] === 'desc'])></i>
                                                @else
                                                    <span class="group-hover:opacity-100 opacity-0">
                                                        <i class="fas fa-angle-up"></i>
                                                    </span>
                                                @endif
                                            </button>
                                        @else
                                            {{ $column->getName() }}
                                        @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @if ($rows->total())
                                @if ($selectableColumns)
                                    @foreach ($rows as $row)
                                        <tr class="even:bg-gray-50">
                                            @foreach ($this->selectedColumnObjects as $column)
                                                <x-livewire-datatables::cell>
                                                    {!! $column->display($row) !!}
                                                </x-livewire-datatables::cell>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($rows as $row)
                                        <tr class="even:bg-gray-50">
                                            @include($rowView, $row)
                                        </tr>
                                    @endforeach
                                @endif
                            @else
                                <tr>
                                    <td class="text-center py-12 text-xl text-gray-500" colspan="{{ count($this->selectedColumnObjects ?? $columns) }}">
                                        @include('livewire-datatables::partials.empty')
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($rows->hasPages())
                <div class="px-3 py-4">
                    {{ $rows->links() }}
                </div>
            @endif
        </div>
    </div>

    @if ($footerView)
        @include($footerView)
    @endif

    @if ($modals)
        @include($modals)
    @endif
</div>
