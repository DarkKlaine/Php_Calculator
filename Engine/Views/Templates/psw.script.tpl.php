<script>
    $(document).ready(function () {
        $("#password a").on('click', function (event) {
            event.preventDefault();
            if ($('#password input').attr("type") == "text") {
                $('#password input').attr('type', 'password');
                $('#password i').addClass("bx-hide");
                $('#password i').removeClass("bx-show");
            } else if ($('#password input').attr("type") == "password") {
                $('#password input').attr('type', 'text');
                $('#password i').removeClass("bx-hide");
                $('#password i').addClass("bx-show");
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#confirm_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#confirm_password input').attr("type") == "text") {
                $('#confirm_password input').attr('type', 'password');
                $('#confirm_password i').addClass("bx-hide");
                $('#confirm_password i').removeClass("bx-show");
            } else if ($('#confirm_password input').attr("type") == "password") {
                $('#confirm_password input').attr('type', 'text');
                $('#confirm_password i').removeClass("bx-hide");
                $('#confirm_password i').addClass("bx-show");
            }
        });
    });
</script>
