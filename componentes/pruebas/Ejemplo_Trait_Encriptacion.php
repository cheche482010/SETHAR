<?php

use Componentes\Funciones\Correos;

class Ejemplo_Trait_Encriptacion
{
    use Encriptacion;

    public function ejemploEncriptarAES()
    {
        $texto = "Texto a encriptar";
        $clave = "Clave de encriptación";

        $textoEncriptado = $this->Encriptar_AES($texto, $clave);
        echo "Texto encriptado: " . $textoEncriptado . "\n";

        $textoDesencriptado = $this->Desencriptar_AES($textoEncriptado, $clave);
        echo "Texto desencriptado: " . $textoDesencriptado . "\n";
    }

    public function ejemploEncriptarRSA()
    {
        $texto = "Texto a encriptar";
        $clavePublica = "Clave pública RSA";

        $textoEncriptado = $this->Encriptar_RSA($texto, $clavePublica);
        echo "Texto encriptado: " . $textoEncriptado . "\n";

        $textoDesencriptado = $this->Desencriptar_RSA($textoEncriptado, $clavePrivada);
        echo "Texto desencriptado: " . $textoDesencriptado . "\n";
    }

    public function ejemploGenerarHashContrasena()
    {
        $contrasena = "contrasena";

        $hash = $this->Generar_Hash_Contrasena($contrasena);
        echo "Hash de la contraseña: " . $hash . "\n";

        $verificacion = $this->Verificar_Contrasena($contrasena, $hash);
        echo "La contraseña coincide: " . ($verificacion ? "Sí" : "No") . "\n";
    }

    public function ejemploEncriptarHibrido()
    {
        $texto = "Texto a encriptar";
        $clavePublica = "Clave pública RSA";
        $claveAES = "Clave AES";

        $textoEncriptado = $this->Encriptar_Hibrido($texto, $clavePublica, $claveAES);
        echo "Texto encriptado: " . $textoEncriptado . "\n";

        $textoDesencriptado = $this->Desencriptar_Hibrido($textoEncriptado, $clavePrivada);
        echo "Texto desencriptado: " . $textoDesencriptado . "\n";
    }

    public function ejemploEncriptarURL()
    {
        $url = "https://www.ejemplo.com";
        $clave = "Clave de encriptación";

        $urlEncriptada = $this->Encriptar_URL($url, $clave);
        echo "URL encriptada: " . $urlEncriptada . "\n";

        $urlDesencriptada = $this->Desencriptar_URL($urlEncriptada, $clave);
        echo "URL desencriptada: " . $urlDesencriptada . "\n";
    }

    public function ejemploSeguridad()
    {
        $string = "Texto a encriptar";

        $stringEncriptado = self::Seguridad($string, 'codificar');
        echo "Texto encriptado: " . $stringEncriptado . "\n";

        $stringDesencriptado = self::Seguridad($stringEncriptado, 'decodificar');
        echo "Texto desencriptado: " . $stringDesencriptado . "\n";
    }
}


?>
