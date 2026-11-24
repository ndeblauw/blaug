<x-site-layout title="Articles overview">

    <section class="mx-auto max-w-[1440px] px-6 pt-14 lg:px-12 lg:pt-20">
        <div class="flex flex-col gap-8 border-b-2 border-blue-950 pb-10 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">The archive</p>

                <h1 class="mt-4 text-5xl font-black uppercase leading-none tracking-[-0.05em] text-blue-950 sm:text-7xl">
                    Articles <span class="text-blue-600">/{{ $articles->count() }}</span>
                </h1>
            </div>

            <div class="flex items-end gap-6">
                <p class="max-w-xs text-sm leading-6 text-blue-950/60">
                    Everything we have published, newest first. Pictures stay black and white
                    until you give them a second look.
                </p>

                <div class="hidden h-16 w-16 shrink-0 bg-stripes-blue lg:block" aria-hidden="true"></div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-[1440px] px-6 lg:px-12">
        <div class="mt-4">
            @forelse($articles as $article)
                <article class="group grid gap-6 border-b border-blue-200 py-10 md:grid-cols-12 md:gap-8 md:py-12">
                    <div class="md:col-span-1">
                        <span class="font-mono text-[11px] font-bold text-blue-600">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <div class="md:col-span-7">
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                            <span class="text-blue-600">{{ $article->categories->first()?->name ?? 'Journal' }}</span>
                            <span class="h-px w-5 bg-blue-950/25"></span>
                            <span>{{ $article->publish_date->format('M j, Y') }}</span>
                        </div>

                        <h2 class="mt-3 text-balance text-2xl font-black uppercase leading-[1.02] tracking-[-0.03em] text-blue-950 sm:text-4xl">
                            <a href="{{ route('articles.show', $article) }}" class="transition group-hover:text-blue-600">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="mt-4 max-w-2xl text-sm leading-7 text-blue-950/60">
                            {{ Str::limit(strip_tags($article->content), 160) }}
                        </p>

                        <div class="mt-5 flex flex-wrap items-center gap-4 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/60">
                            <span>
                                By
                                <a href="{{ route('authors.show', $article->author) }}" class="font-bold text-blue-950 transition hover:text-blue-600">
                                    {{ $article->author->name }}
                                </a>
                            </span>

                            <span>{{ $article->comments_count }} {{ Str::plural('comment', $article->comments_count) }}</span>
                        </div>
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

                        <span class="absolute -bottom-3 -left-2 z-10 border-2 border-blue-950 bg-white px-2 py-1 font-mono text-[10px] font-bold uppercase tracking-[0.12em] text-blue-950">
                            Read
                        </span>
                    </a>
                </article>
            @empty
                <p class="py-16 text-sm text-blue-950/60">No articles yet.</p>
            @endforelse
        </div>
    </section>

</x-site-layout>
