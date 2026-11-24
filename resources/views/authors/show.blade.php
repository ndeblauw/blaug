<x-site-layout title="{{ $author->name }}">

    <div class="mx-auto max-w-[1240px] px-6 pt-10 lg:px-12 lg:pt-14">
        <a href="{{ route('authors.index') }}" class="inline-flex items-center gap-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950/60 transition hover:text-blue-600">
            <span aria-hidden="true">&larr;</span> Back to authors
        </a>

        <header class="mt-10 grid gap-12 border-b-2 border-blue-950 pb-12 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-8">
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">Author profile</p>

                <h1 class="mt-4 text-balance text-5xl font-black uppercase leading-[0.9] tracking-[-0.045em] text-blue-950 sm:text-7xl">
                    {{ $author->name }}
                </h1>

                <div class="mt-7 flex flex-wrap items-center gap-x-5 gap-y-3 font-mono text-[10px] uppercase tracking-[0.18em] text-blue-950/60">
                    <span>Member since {{ $author->created_at->format('M j, Y') }}</span>
                    <span class="h-px w-6 bg-blue-950/25"></span>
                    <span>{{ $author->articles->count() }} {{ Str::plural('article', $author->articles->count()) }}</span>
                </div>
            </div>

            <div class="relative lg:col-span-4 lg:justify-self-end">
                <div class="absolute -left-3 -top-3 h-full w-full bg-stripes-blue" aria-hidden="true"></div>

                <div class="relative flex h-40 w-40 items-center justify-center border-2 border-blue-950 bg-blue-950 text-7xl font-black text-white sm:h-48 sm:w-48">
                    {{ mb_strtoupper(mb_substr($author->name, 0, 1)) }}
                </div>

                <span class="absolute -bottom-3 -right-3 h-8 w-8 border-2 border-blue-950 bg-[#d9ff3f]" aria-hidden="true"></span>
            </div>
        </header>
    </div>

    <section class="mx-auto mt-16 max-w-[1440px] px-6 lg:px-12">
        <div class="flex items-end justify-between gap-6 border-b-2 border-blue-950 pb-5">
            <div>
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">The archive</p>
                <h2 class="mt-2 text-3xl font-black uppercase tracking-[-0.03em] text-blue-950 sm:text-4xl">
                    Written by {{ $author->name }}
                </h2>
            </div>

            <div class="hidden h-10 w-10 bg-stripes-blue sm:block" aria-hidden="true"></div>
        </div>

        <div>
            @forelse($author->articles as $article)
                <article class="group grid gap-6 border-b border-blue-200 py-10 md:grid-cols-12 md:items-center md:gap-8">
                    <span class="font-mono text-[11px] font-bold text-blue-600 md:col-span-1">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <div class="md:col-span-7">
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                            <span class="text-blue-600">{{ $article->categories->first()?->name ?? 'Journal' }}</span>
                            <span class="h-px w-5 bg-blue-950/25"></span>
                            <span>{{ $article->publish_date->format('M j, Y') }}</span>
                        </div>

                        <h3 class="mt-3 text-2xl font-black uppercase leading-[1.02] tracking-[-0.03em] text-blue-950 sm:text-3xl">
                            <a href="{{ route('articles.show', $article) }}" class="transition group-hover:text-blue-600">
                                {{ $article->title }}
                            </a>
                        </h3>

                        <p class="mt-4 max-w-2xl text-sm leading-7 text-blue-950/60">
                            {{ Str::limit(strip_tags($article->content), 160) }}
                        </p>

                        <p class="mt-4 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                            {{ $article->comments_count }} {{ Str::plural('comment', $article->comments_count) }}
                        </p>
                    </div>

                    <a href="{{ route('articles.show', $article) }}" class="relative block md:col-span-4">
                        <div class="absolute -left-2 -top-2 h-full w-full bg-stripes-blue" aria-hidden="true"></div>

                        <div class="relative border-2 border-blue-950">
                            <img
                                src="{{ $article->getImagePath() }}"
                                alt="{{ $article->title }}"
                                class="aspect-[4/3] w-full object-cover grayscale transition duration-700 ease-out group-hover:grayscale-0"
                                loading="lazy"
                            >
                        </div>
                    </a>
                </article>
            @empty
                <p class="py-10 text-sm text-blue-950/60">No articles yet.</p>
            @endforelse
        </div>
    </section>

</x-site-layout>
