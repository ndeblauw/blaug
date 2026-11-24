@props([
    'name',
    'label',
    'placeholder' => '',
    'value' => '',
    'id' => $name,
    'required' => false,
    'rows' => 4,
])

<div class="space-y-1">
    <label for="{{ $id }}" class="block font-mono text-[10px] font-bold uppercase tracking-[0.16em] text-blue-950/60">{{ $label }}@if($required)<span class="ml-1" aria-hidden="true">*</span>@endif</label>
    <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" class="block w-full border-2 border-blue-950/30 bg-white px-4 py-3 text-sm text-blue-950 outline-none transition focus:border-blue-600 focus:ring-0 {{ $errors->has($name) ? 'border-red-500' : 'border-blue-950/30' }}" placeholder="{{ $placeholder }}" @required($required)>{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
