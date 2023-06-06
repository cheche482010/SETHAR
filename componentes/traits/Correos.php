<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

trait Correos
{
    /**
     * Instancia de PHPMailer para enviar correos electrónicos.
     *
     * @var PHPMailer
     */
    public $mail;

    /**
     * Envia un correo electrónico utilizando PHPMailer.
     *
     * @param array $credenciales Arreglo con las credenciales del servidor SMTP.
     * @param array $origen Arreglo con los datos del remitente.
     * @param string $destinatario Dirección de correo del destinatario.
     * @param string $asunto Asunto del correo.
     * @param string $mensaje Contenido del correo.
     * @return bool|string Retorna true si el correo se envió correctamente, o un mensaje de error en caso contrario.
     * @throws Exception Si ocurre un error al enviar el correo.
     */
    public function Enviar_Correo($credenciales, $origen, $destinatario, $asunto, $mensaje)
    {
        try {
            // Configuración del servidor SMTP
            $this->mail = new PHPMailer(true);
            $this->mail->isSMTP();
            $this->mail->Host       = $credenciales["Servidor"]; // Reemplaza con tu servidor SMTP
            $this->mail->SMTPAuth   = $credenciales["SMTPAuth"];
            $this->mail->Username   = $credenciales["Usuario"]; // Reemplaza con tu usuario SMTP
            $this->mail->Password   = $credenciales["Contraseña"]; // Reemplaza con tu contraseña SMTP
            $this->mail->SMTPSecure = $credenciales["SMTPSecure"];
            $this->mail->Port       = $credenciales["Puerto"];

            // Configuración del remitente y destinatario
            $this->mail->setFrom($origen["correo"], $origen["nombre"]);
            $this->mail->addAddress($destinatario);

            // Contenido del correo
            $this->mail->isHTML(true);
            $this->mail->Subject = $asunto;
            $this->mail->Body    = $mensaje;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return $this->mail->ErrorInfo;
        }
    }

    /**
     * Adjunta un archivo al correo electrónico.
     *
     * @param string $rutaArchivo Ruta completa del archivo a adjuntar.
     * @param string $nombreArchivo Nombre del archivo adjunto.
     */
    public function Adjuntar_Archivo($rutaArchivo, $nombreArchivo)
    {
        $this->mail->addAttachment($rutaArchivo, $nombreArchivo);
    }

    /**
     * Agrega una copia (CC) al correo electrónico.
     *
     * @param string $correo Dirección de correo de la copia.
     */
    public function Agregar_Copia($correo)
    {
        $this->mail->addCC($correo);
    }

    /**
     * Agrega una copia oculta (BCC) al correo electrónico.
     *
     * @param string $correo Dirección de correo de la copia oculta.
     */
    public function Agregar_Copia_Oculta($correo)
    {
        $this->mail->addBCC($correo);
    }

    /**
     * Envia un correo electrónico personalizado utilizando una plantilla.
     *
     * @param string $destinatario Dirección de correo del destinatario.
     * @param string $asunto Asunto del correo.
     * @param array $datos Arreglo con los datos para reemplazar en la plantilla del mensaje.
     * @param string $ruta Ruta completa de la plantilla del mensaje.
     */
    public function Enviar_Correo_Personalizado($destinatario, $asunto, $datos, $ruta)
    {
        // Cargar plantilla de correo
        $plantilla = file_get_contents($ruta);

        // Reemplazar marcadores de posición con datos
        $mensaje = str_replace('{nombre}', $datos['nombre'], $plantilla);
        $mensaje = str_replace('{edad}', $datos['edad'], $mensaje);

        // Enviar correo
        $this->Enviar_Correo($destinatario, $asunto, $mensaje);
    }
}
