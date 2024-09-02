<footer class="footer-section">
    <div class="container">
        <div class="footer-cta pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="cta-text">
                            <h4>Find us</h4>
                            <span>{{ $sitesetting->location }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-phone"></i>
                        <div class="cta-text">
                            <h4>Call us</h4>
                            <span>{{ $sitesetting->contact_number }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="far fa-envelope-open"></i>
                        <div class="cta-text">
                            <h4>Mail us</h4>
                            <span>{{ $sitesetting->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">

                            <a href="index.html"><img src="{{ url('uploads/sitesetting/' . $sitesetting->logo ?? '') }}"
                                    class="img-fluid" alt="logo"></a>
                        </div>
                        {{-- <div class="footer-text">


                            <p>{{ Str::substr($sitesetting->introduction_text, 0, 120) ?? '' }}</p>
                        </div> --}}
                        <div class="footer-social-icon">
                            <span>Follow us</span>
                            <a href="https://www.facebook.com/ktm.logistic/"><i
                                    class="fab fa-facebook-f facebook-bg"></i></a>
                            <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Useful Links</h3>
                        </div>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">about</a></li>
                            <li><a href="#">Our services</a></li>
                            <li><a href="#">Shipment Booking</a></li>
                            <li><a href="#">Request For Quote</a></li>
                            <li><a href="#">Import Guide</a></li>
                            <li><a href="#">Export Guide</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">Contact us</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Subscribe</h3>
                        </div>
                        <div class="footer-text mb-25">
                            <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                        </div>
                        <div class="subscribe-form">


                            <form class="" method="POST" action="{{ route('request_subscription') }}" id="newsletter">
                                @csrf
                                <input required type="email" name="email" placeholder="Your e-mail">
                                <button form="newsletter" type="submit" class="Signup__button"><i
                                        class="fas fa-paper-plane"></i></button>
                            </form>

                            @if (Session::has('success-subscription'))
                                <strong style="color:green">{{ Session::get('success-subscription') }}</strong>
                            @endif
                            @if (Session::has('error-subscription'))
                                <strong style="color:red">{{ Session::get('error-subscription') }}</strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 text-center text-lg-left">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2022, All Right Reserved <a href="https:aashatech.com">Aasha Tech Pvt. Ltd.</a></p>
                    </div>
                </div>
                {{-- <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Policy</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
