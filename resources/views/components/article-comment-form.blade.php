<div id="comments">
    @auth
        <form method="POST" action="{{ route('articles.comments.store', $article->id) }}" class="mt-8 border-2 border-blue-950 p-6 sm:p-8">
            @csrf

            <div class="flex items-center justify-between gap-4">
                <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-blue-950/60">
                    Signed in as <span class="font-bold text-blue-950">{{ auth()->user()->name }}</span>
                </p>

                <span class="h-2 w-2 bg-[#d9ff3f]" aria-hidden="true"></span>
            </div>

            <div class="mt-5">
                <x-form-textarea name="content" label="Your comment" placeholder="Say something worth reading" rows="4" required />
            </div>

            <button type="submit" class="mt-5 bg-blue-600 px-6 py-3 font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-white transition hover:bg-blue-950">
                Post comment
            </button>
        </form>
    @else
        <div class="mt-8 flex flex-col gap-4 border-2 border-blue-950 bg-[#d9ff3f] px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <span class="text-sm font-bold uppercase tracking-[-0.01em] text-blue-950">
                You need to be logged in to make a comment.
            </span>

            <a href="{{ route('login', ['redirect' => request()->getRequestUri().'#comments']) }}" class="w-fit bg-blue-950 px-4 py-2 font-mono text-[10px] font-bold uppercase tracking-[0.18em] text-white transition hover:bg-blue-600">
                Login
            </a>
        </div>
    @endauth
</div>
