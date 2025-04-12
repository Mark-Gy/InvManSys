<!-- REQUIRED SCRIPTS -->
@vite('resources/js/app.js')
<!-- jQuery -->
<script src=" {{ asset('admin/plugins/jquery/jquery.min.js') }} "></script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
<!-- AdminLTE App -->
<script src=" {{ asset('admin/dist/js/adminlte.min.js') }} "></script>

<!-- DataTables -->
<script src=" {{ asset('admin//plugins/datatables/jquery.dataTables.min.js') }} "></script>
<script src=" {{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }} "></script>
<script src=" {{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }} "></script>
<script src=" {{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }} "></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('div.alert').not('.alert-important').delay(2000).fadeOut(200);

    $(".datatable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $(document).ready(function() {
      $('.sa-delete').on('click', function() {
          let form_id = $(this).data('form-id');
          
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this data!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if(willDelete) {
                  $('#'+form_id).submit();
              }
          });
      });
  });
</script>

@stack('scripts')