<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{route('app.home')}}">
            <img src="{{ Vite::asset('resources/assets/images/AR24_Rlogo.png') }}" alt="AR24" width="60" height="30" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.show')}}">Get User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.index')}}">Create User</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('attachment.index')}}">Upload Document</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('email.index')}}">Send Email</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('email.get')}}">Get Email Info</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
