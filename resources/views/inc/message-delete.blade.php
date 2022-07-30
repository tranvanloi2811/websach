<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show-confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: 'Bạn có chắc muốn xóa không?',
              text: "Nếu xóa xẽ mất dữ liệu đang có.",
              icon: "warning",
              // showCloseButton: true,
              // showCancelButton: true,
              // confirmButtonText: "Có",
              // cancelButtonText: "Không",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>