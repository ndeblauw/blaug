<footer class="bg-blue-950 text-white">
    <div class="bg-stripes-white h-3 w-full"></div>

    <div class="mx-auto grid max-w-[1440px] gap-12 px-6 py-16 lg:grid-cols-12 lg:px-12">
        <div class="lg:col-span-6">
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center bg-[#d9ff3f] text-lg font-black text-blue-950">B</span>
                <span class="text-2xl font-black uppercase tracking-[-0.05em]">BLAUG</span>
            </a>

            <p class="mt-6 max-w-sm text-sm leading-7 text-blue-100/70">
                Independent stories, sharp opinions and the good kind of noise.
                Written by people who still believe in reading.
            </p>
        </div>

        <div class="lg:col-span-3">
            <p class="font-mono text-[10px] uppercase tracking-[0.24em] text-[#d9ff3f]">Sections</p>

            <ul class="mt-5 space-y-3 text-sm">
                @foreach($menu as $label => $url)
                    <li><a href="{{ $url }}" class="text-blue-100/80 transition hover:text-white">{{ $label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="lg:col-span-3">
            <p class="font-mono text-[10px] uppercase tracking-[0.24em] text-[#d9ff3f]">Your account</p>

            <ul class="mt-5 space-y-3 text-sm">
                @auth
                    <li><a href="{{ route('dashboard') }}" class="text-blue-100/80 transition hover:text-white">Dashboard</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="text-blue-100/80 transition hover:text-white">Profile</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="text-blue-100/80 transition hover:text-white">Login</a></li>
                    <li><a href="{{ route('register') }}" class="text-blue-100/80 transition hover:text-white">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <div class="border-t border-white/15">
        <div class="mx-auto flex max-w-[1440px] flex-col gap-2 px-6 py-5 font-mono text-[10px] uppercase tracking-[0.2em] text-blue-100/50 sm:flex-row sm:items-center sm:justify-between lg:px-12">
            <p>BLAUG &copy; {{ date('Y') }}</p>
            <p>Printed on the internet. No corners were rounded.</p>
        </div>
    </div>
</footer>
