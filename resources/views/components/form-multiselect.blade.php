@props([
    'name',
    'label',
    'options' => [],
    'value' => [],
    'id' => $name,
    'required' => false,
])

@php
    $selectedValues = array_map('strval', (array) old($name, $value));
@endphp

<div class="space-y-1">
    <label for="{{ $id }}" class="block font-mono text-[10px] font-bold uppercase tracking-[0.16em] text-blue-950/60">{{ $label }}@if($required)<span class="ml-1" aria-hidden="true">*</span>@endif</label>
    <select id="{{ $id }}" name="{{ $name }}[]" multiple class="block w-full border-2 border-blue-950/30 bg-white px-4 py-3 text-sm text-blue-950 outline-none transition focus:border-blue-600 focus:ring-0 {{ $errors->has($name) ? 'border-red-500' : 'border-blue-950/30' }}" @required($required)>
        @foreach($options as $option)
            <option value="{{ $option['key'] }}" @selected(in_array((string) $option['key'], $selectedValues, true))>{{ $option['value'] }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
