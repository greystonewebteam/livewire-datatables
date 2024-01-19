<label for="">{{ str()->headline($name) }}</label>
<x-livewire-datatables::select class="w-full" wire:model.live="filters.{{ str()->snake($name) }}">
    @foreach($options as $value => $text)
        <option value="{{ $value }}">{{ $text }}</option>
    @endforeach
</x-livewire-datatables::select>
