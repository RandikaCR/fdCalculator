<!-- jequery plugins -->
<script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
<script src="{{ asset('assets/frontend/js/validation.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/frontend/js/appear.js') }}"></script>
<script src="{{ asset('assets/frontend/js/isotope.js') }}"></script>
<script src="{{ asset('assets/frontend/js/parallax-scroll.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/scrolltop.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/odometer.js') }}"></script>
<script src="{{ asset('assets/frontend/js/nav-tool.js') }}"></script>

<!-- main-js -->
<script src="{{ asset('assets/frontend/js/script.js') }}"></script>

<script src="{{ asset('assets/common/js/app.js') }}"></script>
<script src="{{ asset('assets/common/js/common.js') }}"></script>

<script src="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

@yield('js')

<script>
    function csrf_token(){
        $token = "{{ csrf_token() }}";
        return $token;
    }
</script>

@yield('script')


