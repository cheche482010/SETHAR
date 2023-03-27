<!DOCTYPE html>
<html lang="es">
    <head>
        <?php Vista::Recursos("Meta"); ?>
        <?php Vista::Recursos("Titulo"); ?>
        <?php Vista::Recursos("Estilos"); ?>
    </head>

    <body class="hold-transition text-sm layout-top-nav layout-fixed layout-navbar-fixed layout-footer-fixed" id="body">
        <!-- ============================================================== -->
        <!-- Inicio contenido de pagina -->
        <!-- ============================================================== -->
        <main class="wrapper">
            <?php Vista::Recursos("Navbar"); ?>
            <!-- Contenido de la pagina -->
            <div class="content-wrapper">
                <?php Vista::Recursos("Contenido"); ?>
            </div>
            <!-- /.content-wrapper -->
            <?php Vista::Recursos("Footer"); ?>
        </main>
        <?php Vista::Recursos("Script"); ?>
    </body>
</html>