<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center border-2 border-blue-950 bg-white px-5 py-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950 transition hover:bg-blue-950 hover:text-white focus:outline-none disabled:opacity-25']) }}>
    {{ $slot }}
</button>
