<header class="border-b-2 border-blue-950 bg-white">
    <div class="bg-stripes-blue h-2 w-full"></div>

    <div class="mx-auto flex max-w-[1440px] flex-wrap items-center justify-between gap-x-8 gap-y-4 px-6 py-5 lg:px-12">
        <a href="{{ route('welcome') }}" class="group relative flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center bg-blue-950 text-xl font-black text-white transition group-hover:bg-blue-600">
                HS
            </span>

            <span class="text-2xl font-black uppercase leading-none tracking-[-0.05em] text-blue-950">
                {{ config('app.name') }}
            </span>

            <span class="absolute -right-3 -top-1 h-3 w-3 bg-[#d9ff3f]" aria-hidden="true"></span>
        </a>

        <nav class="order-3 flex w-full items-center gap-6 overflow-x-auto lg:order-none lg:w-auto lg:gap-9">
            @foreach($menu as $label => $link)
                @php($isActive = $link !== '' && url()->current() === $link)

                <a
                    href="{{ $link }}"
                    @class([
                        'group relative shrink-0 py-1 font-mono text-[11px] uppercase tracking-[0.2em] transition',
                        'text-blue-950' => $isActive,
                        'text-blue-950/60 hover:text-blue-950' => ! $isActive,
                    ])
                >
                    <span class="mr-1 text-blue-600">0{{ $loop->iteration }}</span>{{ $label }}
                    <span @class([
                        'absolute bottom-0 left-0 h-[3px] bg-[#d9ff3f] transition-all duration-300',
                        'w-full' => $isActive,
                        'w-0 group-hover:w-full' => ! $isActive,
                    ])></span>
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            @auth
                <span class="hidden font-mono text-[10px] uppercase tracking-[0.18em] text-blue-950/60 sm:inline">
                    {{ auth()->user()->name }}
                </span>

                <a href="{{ route('dashboard') }}" class="border-2 border-blue-950 px-4 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.18em] text-blue-950 transition hover:bg-blue-950 hover:text-white">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-2 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.18em] text-blue-950/70 transition hover:text-blue-950">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-blue-600 px-4 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.18em] text-white transition hover:bg-blue-950">
                    Register
                </a>
            @endauth
        </div>
    </div>
</header>
