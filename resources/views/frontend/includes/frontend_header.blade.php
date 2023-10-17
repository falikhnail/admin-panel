<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand p-0" href="#page-top">
            <img src="{{ asset('/img/logo_name_cropped.png') }}" alt="Logo" class="" width="200"
                height="30" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }} {{ request()->is('about') }}"
                        href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
                <li class="nav-item d-sm-none d-md-none d-inline">
                    <a class="btn btn-primary btn-xl"
                        href="{{ !empty($userSession) ? route('backend.dashboard') : route('login') }}">Login</a>
                </li>
            </ul>
        </div>
        <a class="btn btn-primary btn-xl d-none d-sm-inline"
            href="{{ !empty($userSession) ? route('backend.dashboard') : route('login') }}">{{ !empty($userSession) ? 'Dashboard' : 'Login' }}</a>
    </div>
</nav>
<script></script>
