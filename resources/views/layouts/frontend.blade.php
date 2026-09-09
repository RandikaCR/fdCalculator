<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.frontend.head')
</head>


<!-- page wrapper -->
<body>

<div class="boxed_wrapper">


    <!-- preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close"><i class="fas fa-times"></i></div>
            <div id="handle-preloader" class="handle-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <span data-text-preloader="F" class="letters-loading">F</span>
                        <span data-text-preloader="D" class="letters-loading">D</span>
                        <span data-text-preloader=" " class="letters-loading">&nbsp;</span>
                        <span data-text-preloader="C" class="letters-loading">C</span>
                        <span data-text-preloader="A" class="letters-loading">A</span>
                        <span data-text-preloader="L" class="letters-loading">L</span>
                        <span data-text-preloader="C" class="letters-loading">C</span>
                        <span data-text-preloader="U" class="letters-loading">U</span>
                        <span data-text-preloader="L" class="letters-loading">L</span>
                        <span data-text-preloader="A" class="letters-loading">A</span>
                        <span data-text-preloader="T" class="letters-loading">T</span>
                        <span data-text-preloader="O" class="letters-loading">O</span>
                        <span data-text-preloader="R" class="letters-loading">R</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->

    @include('partials.frontend.header')

    @yield('content')

    @include('partials.frontend.footer')



    <!--Scroll to top-->
    <div class="scroll-to-top">
        <svg class="scroll-top-inner" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

</div>

@include('partials.frontend.script')

</body>
</html>

