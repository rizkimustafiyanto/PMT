<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->

  <!-- Default to the left -->
  <strong>Copyright PMT version 1.0.0 &copy; 2023 <a href="https://persada-group.com/psd/">Persada Solusi Data</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<!-- Page specific script -->

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
          }
        }
      });
    });
  });
</script>

<!-- Untuk Ganti Theme -->
<script>
  $(document).ready(function() {
    var body = $('body');
    var themeBtn = $('#themeBtn');

    // Tambahkan kelas tema terang saat halaman dimuat
    body.addClass('light-mode');
    $('.main-header').addClass('navbar-light');
    $('.main-sidebar').addClass('sidebar-light-primary');

    themeBtn.on('click', function() {
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
</body>

</html>