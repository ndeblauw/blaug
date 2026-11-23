<x-site-layout title="Welcome">

    <div class="grid gap-12 lg:grid-cols-[1fr_18rem]">
        <div>
            <section class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-600">BLAUG</p>

                <h1 class="mt-2 text-4xl font-semibold tracking-tight text-slate-900">
                    Welcome @auth, {{ auth()->user()->name }}@endauth
                </h1>

                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Stories, ideas and opinions from our community.
                </p>
            </section>

            <section class="mt-12">
                <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-900">Most popular articles</h2>

                <div class="mt-4 divide-y divide-blue-100 border-t border-blue-100">
                    @forelse($popularArticles as $article)
                        <article class="py-5">
                            <h3 class="text-lg font-semibold text-slate-900">
                                <a href="{{ route('articles.show', $article['id']) }}" class="hover:text-blue-700">{{ $article['title'] }}</a>
                            </h3>

                            <p class="mt-1 text-xs uppercase tracking-wider text-blue-600">
                                By {{ $article['author_name'] }}
                                &middot;
                                {{ $article['comments_count'] }} {{ Str::plural('comment', $article['comments_count']) }}
                            </p>
                        </article>
                    @empty
                        <p class="py-5 text-sm text-slate-500">No articles yet.</p>
                    @endforelse
                </div>
            </section>

            <section class="mt-12">
                <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-900">Most recent articles</h2>

                <div class="mt-4 divide-y divide-blue-100 border-t border-blue-100">
                    @forelse($recentArticles as $article)
                        <article class="py-5">
                            <h3 class="text-lg font-semibold text-slate-900">
                                <a href="{{ route('articles.show', $article['id']) }}" class="hover:text-blue-700">{{ $article['title'] }}</a>
                            </h3>

                            <p class="mt-1 text-xs uppercase tracking-wider text-blue-600">
                                By {{ $article['author_name'] }}
                                &middot;
                                {{ $article['publish_date'] }}
                            </p>
                        </article>
                    @empty
                        <p class="py-5 text-sm text-slate-500">No articles yet.</p>
                    @endforelse
                </div>
            </section>
        </div>

        <aside class="lg:border-l lg:border-blue-100 lg:pl-8">
            <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-900">Most active users</h2>

            <ol class="mt-4 space-y-4">
                @forelse($activeUsers as $user)
                    <li class="flex items-baseline justify-between gap-4">
                        <span class="text-sm font-medium text-slate-900">{{ $user['name'] }}</span>
                        <span class="shrink-0 text-xs text-slate-500">
                            {{ $user['comments_count'] }} {{ Str::plural('comment', $user['comments_count']) }}
                        </span>
                    </li>
                @empty
                    <li class="text-sm text-slate-500">No active users yet.</li>
                @endforelse
            </ol>
        </aside>
    </div>

</x-site-layout>
