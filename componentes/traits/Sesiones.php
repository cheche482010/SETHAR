<?php
trait Sesiones
{
    /**
     * Inicia una sesión.
     */
    public function Iniciar_Sesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Cierra la sesión actual.
     */
    public function Cerrar_Sesion()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    /**
     * Establece un valor en la sesión.
     *
     * @param string $clave Clave del valor en la sesión.
     * @param mixed $valor Valor a almacenar en la sesión.
     */
    public function Set_Sesion($clave, $valor)
    {
        $_SESSION[$clave] = $valor;
    }

    /**
     * Obtiene un valor de la sesión.
     *
     * @param string $clave Clave del valor en la sesión.
     * @param mixed $valorDefault Valor a devolver si la clave no existe en la sesión.
     * @return mixed Valor almacenado en la sesión o el valor por defecto si la clave no existe.
     */
    public function Get_Sesion($clave, $valorDefault = null)
    {
        return isset($_SESSION[$clave]) ? $_SESSION[$clave] : $valorDefault;
    }

    /**
     * Elimina un valor de la sesión.
     *
     * @param string $clave Clave del valor en la sesión a eliminar.
     */
    public function Eliminar_Sesion($clave)
    {
        if (isset($_SESSION[$clave])) {
            unset($_SESSION[$clave]);
        }
    }

    /**
     * Verifica si la sesión está activa.
     *
     * @return bool True si la sesión está activa, false en caso contrario.
     */
    public function Sesion_Activa()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * Renueva el ID de sesión y actualiza el tiempo de vida de la sesión.
     */
    public function Renovar_Sesion()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    /**
     * Regenera el ID de sesión y mantiene los datos de sesión existentes.
     */
    public function Regenerar_Id_Sesion()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id();
        }
    }

    /**
     * Establece un tiempo de vida para la sesión en segundos.
     *
     * @param int $tiempoVida Tiempo de vida de la sesión en segundos.
     */
    public function Set_Tiempo_Vida_Sesion($tiempoVida)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_set_cookie_params($tiempoVida);
        }
    }

    /**
     * Obtiene el tiempo de vida actual de la sesión en segundos.
     *
     * @return int Tiempo de vida de la sesión en segundos.
     */
    public function Get_Tiempo_Vida_Sesion()
    {
        return session_get_cookie_params()['lifetime'];
    }

    /**
     * Verifica si la sesión ha expirado.
     *
     * @return bool True si la sesión ha expirado, false en caso contrario.
     */
    public function Sesion_Expirada()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $tiempoVida      = session_get_cookie_params()['lifetime'];
            $ultimaActividad = $this->getSesion('ultima_actividad', 0);

            if (time() - $ultimaActividad > $tiempoVida) {
                return true;
            }
        }

        return false;
    }

    /**
     * Actualiza la marca de tiempo de la última actividad en la sesión.
     */
    public function Actualizar_Ultima_Actividad()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $this->setSesion('ultima_actividad', time());
        }
    }

    /**
     * Guarda en el log todas las sesiones realizadas en un día.
     *
     * @param string $rutaLog Ruta del archivo de log.
     */
    public function Guardar_Sesiones_Bitacora($rutaLog)
    {
        // Obtener la fecha actual
        $fecha = date('Y-m-d');

        // Crear el registro de bitácora
        $bitacora = "Bitácora de sesiones - Fecha: {$fecha}\n";

        // Recorrer todas las sesiones
        foreach ($_SESSION as $nombre => $valor) {
            // Agregar el registro de sesión a la bitácora
            $bitacora .= "Sesión: {$nombre}, Valor: {$valor}\n";
        }

        // Guardar el registro de bitácora en el archivo de log
        file_put_contents($rutaLog, $bitacora, FILE_APPEND);
    }

    // ================================================================================================

    // SESIONES CIFRADAS
    /**
     * Inicia una sesión cifrada para un usuario dado.
     *
     * @param int $idUsuario ID de usuario.
     * @param string $clavePublica Ruta del archivo de clave pública.
     * @param string $clavePrivada Ruta del archivo de clave privada.
     */
    public function Iniciar_Sesion_Cifrada($idUsuario, $clavePublica, $clavePrivada)
    {
        // Generar una clave de sesión aleatoria
        $claveSesion = bin2hex(random_bytes(32));

        // Cifrar la clave de sesión con la clave pública
        $claveCifrada = '';
        openssl_public_encrypt($claveSesion, $claveCifrada, file_get_contents($clavePublica));

        // Almacenar la clave cifrada en la sesión
        $_SESSION['clave_cifrada'] = $claveCifrada;

        // Almacenar el ID de usuario y la clave de sesión en la sesión
        $_SESSION['usuario_id']   = $idUsuario;
        $_SESSION['clave_sesion'] = $claveSesion;

        // Establecer el tiempo de inicio de sesión
        $_SESSION['inicio_sesion'] = time();
    }

    /**
     * Verifica y descifra la sesión cifrada.
     *
     * @param string $clavePublica Ruta del archivo de clave pública.
     * @param string $clavePrivada Ruta del archivo de clave privada.
     * @return bool True si la sesión es válida y descifrada correctamente, false en caso contrario.
     */
    public function Verificar_Sesion_Cifrada($clavePublica, $clavePrivada)
    {
        // Verificar si la clave cifrada y la clave de sesión existen en la sesión
        if (!isset($_SESSION['clave_cifrada']) || !isset($_SESSION['clave_sesion'])) {
            return false;
        }

        // Descifrar la clave de sesión con la clave privada
        $claveDescifrada = '';
        openssl_private_decrypt($_SESSION['clave_cifrada'], $claveDescifrada, file_get_contents($clavePrivada));

        // Verificar si la clave descifrada coincide con la clave de sesión almacenada en la sesión
        if ($_SESSION['clave_sesion'] !== $claveDescifrada) {
            return false;
        }

        // Verificar el tiempo de inicio de sesión (opcional)
        $tiempoMaximoSesion = 3600; // Tiempo máximo de sesión en segundos (ejemplo: 1 hora)
        if (isset($_SESSION['inicio_sesion']) && (time() - $_SESSION['inicio_sesion'] > $tiempoMaximoSesion)) {
            // La sesión ha expirado, cerrar la sesión
            $this->Cerrar_Sesion();
            return false;
        }

        // La sesión es válida y descifrada correctamente
        return true;
    }

    /**
     * Obtiene el valor de una sesión descifrada.
     *
     * @param string $nombre Nombre de la sesión.
     * @param string $clavePublica Ruta del archivo de clave pública.
     * @param string $clavePrivada Ruta del archivo de clave privada.
     * @return mixed Valor de la sesión si existe y es descifrada correctamente, null en caso contrario.
     */
    public function Obtener_Sesion_Descifrada($nombre, $clavePublica, $clavePrivada)
    {
        // Verificar y descifrar la sesión cifrada
        if ($this->Verificar_Sesion_Cifrada($clavePublica, $clavePrivada)) {
            // Obtener el valor de la sesión si existe
            if (isset($_SESSION[$nombre])) {
                $valorCifrado    = $_SESSION[$nombre];
                $valorDescifrado = '';
                openssl_private_decrypt($valorCifrado, $valorDescifrado, file_get_contents($clavePrivada));
                return $valorDescifrado;
            }
        }

        // La sesión no existe o no se pudo descifrar
        return null;
    }
}
