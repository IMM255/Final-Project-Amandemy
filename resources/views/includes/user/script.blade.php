<script>
    var dropdown = document.querySelector('.nav-item.dropdown');
    var dropdownMenu = document.querySelector('.dropdown-menu');
    var navbarDropdown = document.querySelector('#btn-dropdown');
    console.log(navbarDropdown);

    navbarDropdown.addEventListener('click', function(event) {
        console.log("ASds");
        event.preventDefault();
        dropdownMenu.classList.toggle('show');
    });

    document.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
</script>
<!-- Vendor JS Files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/sticky/sticky.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/owlcarousel/owl.carousel.min.js') }}"></script>

