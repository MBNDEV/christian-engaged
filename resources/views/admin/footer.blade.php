<footer class="main-footer">
    Copyright &copy; 2018 <a href="#">Christianity Engaged</a>
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        All rights reserved
    </div>
    <!-- Default to the left -->
</footer>
<script>
//$(function () {
//    $('input').iCheck({
//        checkboxClass: 'icheckbox_square-blue',
//        radioClass: 'iradio_square-blue',
//        increaseArea: '20%' // optional
//    });
//});
</script>
<script>

    $(document).ready(function () {
        var path = window.location.pathname;

        var pageName = path.split("/")[1];

        if (pageName.length > 0) {
            $(".sidebar-menu").find('.active').removeClass('active');
        }

        $(".sidebar-menu").find('.' + pageName).addClass('active');

    });

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor

    });

</script>

