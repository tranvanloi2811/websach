<!-- sét điều kiện -->
<script>
    $(document).ready(function () {
        window.setTimeout(function() {
            $(".alert").fadeOut(1000, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 5000);
    });
</script>