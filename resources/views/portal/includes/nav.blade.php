<div class="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-4 logo_image">
                <img src="{{ url('uploads/sitesetting/' . $sitesetting->logo ?? '') }}">
            </div>

            <div class="col-md-8 navbar_top">

                <div class="top_navbar_list">
                    @auth
                        <a class="top_nav_link" href="#">My Account</a>
                        <a class="top_nav_link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                    </form> @endauth


                    <a class="top_nav_link" href="javascript:void(0)" onClick="return rudr_favorite(this);">Add to
                        favorites</a>
                    @guest
                        <a class="top_nav_link" href="/login">Login</a>

                        <a class="top_nav_link" href="/register">Agent Registration</a>
                    @endguest

                </div>


                <div class="welcome">
                    <p>
                        Welcome to {{ $sitesetting->company_name }}
                        {{-- <span class="register_in"><a href="/login">Sign In</a> </span> --}}
                        {{-- <span class="register_in"><a href="">Register</a> </span> --}}

                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- FOr Responsive Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">KTM Logistics</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#intro_section">About Us</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Our Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($services as $service)
                            <li><a class="dropdown-item" href="/service/{{ $service->id }}">{{ $service->title }}</a></li>
                        @endforeach

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#footer">Locations</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Shipment Booking</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('render_quotations') }}">Request For Quote</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ isset($import_guide->id) ? route('render_posts',$import_guide->id) : '#' }}">Import Guide</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ isset($export_guide->id) ? route('render_posts',$export_guide->id) : '#'  }}">Export Guide</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('request_contact') }}">Contact Us</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<script>
    function rudr_favorite(a) {
        pageTitle = document.title;
        pageURL = document.location;
        try {
            // Internet Explorer solution
            eval("window.external.AddFa-vorite(pageURL, pageTitle)".replace(/-/g, ''));
        } catch (e) {
            try {
                // Mozilla Firefox solution
                window.sidebar.addPanel(pageTitle, pageURL, "");
            } catch (e) {
                // Opera solution
                if (typeof(opera) == "object") {
                    a.rel = "sidebar";
                    a.title = pageTitle;
                    a.url = pageURL;
                    return true;
                } else {
                    // The rest browsers (i.e Chrome, Safari)
                    alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Cmd' : 'Ctrl') +
                        '+D to bookmark this page.');
                }
            }
        }
        return false;
    }
</script>
