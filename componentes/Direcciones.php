<?php
class Direcciones
{
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

    public static function URL()
    {
        $protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $domain   = $_SERVER['HTTP_HOST'];
        $root     = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) . "/";
        $url      = $protocol . $domain . $root;
        unset($protocol, $domain, $root);
        return $url;
    }

    public static function _000_($value)
    {
        return self::Seguridad($value, 'codificar');
    }

}
if (isset($_POST['direction']) && isset($_POST['accion'])) {
    echo Direcciones::Seguridad($_POST['direction'], $_POST['accion']);
}
