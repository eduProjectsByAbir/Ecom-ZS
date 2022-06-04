    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend') }}/js/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/echo.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.easing-1.3.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap-slider.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/lightbox.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/js/scripts.js"></script>
    <script src="{{ asset('backend/js/toastr/toastr.min.js') }}"></script>
    @auth('web')
    <script>
        document.getElementById("logoutButton").addEventListener("click", function (event) {
            event.preventDefault();
            document.getElementById("logout").submit();
        });

    </script>
    @endauth
    <script>
        @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", 'Success!');
        @elseif (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}", 'Warning!')
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}", 'Error!')
        @endif
        // toast config
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "hideMethod": "fadeOut"
        }
    </script>
