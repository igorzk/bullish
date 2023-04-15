<nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href=" {{ route('index') }} ">
            <i class="fa-solid fa-file-contract fa-xl"></i>
            <span class="m-3"><strong>Bullish</strong></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="justify-content-end collapse navbar-collapse" id="navbarNavDropdown">
            <x-navitems />
        </div>
    </div>
</nav>
