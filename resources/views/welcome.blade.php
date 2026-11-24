@php
    $latestArticle = $recentArticles[0] ?? null;
    $moreRecentArticles = array_slice($recentArticles, 1);
@endphp

<x-site-layout title="Welcome">

    {{-- Intro --}}
    <section class="mx-auto max-w-[1440px] px-6 pt-14 lg:px-12 lg:pt-20">
        <div class="grid gap-10 md:grid-cols-12 md:items-end">
            <div class="md:col-span-8">
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">
                    Independent stories &middot; Est. {{ date('Y') }}
                </p>

                <h1 class="mt-5 text-5xl font-black uppercase leading-[0.88] tracking-[-0.05em] text-blue-950 sm:text-7xl lg:text-[6.5rem]">
                    Read<br>
                    the <span class="relative inline-block">
                        news
                        <span class="absolute -bottom-1 left-0 h-3 w-full bg-[#d9ff3f]" aria-hidden="true"></span>
                    </span>
                </h1>
            </div>

            <div class="md:col-span-4 md:pb-3">
                <div class="ml-auto max-w-xs border-l-2 border-blue-950 pl-5">
                    <p class="text-sm leading-7 text-blue-950/70">
                        A blog for curious people. Long reads, short opinions and the occasional
                        strong take, written by our community.
                    </p>

                    @guest
                        <a href="{{ route('register') }}" class="mt-5 inline-flex items-center gap-3 border-b-2 border-blue-950 pb-1 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950 transition hover:border-blue-600 hover:text-blue-600">
                            Join the readers <span aria-hidden="true">&rarr;</span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    {{-- Latest article --}}
    @if($latestArticle)
        <section class="mx-auto mt-14 max-w-[1440px] px-6 lg:mt-20 lg:px-12">
            <div class="grid gap-12 border-t-2 border-blue-950 pt-10 lg:grid-cols-12 lg:gap-16">
                <a href="{{ route('articles.show', $latestArticle['id']) }}" class="group relative block lg:col-span-7">
                    <div class="absolute -left-3 -top-3 h-full w-full bg-stripes-blue" aria-hidden="true"></div>

                    <div class="relative border-2 border-blue-950 bg-blue-950">
                        <img
                            src="{{ $latestArticle['hero_image'] }}"
                            alt="{{ $latestArticle['title'] }}"
                            class="aspect-[16/10] w-full object-cover grayscale transition duration-700 ease-out group-hover:grayscale-0"
                        >
                    </div>

                    <span class="absolute -bottom-5 left-6 z-10 border-2 border-blue-950 bg-[#d9ff3f] px-4 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950">
                        Latest dispatch
                    </span>

                    <span class="absolute -right-3 top-8 z-10 bg-blue-600 px-3 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-white">
                        No. 01
                    </span>
                </a>

                <div class="flex flex-col justify-between lg:col-span-5">
                    <div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[10px] uppercase tracking-[0.18em] text-blue-950/60">
                            <span>{{ $latestArticle['publish_date'] }}</span>
                            <span class="h-px w-6 bg-blue-950/30"></span>
                            <span class="text-blue-600">{{ $latestArticle['category'] ?? 'Journal' }}</span>
                        </div>

                        <h2 class="mt-5 text-balance text-4xl font-black uppercase leading-[0.95] tracking-[-0.035em] text-blue-950 sm:text-5xl">
                            <a href="{{ route('articles.show', $latestArticle['id']) }}" class="transition hover:text-blue-600">
                                {{ $latestArticle['title'] }}
                            </a>
                        </h2>

                        <p class="mt-5 max-w-md text-[15px] leading-7 text-blue-950/65">
                            {{ $latestArticle['excerpt'] }}
                        </p>

                        <p class="mt-6 font-mono text-[10px] uppercase tracking-[0.18em] text-blue-950/60">
                            By
                            <a href="{{ route('authors.show', $latestArticle['author_id']) }}" class="font-bold text-blue-950 transition hover:text-blue-600">
                                {{ $latestArticle['author_name'] }}
                            </a>
                        </p>
                    </div>

                    <a href="{{ route('articles.show', $latestArticle['id']) }}" class="group mt-10 inline-flex w-fit items-center gap-4 border-b-2 border-blue-950 pb-2 font-mono text-[11px] font-bold uppercase tracking-[0.2em] text-blue-950 transition hover:border-blue-600 hover:text-blue-600">
                        Read the story
                        <span class="transition group-hover:translate-x-1" aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Recent articles --}}
    @if(count($moreRecentArticles))
        <section class="mx-auto mt-24 max-w-[1440px] px-6 lg:mt-32 lg:px-12">
            <div class="flex flex-col gap-4 border-b-2 border-blue-950 pb-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">Fresh off the desk</p>
                    <h2 class="mt-2 text-3xl font-black uppercase tracking-[-0.03em] text-blue-950 sm:text-4xl">
                        Recent dispatches
                    </h2>
                </div>

                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950 transition hover:text-blue-600">
                    All articles <span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="mt-12 grid gap-x-8 gap-y-14 sm:grid-cols-2 xl:grid-cols-4">
                @foreach($moreRecentArticles as $article)
                    <article class="group">
                        <a href="{{ route('articles.show', $article['id']) }}" class="relative block">
                            <div class="absolute -left-2 -top-2 h-full w-full bg-stripes-blue" aria-hidden="true"></div>

                            <div class="relative border-2 border-blue-950">
                                <img
                                    src="{{ $article['image'] }}"
                                    alt="{{ $article['title'] }}"
                                    class="aspect-[4/3] w-full object-cover grayscale transition duration-700 ease-out group-hover:grayscale-0"
                                    loading="lazy"
                                >
                            </div>

                            <span class="absolute -bottom-3 -right-2 z-10 border-2 border-blue-950 bg-white px-2 py-1 font-mono text-[10px] font-bold text-blue-950">
                                0{{ $loop->iteration + 1 }}
                            </span>
                        </a>

                        <div class="mt-6">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                                <span class="text-blue-600">{{ $article['category'] ?? 'Journal' }}</span>
                                <span>&middot;</span>
                                <span>{{ $article['publish_date'] }}</span>
                            </div>

                            <h3 class="mt-3 text-xl font-extrabold uppercase leading-tight tracking-[-0.02em] text-blue-950">
                                <a href="{{ route('articles.show', $article['id']) }}" class="transition group-hover:text-blue-600">
                                    {{ $article['title'] }}
                                </a>
                            </h3>

                            <p class="mt-3 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/60">
                                By {{ $article['author_name'] }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Popular authors and active readers --}}
    <section class="mx-auto mt-24 max-w-[1440px] px-6 lg:mt-32 lg:px-12">
        <div class="grid gap-16 border-t-2 border-blue-950 pt-12 lg:grid-cols-12 lg:gap-20">
            <div class="lg:col-span-7">
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">The people behind the words</p>
                <h2 class="mt-2 text-3xl font-black uppercase tracking-[-0.03em] text-blue-950 sm:text-4xl">
                    Most popular authors
                </h2>

                <ol class="mt-10 border-t border-blue-200">
                    @forelse($popularAuthors as $author)
                        <li class="border-b border-blue-200">
                            <a href="{{ route('authors.show', $author['id']) }}" class="group flex items-center gap-5 py-5 sm:gap-7">
                                <span class="w-8 shrink-0 font-mono text-[10px] font-bold text-blue-600">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="flex h-14 w-14 shrink-0 items-center justify-center border-2 border-blue-950 bg-blue-950 text-lg font-black text-white transition duration-300 group-hover:bg-[#d9ff3f] group-hover:text-blue-950">
                                    {{ mb_strtoupper(mb_substr($author['name'], 0, 1)) }}
                                </span>

                                <span class="min-w-0 flex-1">
                                    <span class="block truncate text-lg font-extrabold uppercase tracking-[-0.02em] text-blue-950 transition group-hover:text-blue-600 sm:text-xl">
                                        {{ $author['name'] }}
                                    </span>
                                    <span class="mt-1 block font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                                        {{ $author['articles_count'] }} {{ Str::plural('article', $author['articles_count']) }}
                                        &middot;
                                        {{ $author['comments_count'] }} {{ Str::plural('comment', $author['comments_count']) }}
                                    </span>
                                </span>

                                <span class="text-xl text-blue-950 transition group-hover:translate-x-1 group-hover:text-blue-600" aria-hidden="true">&rarr;</span>
                            </a>
                        </li>
                    @empty
                        <li class="py-5 text-sm text-blue-950/60">No authors yet.</li>
                    @endforelse
                </ol>
            </div>

            <aside class="lg:col-span-5">
                <div class="relative border-2 border-blue-950 p-8">
                    <div class="absolute -right-2 -top-2 h-8 w-8 border-2 border-blue-950 bg-[#d9ff3f]" aria-hidden="true"></div>

                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">In the comments</p>
                    <h2 class="mt-2 text-2xl font-black uppercase tracking-[-0.03em] text-blue-950">
                        Most active readers
                    </h2>

                    <ol class="mt-7 space-y-5">
                        @forelse($activeUsers as $user)
                            <li class="flex items-baseline justify-between gap-4 border-b border-blue-100 pb-4 last:border-0 last:pb-0">
                                <span class="flex items-baseline gap-3">
                                    <span class="font-mono text-[10px] font-bold text-blue-600">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-sm font-bold uppercase tracking-[-0.01em] text-blue-950">{{ $user['name'] }}</span>
                                </span>

                                <span class="shrink-0 font-mono text-[10px] uppercase tracking-[0.14em] text-blue-950/55">
                                    {{ $user['comments_count'] }} {{ Str::plural('comment', $user['comments_count']) }}
                                </span>
                            </li>
                        @empty
                            <li class="text-sm text-blue-950/60">No active users yet.</li>
                        @endforelse
                    </ol>
                </div>

                <div class="mt-6 flex items-stretch border-2 border-blue-950">
                    <div class="w-2 shrink-0 bg-stripes-lime" aria-hidden="true"></div>
                    <p class="px-6 py-5 text-sm leading-6 text-blue-950/65">
                        Every comment counts. Join the conversation under any article and climb the board.
                    </p>
                </div>
            </aside>
        </div>
    </section>

    {{-- Most popular articles, directly above the footer --}}
    <section class="mt-24 bg-blue-950 text-white lg:mt-32">
        <div class="bg-stripes-white h-3 w-full" aria-hidden="true"></div>

        <div class="mx-auto max-w-[1440px] px-6 py-16 lg:px-12 lg:py-20">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-[#d9ff3f]">Most read</p>
                    <h2 class="mt-2 text-balance text-4xl font-black uppercase leading-[0.95] tracking-[-0.035em] sm:text-5xl">
                        The three everyone<br class="hidden sm:block"> is talking about
                    </h2>
                </div>

                <p class="max-w-sm text-sm leading-6 text-blue-100/60">
                    Ranked by the number of comments. Read them, then add your own opinion.
                </p>
            </div>

            <div class="mt-12 grid gap-10 border-t border-white/20 pt-10 md:grid-cols-3">
                @forelse($popularArticles as $article)
                    <article class="group">
                        <a href="{{ route('articles.show', $article['id']) }}" class="relative block">
                            <img
                                src="{{ $article['image'] }}"
                                alt="{{ $article['title'] }}"
                                class="aspect-[4/3] w-full border-2 border-white/20 object-cover grayscale transition duration-700 ease-out group-hover:grayscale-0"
                                loading="lazy"
                            >

                            <span class="absolute -left-2 -top-3 z-10 border-2 border-blue-950 bg-[#d9ff3f] px-3 py-1 font-mono text-[11px] font-bold text-blue-950">
                                0{{ $loop->iteration }}
                            </span>
                        </a>

                        <h3 class="mt-6 text-2xl font-extrabold uppercase leading-tight tracking-[-0.02em]">
                            <a href="{{ route('articles.show', $article['id']) }}" class="transition group-hover:text-[#d9ff3f]">
                                {{ $article['title'] }}
                            </a>
                        </h3>

                        <p class="mt-3 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-100/50">
                            By {{ $article['author_name'] }}
                            &middot;
                            {{ $article['comments_count'] }} {{ Str::plural('comment', $article['comments_count']) }}
                        </p>
                    </article>
                @empty
                    <p class="text-sm text-blue-100/60">No articles yet.</p>
                @endforelse
            </div>
        </div>
    </section>

</x-site-layout>
