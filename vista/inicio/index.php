<!DOCTYPE html>
<html lang="es">
    <head>
        <?php Vista::Recursos("Meta"); ?>
        <?php Vista::Recursos("Titulo"); ?>
        <?php Vista::Recursos("Estilos"); ?>
    </head>

    <body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Barra de navegación -->
        <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
            <!-- Logo -->
            <a href="#" class="navbar-brand">
                <span class="brand-text font-weight-light">SETHAR</span>
            </a>

            <!-- Menú de navegación -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="javascript::void(0)" class="nav-link">Inicio</a>
                </li>
               
                <li class="nav-item">
                    <a href="javascript::void(0)" class="nav-link">Contacto</a>
                </li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pagina de Inicio</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Bienvenido al Framework SETHAR</h3>
                        <p>Este es un ejemplo de contenido para la sección principal de un framework. Aquí puedes agregar todo el contenido relevante para tu aplicación o proyecto.</p>
                        <p>Puedes incluir texto, imágenes, formularios, tablas u otros elementos HTML según tus necesidades.</p>
                        <p>Utiliza las clases y componentes proporcionados por el framework para dar estilo y funcionalidad a tu contenido.</p>
                        <p>¡Comienza a desarrollar tu aplicación y aprovecha al máximo las capacidades del framework XYZ!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </section>
        </div>

        <?php Vista::Recursos("Script"); ?>
    </body>
</html>