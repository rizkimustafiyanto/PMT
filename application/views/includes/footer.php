<div id="profile-popup" class="text-center">
  <div class="col-md-12 text-center">
    <div class="card text-center" style="border-radius: 20px;width: 200px; height:200px;">
      <div class="text-center overflow-auto">
        <img src="" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 100px; height: 100px; margin-top: 20px;" id="profile-image">
        <p class="small" id="profile-name" style="margin-top: 10px; margin-bottom: 0px;">Nama Anda</p>
        <p class="text-muted small" id="profile-company" style="margin-top: 0px;">Motto Anda</p>
      </div>
    </div>
  </div>
</div>


<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->

  <!-- Default to the left -->
  <strong>Copyright PMT version 1.0.3 &copy; 2023 <a href="https://persada-group.com/psd/">Persada Solusi Data</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<!-- Page specific script -->
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>


<!-- EMOJI -->
<script>
  function convertEmojiToHtmlDec(message) {
    var convertedMessage = message.replace(/([\uD800-\uDBFF][\uDC00-\uDFFF])/g, function(match) {
      var emojiDecValue = match.codePointAt(0);
      return '&#' + emojiDecValue;
    });
    return convertedMessage;
  }

  function toggleEmojiPicker() {
    var emojiPicker = document.querySelector('.emoji-picker');
    if (emojiPicker.style.display === 'none' || emojiPicker.style.display === '') {
      emojiPicker.style.display = 'block';
    } else {
      emojiPicker.style.display = 'none';
    }
    event.stopPropagation();
  }

  function insertEmoji(emoji) {
    var textarea = document.getElementById('message-input');
    var cursorPosition = textarea.selectionStart;
    var textBeforeCursor = textarea.value.substring(0, cursorPosition);
    var textAfterCursor = textarea.value.substring(cursorPosition);
    var emojiToAdd = ' ' + emoji + ' ';
    var updatedText = textBeforeCursor + emojiToAdd + textAfterCursor;
    textarea.value = updatedText;
    textarea.selectionStart = cursorPosition + emojiToAdd.length;
    textarea.selectionEnd = cursorPosition + emojiToAdd.length;
    textarea.focus();
  }
</script>
<!-- END EMOJI -->

<!-- NOTIFICATION -->
<script>
  var lengthNotif = 0;
  var dropdown = $('#dropdownMessage');

  function updateNotifications() {
    $.ajax({
      url: '<?= base_url() ?>get_notif',
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        var totalNotif = response.totalNotif;
        var lengthIn = response.lengthIn;
        var notifications = response.notifications;

        if (lengthIn !== lengthNotif) {
          lengthNotif = lengthIn;
          dropdown.empty();
          if (totalNotif !== null && totalNotif !== 0) {
            $('.navbar-badge').text(totalNotif);
          } else {
            var potosin = ('<?= $this->session->userdata('gender_id') ?>' == 'GR-001') ? '<?= base_url(); ?>assets/dist/img/avatar5.png' : '<?= base_url(); ?>assets/dist/img/avatar3.png';
            $('.navbar-badge').text('');
            createNotificationItem(potosin, 'Empty Message', 'Empty', '-', '', 'javascript:void(0)');
          }

          notifications.forEach(function(notif) {
            var photo_url = notif.photo_url;
            var potoBox = (notif.gender_id === 'GR-001') ? '<?= base_url(); ?>assets/dist/img/avatar5.png' : '<?= base_url(); ?>assets/dist/img/avatar3.png';
            var sender_name = notif.sender_name;
            var isImportant = notif.isImportant;
            var message = notif.message;
            var originalDate = notif.created_at;
            var date = new Date(originalDate);
            var urlNotif = notif.url;
            var formattedDate = date.toLocaleString('en-US', {
              year: 'numeric',
              month: 'numeric',
              day: 'numeric',
              hour: 'numeric',
              minute: 'numeric'
            });

            createNotificationItem(photo_url, sender_name, message, formattedDate, isImportant, urlNotif);
          });
        }
      },
      error: function(error) {
        console.error('Gagal memperbarui notifikasi: ', error);
      }
    });
  }

  setInterval(updateNotifications, 1000);

  function createNotificationItem(image, sender, message, date, isImportant = false, notifurl) {
    var iconColor = isImportant ? 'danger' : 'warning';

    var notifItem = '<a href="' + notifurl + '" class="dropdown-item">' +
      '<div class="media">' +
      '<img src="' + image + '" alt="User Avatar" class="mr-3 img-circle" style="width: 60px; height: 60px;">' +
      '<div class="media-body">' +
      '<div class="row">' +
      '<div class="col-9">' +
      '<h3 class="dropdown-item-title overflow-hidden" style="max-width: 200px;">' +
      '<span class="text-truncate">' + sender + '</span>' +
      '</h3>' +
      '</div>' +
      '<div class="col-3 text-right">' +
      '<span class="text-sm text-' + iconColor + '">' +
      '<i class="fas fa-star"></i>' +
      '</span>' +
      '</div>' +
      '</div>' +
      '<p class="text-sm text-truncate" style="max-width: 95%;max-height:20px;">' + message + '</p>' +
      '<p class="text-sm text-muted">' +
      '<i class="far fa-clock mr-1"></i>' + date +
      '</p>' +
      '</div>' +
      '</div>' +
      '</a>' +
      '<div class="dropdown-divider"></div>';

    dropdown.append(notifItem);
  }
</script>
<!-- END NOTIFICATION -->

<script>
  $(function() {
    $("#example1")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        order: [
          [0, "desc"]
        ]

      })
      .buttons()
      .container()
      .appendTo("#example1_wrapper .col-md-6:eq(0)");

    $("#employee")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        order: [
          [1, "asc"]
        ]

      })
      .buttons()
      .container()
      .appendTo("#employee_wrapper .col-md-6:eq(0)");

    $("#example2")
      .DataTable({
        responsive: true,
        lengthChange: false,
        searching: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        order: [
          [0, "asc"]
        ]
      })
      .buttons()
      .container()
      .appendTo("#example1_wrapper .col-md-6:eq(0)");

    $("#example3")
      .DataTable({
        responsive: true,
        lengthChange: true,
        searching: true,
        autoWidth: false,
        buttons: false,
        order: [
          [0, "desc"]
        ]
      })
      .buttons()
      .container()
      .appendTo("#example3_wrapper .col-md-6:eq(0)");

    $('#reservationdatetime').datetimepicker({
      icons: {
        time: 'far fa-clock'
      }
    });
    $('#reservationdatetimeupdate').datetimepicker({
      icons: {
        time: 'far fa-clock'
      }
    });

    $('.select2').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
  // TOOLS BUTTON MESSAGE
  function handleKeyDown(event) {
    if (event.key === 'Enter' && event.shiftKey) {
      event.preventDefault();
      const messageInput = document.getElementById('message-input');
      messageInput.value += '\n';
      adjustInputHeight(messageInput);
    }
  }

  function handleDown1(event) {
    if (event.key === 'Enter' && event.shiftKey) {
      event.preventDefault();
      const descriptionImage = document.getElementById('image-description');
      descriptionImage.value += '\n';
      adjustInputHeight(descriptionImage);
    }
  }

  function handleDown2(event) {
    if (event.key === 'Enter' && event.shiftKey) {
      event.preventDefault();
      const descriptionImageFile = document.getElementById('file-description');
      descriptionImageFile.value += '\n';
      adjustInputHeight(descriptionImageFile);
    }
  }

  function adjustInputHeight(input) {
    input.style.height = 'auto';
    input.style.height = input.scrollHeight + 'px';
    input.style.overflow = "hidden";
    if (input.value.trim() === '') {
      input.style.height = 40 + 'px';
    }
  }


  // TOOLS SELECT MULTIPLE
  function warnaMultiple() {
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      $('.select2-selection').css({
        'background-color': '#343a40',
        'border-color': '#6c757d',
        'color': '#fff'
      });
    } else {
      $('.select2-selection').css({
        'background-color': '#fff',
        'border-color': '#ccc',
        'color': '#000'
      });
    }
  }

  function colorSelect(member) {
    return $('<span style="color: #006fe6;">' + member.text + '</span>');
  }

  //SUMMERNOTES
  $(document).ready(function() {
    $('.editor').each(function() {
      $(this).summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'strikethrough']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']],
        ],
        callbacks: {
          onInit: function() {
            // Pengaturan awal saat inisialisasi
          },
          onFocus: function() {
            $(this).parent().css({
              boxShadow: '0 0 0 .2rem rgba(0, 123, 255, .25)',
              borderColor: '#80bdff'
            });
          },
          onBlur: function() {
            $(this).parent().css({
              boxShadow: '',
              borderColor: ''
            });
          },
          onImageUpload: function(files) {
            for (var i = 0; i < files.length; i++) {
              var file = files[i];
              var data = new FormData();
              data.append('image', file);
              var editor = $(this);
              $.ajax({
                url: '<?= base_url() ?>ProcImage',
                method: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                  var textarea = editor;
                  var html = textarea.val();
                  var imgElement = "<img src='" + url + "' alt='Gambar' style='height:100%;width:100%;'>";
                  var newHtml = html + ' ' + imgElement;
                  textarea.summernote('code', newHtml);
                  // console.log(imgElement);
                },
                error: function(data) {
                  console.log(data);
                }
              });
            }
          }

        }
      });
    });
  });


  // TOOLS DATERANGE
  function dateRangeLightTheme() {
    $(".calendar-table").css("background-color", "#fff");
    $(".calendar-table").css("color", "#000");
  }

  function dateRangeDarkTheme() {
    $(".calendar-table").css("background-color", "#333");
    $(".calendar-table").css("color", "#fff");
  }

  function dateRangeTheme() {
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      dateRangeDarkTheme();
    } else {
      dateRangeLightTheme();
    }
  }
  //TOOLS Loading
  function loadIng() {
    Swal.fire({
      html: '<div class="loading-container"><div class="loading-circle"></div></div>',
      allowOutsideClick: false,
      showConfirmButton: false,
      onBeforeOpen: () => {}
    });
  }

  // TOOLS OPEN IMAGE
  function bukaGambarBaru(event) {
    var gambar = event.target.src;
    var jendelaBaru = window.open();
    jendelaBaru.document.write('<img src="' + gambar + '" alt="Deskripsi Gambar">');
  }
</script>
<!-- For Profile -->
<script>
  const profileTriggers = document.querySelectorAll(".profile-trigger");
  const profilePopup = document.getElementById("profile-popup");

  profileTriggers.forEach(trigger => {
    trigger.addEventListener("click", (event) => {
      event.stopPropagation();
      const imageUrl = trigger.getAttribute("data-src");
      const proName = trigger.getAttribute("data-member-name");
      const proComp = trigger.getAttribute("data-member-company");

      const profileImage = document.getElementById("profile-image");
      profileImage.src = imageUrl;
      const profileName = document.getElementById("profile-name");
      profileName.textContent = proName;
      const profileCompany = document.getElementById("profile-company");
      profileCompany.textContent = proComp;

      profilePopup.style.display = "block";

      const imageRect = trigger.getBoundingClientRect();
      const popupWidth = profilePopup.clientWidth;
      const topPosition = imageRect.top + window.scrollY - profilePopup.clientHeight + 10 + "px";
      const leftPosition = imageRect.left + window.scrollX + (imageRect.width - popupWidth) / 2 + "px";

      profilePopup.style.top = topPosition;
      profilePopup.style.left = leftPosition;
    });
  });

  document.addEventListener("click", (event) => {
    if (profilePopup.style.display === "block" && !profilePopup.contains(event.target)) {
      profilePopup.style.display = "none";
    }
  });

  var profileImage = document.getElementById("profile-image");
  profileImage.addEventListener("click", function() {
    window.open(profileImage.src, "_blank");
  });
</script>
<!-- Untuk Ganti Theme -->
<script>
  $(document).ready(function() {
    var body = $('body');
    var themeBtn = $('#themeBtn');
    var mnusValue = $('#menuactive').data('mnus');
    // console.log(mnusValue);

    if (mnusValue === 'Dashboard') {
      body.removeClass('sidebar-collapse');
    } else {
      body.addClass('sidebar-collapse');
    }


    // Tambahkan kelas tema terang saat halaman dimuat
    body.addClass('light-mode');
    $('.main-header').addClass('navbar-light');
    $('.main-sidebar').addClass('sidebar-light-primary');

    themeBtn.on('click', function() {
      warnaMultiple();
      dateRangeTheme();
      body.toggleClass('dark-mode');
      $('.main-header').toggleClass('navbar-dark');
      $('.main-sidebar').toggleClass('sidebar-dark-primary');
      $('.main-sidebar').toggleClass('sidebar-light-primary');

      // Simpan status tema ke local storage
      if (body.hasClass('dark-mode')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    });

    // Cek Saving Storage
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      body.addClass('dark-mode');
      $('.main-header').addClass('navbar-dark');
      $('.main-sidebar').addClass('sidebar-dark-primary');
      // Hapus kelas tema terang jika tema gelap diaktifkan
      body.removeClass('light-mode');
      $('.main-header').removeClass('navbar-light');
      $('.main-sidebar').removeClass('sidebar-light-primary');
    }
  });
</script>
<!-- <script type="text/javascript" src="javascript/counter.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/summernote/summernote.min.js"></script>


</body>

</html>