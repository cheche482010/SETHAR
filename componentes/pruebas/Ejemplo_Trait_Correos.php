<?php

use Componentes\Funciones\Correos;

class Ejemplo_Trait_Correos
{
    use Correos;

    /**
     * Ejemplo de envío de correo electrónico utilizando PHPMailer.
     */
    public function ejemploEnviarCorreo()
    {
        $credenciales = [
            "Servidor" => "smtp.example.com",
            "SMTPAuth" => true,
            "Usuario" => "tu_usuario",
            "Contraseña" => "tu_contraseña",
            "SMTPSecure" => "tls",
            "Puerto" => 587
        ];

        $origen = [
            "correo" => "remitente@example.com",
            "nombre" => "Remitente"
        ];

        $destinatario = "destinatario@example.com";
        $asunto = "Ejemplo de correo electrónico";
        $mensaje = "<h1>Hola, esto es un ejemplo de correo electrónico.</h1>";

        $resultado = $this->Enviar_Correo($credenciales, $origen, $destinatario, $asunto, $mensaje);

        if ($resultado === true) {
            echo "Correo enviado correctamente.";
        } else {
            echo "Error al enviar el correo: $resultado";
        }
    }

    /**
     * Ejemplo de adjuntar un archivo al correo electrónico.
     */
    public function ejemploAdjuntarArchivo()
    {
        $rutaArchivo = "/ruta/completa/al/archivo.pdf";
        $nombreArchivo = "archivo.pdf";

        $this->Adjuntar_Archivo($rutaArchivo, $nombreArchivo);

        // Continuar con el envío del correo...
    }

    /**
     * Ejemplo de agregar una copia (CC) al correo electrónico.
     */
    public function ejemploAgregarCopia()
    {
        $correoCopia = "copia@example.com";

        $this->Agregar_Copia($correoCopia);

        // Continuar con el envío del correo...
    }

    /**
     * Ejemplo de agregar una copia oculta (BCC) al correo electrónico.
     */
    public function ejemploAgregarCopiaOculta()
    {
        $correoCopiaOculta = "copia_oculta@example.com";

        $this->Agregar_Copia_Oculta($correoCopiaOculta);

        // Continuar con el envío del correo...
    }

    /**
     * Ejemplo de envío de correo electrónico personalizado utilizando una plantilla.
     */
    public function ejemploEnviarCorreoPersonalizado()
    {
        $destinatario = "destinatario@example.com";
        $asunto = "Ejemplo de correo personalizado";
        $datos = [
            "nombre" => "Juan",
            "edad" => 30
        ];
        $rutaPlantilla = "/ruta/completa/de/plantilla.html";

        $this->Enviar_Correo_Personalizado($destinatario, $asunto, $datos, $rutaPlantilla);

        // Continuar con el envío del correo...
    }
}
