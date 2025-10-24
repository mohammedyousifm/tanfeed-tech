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


$(document).ready(function () {

  let isNavigating = false;

  // When the page is unloading (navigating away or reloading)
  $(window).on('beforeunload', function () {
    isNavigating = true;
    $('.prevent-double').css({
      'pointer-events': 'none',
      'opacity': '0.6'
    }).data('clicked', true);
  });

  // When user clicks
  $(document).on('click', '.prevent-double', function (e) {
    var $this = $(this);

    // If already clicked and navigation started → block it
    if ($this.data('clicked') && isNavigating) {
      e.preventDefault();
      return false;
    }

    // Otherwise allow click (e.g. validation error, still on same page)
    $this.data('clicked', true);
  });

  // Handle going back from bfcache (restore normal state)
  $(window).on('pageshow', function (event) {
    if (event.originalEvent.persisted) {
      $('.prevent-double').each(function () {
        $(this).data('clicked', false)
               .css({'pointer-events': '', 'opacity': ''});
      });
      isNavigating = false;
    }
  });
});
