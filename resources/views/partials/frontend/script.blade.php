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

    $(document).ready(function(){
        $('.logout').on('click', function ($e){
            $e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You want to end this session!",
                icon: "warning",
                showCancelButton: !0,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, Log Out!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-secondary w-xs mt-2",
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then((result) => {
                if (result.isConfirmed) {

                    setTimeout(function() {
                        $.ajax({
                            url: "{{ route('frontend.appLogout') }}",
                            type: 'POST',
                            data: {
                                _token: csrf_token()
                            },
                            dataType: 'json',
                            beforeSend: function ($jqXHR, $obj) {
                                Swal.fire({
                                    title: "Processing...",
                                    text: "Please wait",
                                    imageUrl: "{{ asset('assets/common/images/ajax-loader.gif') }}",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },
                            success: function ($response, $textStatus, $jqXHR) {
                                Swal.fire('Done!', 'Logged Out!', 'success');
                                setTimeout(function(){
                                    location.reload();
                                },1000);
                            },
                            error: function ($jqXHR, $textStatus, $errorThrown) {
                                Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                            }
                        });

                    }, 50);
                }
            });


        });
    });
</script>

@yield('script')


