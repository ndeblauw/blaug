<x-site-layout title="{{ $article->title }}">

    <div class="mx-auto max-w-[1240px] px-6 pt-10 lg:px-12 lg:pt-14">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950/60 transition hover:text-blue-600">
            <span aria-hidden="true">&larr;</span> Back to articles
        </a>

        <header class="mt-10 max-w-4xl">
            @if($article->categories->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach($article->categories as $category)
                        <a href="{{ route('categories.show', $category) }}" class="border-2 border-blue-950 px-3 py-1 font-mono text-[10px] font-bold uppercase tracking-[0.14em] text-blue-950 transition hover:bg-blue-950 hover:text-white">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <h1 class="mt-6 text-balance text-4xl font-black uppercase leading-[0.93] tracking-[-0.04em] text-blue-950 sm:text-6xl lg:text-7xl">
                {{ $article->title }}
            </h1>

            <div class="mt-7 flex flex-wrap items-center gap-x-5 gap-y-3 font-mono text-[10px] uppercase tracking-[0.18em] text-blue-950/60">
                <span>
                    By
                    <a href="{{ route('authors.show', $article->author) }}" class="font-bold text-blue-950 transition hover:text-blue-600">
                        {{ $article->author->name }}
                    </a>
                </span>

                <span class="h-px w-6 bg-blue-950/25"></span>
                <span>{{ $article->publish_date->format('M j, Y') }}</span>
                <span class="h-px w-6 bg-blue-950/25"></span>
                <span>{{ $comments->count() }} {{ Str::plural('comment', $comments->count()) }}</span>
            </div>
        </header>
    </div>

    <div class="mx-auto mt-12 max-w-[1240px] px-6 lg:mt-16 lg:px-12">
        <div class="relative">
            <div class="absolute -left-3 -top-3 h-full w-full bg-stripes-blue" aria-hidden="true"></div>

            <div class="relative border-2 border-blue-950 bg-blue-950">
                <img
                    src="{{ $article->getImagePath('hero') }}"
                    alt="{{ $article->title }}"
                    class="aspect-[16/9] w-full object-cover"
                >
            </div>

            <span class="absolute -left-3 top-8 z-10 border-2 border-blue-950 bg-[#d9ff3f] px-4 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950">
                BLAUG
            </span>

            <div class="absolute -bottom-7 right-4 z-10 flex items-center gap-4 border-2 border-blue-950 bg-white px-4 py-3 sm:right-8 sm:px-5">
                <span class="h-10 w-10 shrink-0 border-2 border-blue-950 bg-blue-950">
                    <img
                        src="{{ $article->author->getAvatarPath('thumb') }}"
                        alt="{{ $article->author->name }}"
                        class="h-full w-full object-cover"
                    >
                </span>

                <span>
                    <span class="block font-mono text-[9px] uppercase tracking-[0.18em] text-blue-950/55">Written by</span>
                    <a href="{{ route('authors.show', $article->author) }}" class="block text-sm font-extrabold uppercase tracking-[-0.01em] text-blue-950 transition hover:text-blue-600">
                        {{ $article->author->name }}
                    </a>
                </span>
            </div>
        </div>
    </div>

    <div class="mx-auto mt-24 max-w-[1240px] px-6 lg:px-12">
        <div class="grid gap-14 lg:grid-cols-12 lg:gap-16">
            <aside class="lg:col-span-3">
                <div class="border-t-2 border-blue-950 pt-4">
                    <p class="font-mono text-[10px] uppercase tracking-[0.22em] text-blue-600">Filed under</p>

                    <ul class="mt-4 space-y-2">
                        @forelse($article->categories as $category)
                            <li>
                                <a href="{{ route('categories.show', $category) }}" class="text-sm font-bold uppercase tracking-[-0.01em] text-blue-950 transition hover:text-blue-600">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @empty
                            <li class="text-sm text-blue-950/60">Journal</li>
                        @endforelse
                    </ul>
                </div>

                <div class="mt-8 border-t-2 border-blue-950 pt-4">
                    <p class="font-mono text-[10px] uppercase tracking-[0.22em] text-blue-600">Published</p>
                    <p class="mt-3 text-sm font-bold uppercase text-blue-950">{{ $article->publish_date->format('F j, Y') }}</p>
                </div>

                <div class="mt-8 h-24 bg-stripes-lime" aria-hidden="true"></div>
            </aside>

            <article class="lg:col-span-9">
                <div class="max-w-3xl text-[17px] leading-9 text-blue-950/80">
                    @foreach(preg_split('/\R+/', trim($article->content)) as $paragraph)
                        @continue(trim($paragraph) === '')

                        <p @class([
                            'mt-7 first:mt-0',
                            'first-letter:float-left first-letter:mr-3 first-letter:text-6xl first-letter:font-black first-letter:leading-[0.8] first-letter:text-blue-950' => $loop->first,
                        ])>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </article>
        </div>
    </div>

    <section class="mx-auto mt-24 max-w-[1240px] px-6 lg:px-12">
        <div id="comments" class="max-w-3xl border-t-2 border-blue-950 pt-10">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-[0.24em] text-blue-600">The conversation</p>
                    <h2 class="mt-2 text-3xl font-black uppercase tracking-[-0.03em] text-blue-950">
                        Comments <span class="text-blue-600">/{{ $comments->count() }}</span>
                    </h2>
                </div>

                <div class="hidden h-10 w-10 bg-stripes-blue sm:block" aria-hidden="true"></div>
            </div>

            <x-article-comment-form :article="$article" />

            <div class="mt-8 border-t border-blue-200">
                @forelse($comments as $comment)
                    <div class="border-b border-blue-200 py-6">
                        <div class="flex flex-wrap items-center gap-3 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                            <span class="font-bold text-blue-950">{{ $comment->user->name }}</span>
                            <span class="h-px w-4 bg-blue-950/20"></span>
                            <span>{{ $comment->created_at->format('M j, Y') }}</span>
                        </div>

                        @if($comment->approved_at === null)
                            @if(auth()->id() === $comment->user_id)
                                <p class="mt-2 inline-block bg-[#d9ff3f] px-2 py-1 text-xs font-medium text-blue-950">
                                    This comment is awaiting validation. You're the only one to see it.
                                </p>
                            @else
                                <p class="mt-2 inline-block border border-blue-950 px-2 py-1 font-mono text-[10px] font-bold uppercase tracking-[0.14em] text-blue-950">
                                    Awaiting validation
                                </p>
                            @endif
                        @endif

                        <p class="mt-3 text-[15px] leading-7 text-blue-950/75">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="py-8 text-sm text-blue-950/55">No comments yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    @if($relatedArticles->isNotEmpty())
        <section class="mx-auto mt-24 max-w-[1440px] px-6 pb-8 lg:mt-32 lg:px-12">
            <div class="flex flex-col gap-4 border-b-2 border-blue-950 pb-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">Keep reading</p>
                    <h2 class="mt-2 text-3xl font-black uppercase tracking-[-0.03em] text-blue-950 sm:text-4xl">
                        More dispatches
                    </h2>
                </div>

                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-blue-950 transition hover:text-blue-600">
                    All articles <span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($relatedArticles as $relatedArticle)
                    <article class="group">
                        <a href="{{ route('articles.show', $relatedArticle) }}" class="relative block">
                            <div class="absolute -left-2 -top-2 h-full w-full bg-stripes-blue" aria-hidden="true"></div>

                            <div class="relative border-2 border-blue-950">
                                <img
                                    src="{{ $relatedArticle->getImagePath() }}"
                                    alt="{{ $relatedArticle->title }}"
                                    class="aspect-[4/3] w-full object-cover grayscale transition duration-700 ease-out group-hover:grayscale-0"
                                    loading="lazy"
                                >
                            </div>

                            <span class="absolute -bottom-3 -right-2 z-10 border-2 border-blue-950 bg-white px-2 py-1 font-mono text-[10px] font-bold text-blue-950">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </a>

                        <h3 class="mt-6 text-xl font-extrabold uppercase leading-tight tracking-[-0.02em] text-blue-950">
                            <a href="{{ route('articles.show', $relatedArticle) }}" class="transition group-hover:text-blue-600">
                                {{ $relatedArticle->title }}
                            </a>
                        </h3>

                        <p class="mt-2 font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                            {{ $relatedArticle->author->name }} &middot; {{ $relatedArticle->publish_date->format('M j, Y') }}
                        </p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

</x-site-layout>
