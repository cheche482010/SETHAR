<?php

namespace Componentes\Funciones;

trait Encriptacion
{
    // Encriptación AES

    /**
     * Encripta un texto utilizando AES-256.
     *
     * @param string $texto Texto a encriptar.
     * @param string $clave Clave de encriptación.
     * @return string Texto encriptado.
     */
    public function Encriptar_AES($texto, $clave)
    {
        $iv               = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $texto_encriptado = openssl_encrypt($texto, 'AES-256-CBC', $clave, 0, $iv);
        return base64_encode($iv . $texto_encriptado);
    }

    /**
     * Desencripta un texto encriptado con AES-256.
     *
     * @param string $texto_encriptado Texto encriptado.
     * @param string $clave Clave de encriptación.
     * @return string Texto desencriptado.
     */
    public function Desencriptar_AES($texto_encriptado, $clave)
    {
        $texto_encriptado = base64_decode($texto_encriptado);
        $iv               = substr($texto_encriptado, 0, openssl_cipher_iv_length('AES-256-CBC'));
        $texto_encriptado = substr($texto_encriptado, openssl_cipher_iv_length('AES-256-CBC'));
        return openssl_decrypt($texto_encriptado, 'AES-256-CBC', $clave, 0, $iv);
    }

    // Encriptación RSA

    /**
     * Encripta un texto utilizando RSA.
     *
     * @param string $texto Texto a encriptar.
     * @param string $clave_publica Clave pública RSA.
     * @return string Texto encriptado.
     */
    public function Encriptar_RSA($texto, $clave_publica)
    {
        openssl_public_encrypt($texto, $texto_encriptado, $clave_publica);
        return base64_encode($texto_encriptado);
    }

    /**
     * Desencripta un texto encriptado con RSA.
     *
     * @param string $texto_encriptado Texto encriptado.
     * @param string $clave_privada Clave privada RSA.
     * @return string Texto desencriptado.
     */
    public function Desencriptar_RSA($texto_encriptado, $clave_privada)
    {
        $texto_encriptado = base64_decode($texto_encriptado);
        openssl_private_decrypt($texto_encriptado, $texto_desencriptado, $clave_privada);
        return $texto_desencriptado;
    }

    // Hash

    /**
     * Genera el hash de una contraseña utilizando bcrypt.
     *
     * @param string $contrasena Contraseña a hashear.
     * @return string Hash de la contraseña.
     */
    public function Generar_Hash_Contrasena($contrasena)
    {
        return password_hash($contrasena, PASSWORD_BCRYPT);
    }

    /**
     * Verifica si una contraseña coincide con su hash.
     *
     * @param string $contrasena Contraseña a verificar.
     * @param string $hash Hash de referencia.
     * @return bool true si la contraseña coincide, false en caso contrario.
     */
    public function Verificar_Contrasena($contrasena, $hash)
    {
        return password_verify($contrasena, $hash);
    }

    /**
     * Verifica la fortaleza de una contraseña.
     *
     * @param string $contrasena Contraseña a verificar.
     * @return bool true si la contraseña cumple con los requisitos de fortaleza, false en caso contrario.
     */
    public function Verificar_Fortaleza_Contrasena($contrasena)
    {
        // Realiza las verificaciones de fortaleza según tus criterios específicos
        // y devuelve true o false en función de los requisitos cumplidos.
        // Aquí hay un ejemplo básico:
        $longitud_minima = 8;
        $tiene_mayuscula = preg_match('/[A-Z]/', $contrasena);
        $tiene_minuscula = preg_match('/[a-z]/', $contrasena);
        $tiene_numero    = preg_match('/[0-9]/', $contrasena);

        return strlen($contrasena) >= $longitud_minima && $tiene_mayuscula && $tiene_minuscula && $tiene_numero;
    }

    /**
     * Encripta un texto utilizando una combinación de RSA y AES.
     *
     * @param string $texto Texto a encriptar.
     * @param string $clave_publica Clave pública RSA.
     * @param string $clave_aes Clave AES.
     * @return string Texto encriptado.
     */
    public function Encriptar_Hibrido($texto, $clave_publica, $clave_aes)
    {
        // Encriptar con AES
        $texto_encriptado_aes = $this->Encriptar_AES($texto, $clave_aes);

        // Encriptar clave AES con RSA
        $clave_encriptada_rsa = $this->Encriptar_RSA($clave_aes, $clave_publica);

        // Combinar texto encriptado AES y clave encriptada RSA
        $texto_encriptado = base64_encode($texto_encriptado_aes . '|' . $clave_encriptada_rsa);

        return $texto_encriptado;
    }

    /**
     * Desencripta un texto encriptado con una combinación de RSA y AES.
     *
     * @param string $texto_encriptado Texto encriptado.
     * @param string $clave_privada Clave privada RSA.
     * @return string Texto desencriptado.
     */
    public function Desencriptar_Hibrido($texto_encriptado, $clave_privada)
    {
        // Separar texto encriptado AES y clave encriptada RSA
        list($texto_encriptado_aes, $clave_encriptada_rsa) = explode('|', base64_decode($texto_encriptado));

        // Desencriptar clave AES con RSA
        $clave_aes = $this->Desencriptar_RSA($clave_encriptada_rsa, $clave_privada);

        // Desencriptar texto AES con clave AES
        $texto_desencriptado = $this->Desencriptar_AES($texto_encriptado_aes, $clave_aes);

        return $texto_desencriptado;
    }

    /**
     * Encripta una URL.
     *
     * @param string $url URL a encriptar.
     * @param string $clave Clave de encriptación.
     * @return string URL encriptada.
     */
    public function Encriptar_URL($url, $clave)
    {
        $iv = random_bytes(16); // Generar un vector de inicialización aleatorio

        // Encriptar la URL utilizando AES-256-CBC
        $texto_encriptado = openssl_encrypt($url, 'aes-256-cbc', $clave, OPENSSL_RAW_DATA, $iv);

        // Combina el vector de inicialización y el texto encriptado en una sola cadena
        $url_encriptada = base64_encode($iv . $texto_encriptado);

        return $url_encriptada;
    }

    /**
     * Desencripta una URL encriptada.
     *
     * @param string $url_encriptada URL encriptada.
     * @param string $clave Clave de encriptación.
     * @return string URL desencriptada.
     */
    public function Desencriptar_URL($url_encriptada, $clave)
    {
        $url_encriptada = base64_decode($url_encriptada);

        // Separar el vector de inicialización y el texto encriptado
        $iv               = substr($url_encriptada, 0, 16);
        $texto_encriptado = substr($url_encriptada, 16);

        // Desencriptar el texto utilizando AES-256-CBC
        $url_desencriptada = openssl_decrypt($texto_encriptado, 'aes-256-cbc', $clave, OPENSSL_RAW_DATA, $iv);

        return $url_desencriptada;
    }

    public static function Seguridad($string, $accion = null)
    {
        // Advanced Encryption Standard cipher-block chaining
        $metodo = "AES-256-CBC"; //El método de cifrado //clave simétrica de 256 bits
        $llave  = openssl_digest("key", 'whirlpool', true); //genera un hash usando el método dado y devuelve codificada (512 bits)
        $iv     = substr(hash("whirlpool", $llave), 0, 16); // ciframos el vector de inicialización y acortamos con substr a 16

        if ($accion == 'codificar') {
            $salida = openssl_encrypt($string, $metodo, $llave, 0, $iv); // ciframos la direccion obtenida con el metodo openssl_encrypt
            $salida = base64_encode($salida); // ciframos la salida en bs64
        } else if ($accion == 'decodificar') {
            $string = base64_decode($string);
            $salida = openssl_decrypt($string, $metodo, $llave, 0, $iv);
        }
        return $salida;
        unset($metodo, $llave, $iv, $accion, $sting, $salida);
    }
}
