   $(document).ready(function() {
            $('#menuToggle').click(function() {
                $('#mobileMenu').toggleClass('active');
                const icon = $(this).find('i');
                if (icon.hasClass('fa-bars')) {
                    icon.removeClass('fa-bars').addClass('fa-times');
                } else {
                    icon.removeClass('fa-times').addClass('fa-bars');
                }
            });

            $('#mobileMenu a').click(function() {
                $('#mobileMenu').removeClass('active');
                $('#menuToggle i').removeClass('fa-times').addClass('fa-bars');
            });
        });
