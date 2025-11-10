
   $(document).ready(function() {
    const $sidebar = $('#sidebar');
    const $overlay = $('#sidebarOverlay');
    const $mainContent = $('#mainContent');
    const $toggleBtn = $('#toggleSidebar');
    const $closeBtn = $('#closeSidebar');

    // ✅ Initialize sidebar visibility on page load
    function setInitialSidebarState() {
        if ($(window).width() < 1024) {
            $sidebar.addClass('collapsed');
            $overlay.removeClass('active');
            $mainContent.removeClass('expanded');
        } else {
            $sidebar.removeClass('collapsed');
            $overlay.removeClass('active');
            $mainContent.addClass('expanded');
        }
    }

    // Run on load
    setInitialSidebarState();

    // ✅ Toggle sidebar (mobile vs desktop)
    $toggleBtn.on('click', function() {
        if ($(window).width() < 1024) {
            $sidebar.toggleClass('collapsed');
            $overlay.toggleClass('active');
        } else {
            $sidebar.toggleClass('collapsed');
            $mainContent.toggleClass('expanded');
        }
    });

    // ✅ Close sidebar when overlay clicked
    $overlay.on('click', function() {
        $sidebar.addClass('collapsed');
        $overlay.removeClass('active');
    });

    // ✅ Close sidebar when close button clicked
    $closeBtn.on('click', function() {
        $sidebar.addClass('collapsed');
        $overlay.removeClass('active');
    });

    // ✅ Handle window resize (reset layout)
    $(window).on('resize', function() {
        setInitialSidebarState();
    });
});




    $(document).ready(function () {
        const fileInput = $('#contract_attachments');
        const fileUploadArea = $('#fileUploadArea');
        const browseBtn = $('#browseFiles');
        const fileList = $('#fileList');
        const maxFileSize = 10 * 1024 * 1024; // 10 MB

        // Click "Browse files" button
        browseBtn.on('click', function () {
            fileInput.click();
        });

        // Handle file input selection
        fileInput.on('change', function (e) {
            handleFiles(e.target.files);
        });

        // Drag & drop highlight
        fileUploadArea.on('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('border-green-500 bg-green-50');
        });

        fileUploadArea.on('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('border-green-500 bg-green-50');
        });

        // Handle file drop
        fileUploadArea.on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('border-green-500 bg-green-50');
            const droppedFiles = e.originalEvent.dataTransfer.files;
            fileInput.prop('files', droppedFiles); // link to input
            handleFiles(droppedFiles);
        });

        // Display selected files
        function handleFiles(files) {
            fileList.empty(); // clear previous
            if (!files.length) return;

            $.each(files, function (i, file) {
                const ext = file.name.split('.').pop().toLowerCase();
                const allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
                const validType = allowed.includes(ext);
                const validSize = file.size <= maxFileSize;

                let message = '';
                let icon = '<i class="fas fa-file text-gray-400"></i>';

                if (!validType) {
                    message = '❌ نوع الملف غير مدعوم';
                } else if (!validSize) {
                    message = '❌ حجم الملف يتجاوز 10 ميجابايت';
                }

                if (ext === 'pdf') icon = '<i class="fas fa-file-pdf text-red-500"></i>';
                else if (['jpg', 'jpeg', 'png'].includes(ext)) icon = '<i class="fas fa-file-image text-green-500"></i>';
                else if (['doc', 'docx'].includes(ext)) icon = '<i class="fas fa-file-word text-blue-500"></i>';

                const item = `
                <div class="flex items-center justify-between bg-gray-100 p-2 rounded-md">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        ${icon}
                        <span class="text-gray-800 text-sm font-medium">${file.name}</span>
                    </div>
                    <span class="text-xs ${message ? 'text-red-500' : 'text-gray-500'}">
                        ${message || (file.size / 1024 / 1024).toFixed(2) + ' MB'}
                    </span>
                </div>
            `;

                fileList.append(item);
            });
        }
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
