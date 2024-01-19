<label for="">{{ str()->headline($name) }}</label><br/>
@if ($range)
    <div class="mb-1">
        <label for="" class="w-1/4">From</label>
        <x-livewire-datatables::input type="date" class="w-full" wire:model.live="filters.{{ str()->snake($name) }}.from" />
    </div>
    <div>
        <label for="" class="w-1/4">To</label>
        <x-livewire-datatables::input type="date" class="w-full" wire:model.live="filters.{{ str()->snake($name) }}.to" />
    </div>
@else
    <x-livewire-datatables::input type="date" class="w-full" wire:model.live="filters.{{ str()->snake($name) }}" />
@endif
