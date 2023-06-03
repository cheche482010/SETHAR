<!DOCTYPE html>
<html lang="es">
    <head>
        <?php Vista::Recursos("Meta");?>
        <?php Vista::Recursos("Titulo");?>
        <?php Vista::Recursos("Estilos");?>
    </head>

    <body class="hold-transition login-page">
        <!-- ============================================================== -->
        <!-- Inicio contenido de pagina -->
        <!-- ============================================================== -->
        <div class="login-box">
        <div class="login-logo">
            Iniciar Sesión
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>

                <form action="login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-default" onclick="ver_clave()">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="recordar">
                                <label for="recordar">Recordarme</label>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <?php Vista::Recursos("Script");?>
    </body>
</html>