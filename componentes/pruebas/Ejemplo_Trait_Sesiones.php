<?php

class Ejemplo_Trait_Sesiones
{
    use Sesiones;

    public function __construct()
    {
        // Aquí va la lógica de inicialización de la clase
    }

    public function ejemploIniciarSesion()
    {
        $this->Iniciar_Sesion();
    }

    public function ejemploCerrarSesion()
    {
        $this->Cerrar_Sesion();
    }

    public function ejemploSetSesion()
    {
        $clave = "usuario";
        $valor = "John Doe";

        $this->Set_Sesion($clave, $valor);
    }

    public function ejemploGetSesion()
    {
        $clave = "usuario";
        $valorDefault = "Invitado";

        $valor = $this->Get_Sesion($clave, $valorDefault);
        echo "Usuario: " . $valor;
    }

    public function ejemploEliminarSesion()
    {
        $clave = "usuario";

        $this->Eliminar_Sesion($clave);
    }

    public function ejemploSesionActiva()
    {
        $sesionActiva = $this->Sesion_Activa();
        echo $sesionActiva ? "La sesión está activa" : "La sesión no está activa";
    }

    public function ejemploRenovarSesion()
    {
        $this->Renovar_Sesion();
    }

    public function ejemploRegenerarIdSesion()
    {
        $this->Regenerar_Id_Sesion();
    }

    public function ejemploSetTiempoVidaSesion()
    {
        $tiempoVida = 3600; // 1 hora

        $this->Set_Tiempo_Vida_Sesion($tiempoVida);
    }

    public function ejemploGetTiempoVidaSesion()
    {
        $tiempoVida = $this->Get_Tiempo_Vida_Sesion();
        echo "Tiempo de vida de la sesión: " . $tiempoVida . " segundos";
    }

    public function ejemploSesionExpirada()
    {
        $sesionExpirada = $this->Sesion_Expirada();
        echo $sesionExpirada ? "La sesión ha expirado" : "La sesión no ha expirado";
    }

    public function ejemploActualizarUltimaActividad()
    {
        $this->Actualizar_Ultima_Actividad();
    }

    public function ejemploGuardarSesionesBitacora($rutaLog)
    {
        $this->Guardar_Sesiones_Bitacora($rutaLog);
    }

    // Ejemplos de sesiones cifradas

    public function ejemploIniciarSesionCifrada($idUsuario, $clavePublica, $clavePrivada)
    {
        $this->Iniciar_Sesion_Cifrada($idUsuario, $clavePublica, $clavePrivada);
    }

    public function ejemploVerificarSesionCifrada($clavePublica, $clavePrivada)
    {
        $sesionValida = $this->Verificar_Sesion_Cifrada($clavePublica, $clavePrivada);
        echo $sesionValida ? "La sesión es válida y descifrada correctamente" : "La sesión no es válida o no se pudo descifrar";
    }

    public function ejemploObtenerSesionDescifrada($nombre, $clavePublica, $clavePrivada)
    {
        $valorSesion = $this->Obtener_Sesion_Descifrada($nombre, $clavePublica, $clavePrivada);
        echo "Valor de la sesión descifrada: " . $valorSesion;
    }
}
