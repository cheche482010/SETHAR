<?php

namespace Componentes\Funciones;

trait Validacion
{

    /**
     * Expresión regular para validar una cédula.
     * Formato: de 7 a 9 dígitos numéricos.
     * @var string
     */
    private $cedula = "/^([0-9]{7,9})$/";

    /**
     * Expresión regular para validar caracteres.
     * Formato: letras mayúsculas, letras minúsculas, dígitos, espacios, caracteres especiales y acento  s, entre 1 y 100 caractere  s.
     * @var string
     */
    private $caracteres = "/^[a-zA-Z0-9Ññáéíóú \b]{1,100}$/";

    /**
     * Expresión regular para validar un RIF.
     * Formato: letra 'V', 'E', 'J', 'P', 'G' (mayúscula o minúscula) seguida de 9 dígitos numéricos.
     * @var string
     */
    private $rif = "/^([vejpgVEJPG]{1})([0-9]{9})$/";

    /**
     * Expresión regular para validar enteros.
     * Formato: de 1 a 2 dígitos numéricos.
     * @var string
     */
    private $enteros = "/^([0-9]{1,2})$/";

    /**
     * Expresión regular para validar números decimales.
     * Formato: número decimal con o sin signo, con coma o punto como separador decimal.
     * @var string
     */
    private $decimal = '/^[-+]?\d+([.,]\d+)?$/';

    /**
     * Expresión regular para validar cantidades de dinero.
     * Formato: número decimal separado por comas cada tres dígitos, con o sin parte decimal.
     * @var string
     */
    private $dinero = "/^^\d{1,3}(?:\.\d\d\d)*(?:,\d{1,2})?$/";

    /**
     * Expresión regular para validar cadenas codificadas en Base64.
     * Formato: cadena que representa datos en formato Base64.
     * @var string
     */
    private $BASE64 = "/^[a-zA-Z0-9\/\r\n+]*={0,2}$/";

    /**
     * Expresión regular para validar un número de casa.
     * Formato: cadena que puede contener letras, dígitos y caracteres especiales, separados por puntos   o guione   s.
     * @var string
     */
    private $numero_casa = "/[a-zA-Z0-9]+\.?(( |\-)[a-zA-Z0-9]+\.?)*/";

    /**
     * Expresión regular para validar una contraseña segura.
     * Formato: contraseña que cumple con ciertos requisitos de longitud y contenido.
     * @var string
     */
    private $password = "/(?=^.{4,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";

    /**
     * Expresión regular para validar un número de teléfono.
     * Formato: número de teléfono en diferentes formatos, con extensiones opcionales.
     * @var string
     */
    private $telefono = "/0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?/";

    /**
     * Expresión regular para validar una fecha.
     * Formato: fecha en formato 'YYYY-MM-DD' o 'YY-MM-DD'.
     * @var string
     */
    private $fecha = '/^(\d{4}|\d{2})-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/';

    /**
     * Expresión regular para validar una hora.
     * Formato: hora en formato de 12 horas con minutos y segundos opcionales, y am/pm.
     * @var string
     */
    private $hora = '/^(0?[1-9]|1[0-2])(:[0-5][0-9])?(:[0-5][0-9])?\s?(am|pm|AM|PM)?$/';

    /**
     * Expresión regular para validar una dirección de correo electrónico.
     * Formato: dirección de correo electrónico válida.
     * @var string
     */
    private $correo = "/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/";

    /**
     * Expresión regular para validar una URL.
     * Formato: URL válida con o sin protocolo (http://, https://).
     * @var string
     */
    private $url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

    /**
     * Expresión regular para validar un código postal de 5 dígitos.
     * Formato: número de 5 dígitos.
     * @var string
     */
    private $codigo_postal = "/^[0-9]{5}$/";

    /**
     * Expresión regular para validar un número de tarjeta de crédito de 16 dígitos.
     * Formato: número de tarjeta de crédito de 16 dígitos.
     * @var string
     */
    private $numero_tarjeta = "/^[0-9]{16}$/";

    /**
     * Expresión regular para validar un código de seguridad de tarjeta de crédito de 3 dígitos.
     * Formato: código de seguridad de tarjeta de crédito de 3 dígitos.
     * @var string
     */
    private $codigo_seguridad = "/^[0-9]{3}$/";

    /**
     * Expresión regular para validar una fecha de expiración de tarjeta de crédito en formato MM/YY o MM/YYYY.
     * Formato: fecha de expiración de tarjeta de crédito en formato MM/YY o MM/YYYY.
     * @var string
     */
    private $fecha_expiracion = "/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/";

    /**
     * Expresión regular para validar una dirección IP en formato IPv4.
     * Formato: dirección IP en formato IPv4.
     * @var string
     */
    private $ipv4 = "/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/";

    /**
     * Expresión regular para validar una dirección IP en formato IPv6.
     * Formato: dirección IP en formato IPv6.
     * @var string
     */
    private $ipv6 = "/^((?=.*::)(?!.*::.+::)(::)?([\da-fA-F]{1,4}(:|(?!\s*\2:)\2)){7}|([\da-fA-F]{1,4}:){6})([\da-fA-F]{1,4})(\2([\da-fA-F]{1,4})(\3([\da-fA-F]{1,4})(\4([\da-fA-F]{1,4})(\5([\da-fA-F]{1,4})(\6([\da-fA-F]{1,4})\7?)?)?)?)?)?$/";

    /**
     * Expresión regular para validar un color hexadecimal en formato #RRGGBB o #RGB.
     * Formato: color hexadecimal en formato #RRGGBB o #RGB.
     * @var string
     */
    private $hexadecimal = "/^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/";

    /**
     * Expresión regular para validar una imagen con extensión jpg, jpeg, png o gif.
     * Formato: nombre de archivo con extensión jpg, jpeg, png o gif.
     * @var string
     */
    private $imagen = '/\.(jpg|jpeg|png|gif)$/i';

    /**
     * Expresión regular para validar un archivo de audio con extensión mp3, wav u ogg.
     * Formato: nombre de archivo con extensión mp3, wav u ogg.
     * @var string
     */
    private $audio = '/\.(mp3|wav|ogg)$/i';

    /**
     * Expresión regular para validar un documento con extensión doc, docx, pdf o txt.
     * Formato: nombre de archivo con extensión doc, docx, pdf o txt.
     * @var string
     */
    private $documento = '/\.(doc|docx|pdf|txt)$/i';

    /**
     * Valida un valor con el patrón correspondiente.
     *
     * @param string $patron El nombre del patrón a utilizar.
     * @param mixed $valor El valor a validar.
     * @return bool Devuelve true si el valor cumple con el patrón, false en caso contrario.
     */
    public function Validar($patron, $valor)
    {
        return !preg_match($this->$patron, $valor);
    }

    /**
     * Comprueba si un valor está vacío o no está definido.
     *
     * @param mixed $valor El valor a comprobar.
     * @return bool Devuelve true si el valor está vacío o no está definido, false en caso contrario.
     */
    public function Comprobar($valor)
    {
        return empty($valor) && isset($valor);
    }

    /**
     * Limpia los datos eliminando caracteres especiales y etiquetas HTML.
     *
     * @param mixed $data Los datos a limpiar.
     * @return string Los datos limpios.
     */
    public function Datos_Limpios($data)
    {
        return htmlspecialchars(strip_tags(stripslashes(trim($data))));
    }

    /**
     * Verifica la longitud de un valor.
     *
     * @param string $valor El valor a verificar.
     * @param int $minimo La longitud mínima permitida.
     * @param int $maximo La longitud máxima permitida.
     * @return bool Devuelve true si el valor cumple con la longitud permitida, false en caso contrario.
     */
    public function Longitud($valor, $minimo, $maximo)
    {
        $longitud = strlen($valor);
        return $longitud >= $minimo && $longitud <= $maximo;
    }

    /**
     * Valida el tipo de atributo.
     *
     * @param mixed $valor El valor a validar.
     * @param string $tipo El tipo de atributo permitido ('string', 'integer', 'float', 'boolean', 'array', 'object', 'null', 'numeric').
     * @return bool Devuelve true si el valor tiene el tipo de atributo correcto, false en caso contrario.
     */
    public function Tipo($valor, $tipo)
    {
        switch ($tipo) {
            case 'string':
                return is_string($valor);
            case 'integer':
                return is_int($valor);
            case 'float':
                return is_float($valor);
            case 'boolean':
                return is_bool($valor);
            case 'array':
                return is_array($valor);
            case 'object':
                return is_object($valor);
            case 'null':
                return is_null($valor);
            case 'numeric':
                return is_numeric($valor);
            case 'file':
                return is_file($valor);
            default:
                return false;
        }
    }

}
