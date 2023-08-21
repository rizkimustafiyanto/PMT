<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->

  <!-- Default to the left -->
  <strong>Copyright &copy; 2023 <a href="https://adminlte.io">Persada Solusi Data</a>.</strong> All rights reserved.
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

  //SweetAlert Hapus
  $('.tombol-hapus').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
      title: 'Apakah anda yakin',
      text: "akan menghapus data ini ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Data'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
        Swal.fire(
          'Dihapus!',
          'Data berhasil dihapus',
          'success'
        )
      }
    })

  });
</script>
<!-- <script type="text/javascript" src="javascript/counter.js"></script> -->
</body>

</html>