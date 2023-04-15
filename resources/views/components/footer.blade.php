<footer class="py-2 mt-auto bg-light">
    <div class="container py-3 py-md-4 px-md-0 px-4">
        <div class="row g-0 gap-md-3 gap-5">
            <div class="col-md-9 col-3">
                <a class="text-black text-decoration-none lh-1" href="{{ route('index') }}">
                    <i class="fa-solid fa-file-contract fa-lg"></i>
                </a>
                <span class="ms-1 text-muted">
                    &copy 2022, Bullish - Ambiente de
                    @env('production')
                    produção
                    @endenv
                    @env('local')
                    desenvolvimento
                    @endenv
                </span>
            </div>
            <div class="col-1">
                <a href="https://github.com/igorzk/bullish" class="text-muted nav-link">
                    <i class="fab fa-git-alt"></i>
                    <span class="ms-1">Github</span>
                </a>
            </div>
        </div>
    </div>
</footer>
