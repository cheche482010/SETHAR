<?php

namespace Componentes\Funciones;

trait Validacion
{
    // patrones de búsqueda
    private $cedula      = "/^([0-9]{7,9})$/";
    private $caracteres  = "/^[a-zA-Z0-9Ññáéíóú \b]{1,100}$/";
    private $rif         = "/^([vejpgVEJPG]{1})([0-9]{9})$/";
    private $enteros     = "/^([0-9]{1,2})$/";
    private $dinero      = "/^^\d{1,3}(?:\.\d\d\d)*(?:,\d{1,2})?$/";
    private $BASE64      = "/^[a-zA-Z0-9\/\r\n+]*={0,2}$/";
    private $numero_casa = "/[a-zA-Z0-9]+\.?(( |\-)[a-zA-Z0-9]+\.?)*/";
    private $password    = "/(?=^.{4,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
    private $telefono    = "/0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?/";

    private $fechas = "/^(19|20)(((([02468][048])|([13579][26]))-02-29)|(\d{2})-((02-((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))-((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))-31)))$/";

    private $correo = "/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/";

    private $url              = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
    private $codigo_postal    = "/^[0-9]{5}$/"; // Código postal de 5 dígitos
    private $numero_tarjeta   = "/^[0-9]{16}$/"; // Número de tarjeta de crédito de 16 dígitos
    private $codigo_seguridad = "/^[0-9]{3}$/"; // Código de seguridad de tarjeta de crédito de 3 dígitos
    private $fecha_expiracion = "/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/"; // Fecha de expiración de tarjeta de crédito en formato MM/YY o MM/YYYY
    private $ipv4             = "/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/"; // Dirección IP en formato IPv4
    private $ipv6             = "/^((?=.*::)(?!.*::.+::)(::)?([\da-fA-F]{1,4}(:|(?!\s*\2:)\2)){7}|([\da-fA-F]{1,4}:){6})([\da-fA-F]{1,4})(\2([\da-fA-F]{1,4})(\3([\da-fA-F]{1,4})(\4([\da-fA-F]{1,4})(\5([\da-fA-F]{1,4})(\6([\da-fA-F]{1,4})\7?)?)?)?)?)?$/"; // Dirección IP en formato IPv6
    private $hexadecimal      = "/^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/"; // Color hexadecimal en formato #RRGGBB o #RGB

    /**
     * Valida un valor con el patrón correspondiente.
     *
     * @param string $patron El nombre del patrón a utilizar.
     * @param mixed $valor El valor a validar.
     * @return bool Devuelve true si el valor cumple con el patrón, false en caso contrario.
     */
    public function validar($patron, $valor)
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

}
