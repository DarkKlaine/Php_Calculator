<!doctype html>
<html lang="ru">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png"/>
    <!--plugins-->
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <title>DKEngine</title>
</head>

<body class="bg-theme bg-theme9">
<!--wrapper-->
<div class="wrapper">
    <header class="login-header shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded fixed-top rounded-0 shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <h4 class="logo-text">DK Engine (<?php

                        use Modules\User\Controllers\UserConst;

                        echo $_SESSION['username'] ?? UserConst::GUEST_NAME ?>)</h4>
                </a>
                <!--ТУТ ВСТАВЛЯТЬ ШАБЛОН ССЫЛОК НАЧАЛО -->
                <?php $this->injectMenuTpl() ?>
                <!--ТУТ ВСТАВЛЯТЬ ШАБЛОН ССЫЛОК КОНЕЦ -->
            </div>
        </nav>
    </header>
    <div class="section-calculator d-flex align-items-center justify-content-center my-5 my-lg-4">
        <div class="container-fluid col-md-auto"
             style="min-width: 500px; max-width: 1800px; min-height: 100px; max-height: 750px;">
            <div class=" row row-cols-1 row-cols-lg-1 row-cols-xl-1
        ">
                <div class="col mx-auto">
                    <div class="card mt-5 mt-lg-0">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <!-- ТУТ ВСТАВЛЯТЬ ШАБЛОН СТРАНИЦЫ НАЧАЛО -->
                                <?php $this->injectContentTpl() ?>
                                <!-- ТУТ ВСТАВЛЯТЬ ШАБЛОН СТРАНИЦЫ КОНЕЦ -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <footer class="bg-light shadow-sm border-top p-2 text-center fixed-bottom">
    </footer>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>

<script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "columns": [{
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }]
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#history').DataTable({
            "order": [[2, "desc"]],
            "columns": [{
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": true
            }]
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#userhistory').DataTable({
            "order": [[1, "desc"]],
            "columns": [
                {"orderable": false},
                {"orderable": true}
            ]
        });
    });
</script>
<script>
    function addText(buttonId) {
        var input = document.getElementById("inputExpression");
        var button = document.getElementById(buttonId);
        var text = button.getAttribute("data-text");
        input.value += text;
    }
</script>
<!--ТУТ ВСТАВЛЯТЬ ШАБЛОН СКРИПТА ПАРОЛЕЙ НАЧАЛО -->
<?php $this->injectScriptTpl() ?>
<!--ТУТ ВСТАВЛЯТЬ ШАБЛОН СКРИПТА ПАРОЛЕЙ КОНЕЦ -->
<!--app JS-->
<script src="/assets/js/app.js"></script>
</body>

</html>
