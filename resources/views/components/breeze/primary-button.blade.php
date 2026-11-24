<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center bg-blue-600 px-5 py-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-white transition hover:bg-blue-950 focus:outline-none']) }}>
    {{ $slot }}
</button>
