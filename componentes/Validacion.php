<?php

class Validacion
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

    public function __construct()
    {}
    // ===============================================================================
    public function Validar($patron, $valor)
    {
        return (bool) (!preg_match_all($this->{$patron}, $valor)) ? true : false;
    }

    public function Comprobar($value)
    {
        return (bool) (empty($value) && isset($value)) ? true : false;
    }
    
    public function Datos_Limpios($data)
    {
        return htmlspecialchars(strip_tags(stripslashes(trim($data))));
    }

}
