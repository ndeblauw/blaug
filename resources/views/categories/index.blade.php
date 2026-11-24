<x-site-layout title="Categories overview">

    <section class="mx-auto max-w-[1440px] px-6 pt-14 lg:px-12 lg:pt-20">
        <div class="flex flex-col gap-8 border-b-2 border-blue-950 pb-10 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">Browse by subject</p>

                <h1 class="mt-4 text-5xl font-black uppercase leading-none tracking-[-0.05em] text-blue-950 sm:text-7xl">
                    Categories <span class="text-blue-600">/{{ $categories->count() }}</span>
                </h1>
            </div>

            <div class="flex items-end gap-6">
                <p class="max-w-xs text-sm leading-6 text-blue-950/60">
                    Pick a lane. The archive is sorted into a handful of subjects, no algorithms involved.
                </p>

                <div class="hidden h-16 w-16 shrink-0 bg-stripes-blue lg:block" aria-hidden="true"></div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-[1440px] px-6 lg:px-12">
        <div class="grid border-t border-blue-200 sm:grid-cols-2">
            @forelse($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="group relative flex items-center gap-5 border-b border-blue-200 py-8 sm:odd:pr-10 sm:even:border-l sm:even:pl-10">
                    <span class="font-mono text-[10px] font-bold text-blue-600">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <span class="min-w-0 flex-1">
                        <span class="block truncate text-2xl font-black uppercase tracking-[-0.03em] text-blue-950 transition group-hover:text-blue-600 sm:text-3xl">
                            {{ $category->name }}
                        </span>
                        <span class="mt-1 block font-mono text-[10px] uppercase tracking-[0.16em] text-blue-950/55">
                            {{ $category->articles_count }} {{ Str::plural('article', $category->articles_count) }}
                        </span>
                    </span>

                    <span class="flex h-10 w-10 shrink-0 items-center justify-center border-2 border-blue-950 bg-white text-lg text-blue-950 transition group-hover:bg-[#d9ff3f]" aria-hidden="true">
                        &rarr;
                    </span>
                </a>
            @empty
                <p class="py-10 text-sm text-blue-950/60">No categories yet.</p>
            @endforelse
        </div>
    </section>

</x-site-layout>
