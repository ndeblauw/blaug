@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-mono text-[10px] font-bold uppercase tracking-[0.16em] text-blue-950/60']) }}>
    {{ $value ?? $slot }}
</label>
