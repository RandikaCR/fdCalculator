<header class="main-header">

    <div class="header-lower">
        <div class="outer-container">
            <div class="outer-box">
                <div class="menu-area">
                    <div class="logo-box mr_110">
                        <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset('assets/common/images/logo.png') }}" alt="" style="height: 30px;"></a></figure>
                    </div>
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light clearfix">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="{{ url('/') }}">Get In Touch</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-container">
            <div class="outer-box">
                <div class="menu-area">
                    <div class="logo-box mr_110">
                        <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset('assets/common/images/logo.png') }}" alt="" style="height: 30px;"></a></figure>
                    </div>
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="{{ url('/') }}"><img src="{{ asset('assets/common/images/logo.png') }}" alt="" title="" style="height: 50px;"></a></div>
        <div class="menu-outer"></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li class="fs-5">Jeewantha Perera</li>
                <li><a href="tel:+{{ myNumber()['link'] }}">{{ myNumber()['display'] }}</a></li>
                <li><a href="mailto:{{ myEmail() }}">{{ myEmail() }}</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="javascript:vodi(0);"><span class="fab fa-twitter"></span></a></li>
                <li><a href="javascript:vodi(0);"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="javascript:vodi(0);"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="javascript:vodi(0);"><span class="fab fa-instagram"></span></a></li>
                <li><a href="javascript:vodi(0);"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div>
