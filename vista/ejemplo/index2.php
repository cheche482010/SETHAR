<!DOCTYPE html>
<html lang="es">
    <head>
         <?php Vista::Recursos("Meta") ?>
         <?php Vista::Recursos("Titulo") ?>
         <?php Vista::Recursos("Estilos") ?>
        <!-- ============================Etiquetas Meta====================  -->
        <meta charset="utf-8" />
        <meta name="author" content="Josseth Arroyo" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta name="Description" content="Framewik php SETHAR" />
        <meta name="distribution" content="global" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
        <meta http-equiv="Content-Language" content="es" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <!--=======================Titolu del Sistema============================ -->
        <title id="page-title">
            Reino Plantae
        </title>
        <!-- ============================Estilos============================ -->
        <link rel="stylesheet" href="config/css/import.css" />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="config/plugins/fontawesome-free/css/all.min.css" />
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="config/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="config/css/adminlte.min.css" />
        <link rel="stylesheet" href="config/css/dark.css" />
        <link rel="stylesheet" href="config/plugins/font-awesome/css/all.min.css" />
        <link rel="stylesheet" href="config/plugins/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="config/css/style-3.css" />
        <!-- SweetAlert2 -->
        <link href="config/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <!-- jquery -->
        <script src="config/plugins/jquery/jquery.min.js"></script>
        <script>
            const BASE_URL = "";
            typeof BASE_URL;
        </script>
    </head>

    <body class="hold-transition text-sm layout-top-nav layout-fixed layout-navbar-fixed layout-footer-fixed" id="body">
        <!-- ============================================================== -->
        <!-- Inicio contenido de pagina -->
        <!-- ============================================================== -->
        <main class="wrapper">
            <!-- Barra superior -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href=">" class="nav-link">BTN 1</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="" class="nav-link">BTN2</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Contenido de la pagina -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Plantas IA</h1>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Reino plantae</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body w-100"></div>

                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.content -->
            </div>

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>
                    &copy; SEHTAR.
                </strong>
                <div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0</div>
            </footer>
        </main>

        <!-- ============================================================== -->
        <!-- Javascript  -->
        <!-- ============================================================= -->
        <!-- Bootstrap -->
        <script src="config/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="config/plugins/bootstrap/js/tether.min.js"></script>
        <script src="config/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="config/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="config/js/adminlte.js"></script>
        <!-- SweetAlert2 -->
        <script src="config/plugins/sweetalert/sweetalert.min.js"></script>
        <!-- DataTables -->
        <link rel="stylesheet" href="config/plugins/datatables/media/js/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="config/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="config/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
        <link rel="stylesheet" href="config/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
        <!-- DataTables  & Plugins -->
        <script src="config/js/Data_Tables_Español.js"></script>
        <script src="config/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="config/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="config/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="config/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="config/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="config/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="config/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="config/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    </body>
</html>