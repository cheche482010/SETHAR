<?php

namespace Componentes\Funciones;

class Ejemplo_Trait_Validacion
{
    use Validacion;

    public function __construct()
    {
        // Aquí va la lógica de inicialización de la clase
    }

    public function ejemploValidarCedula()
    {
        $cedula = "12345678";

        if ($this->validar("cedula", $cedula)) {
            echo "La cédula es válida";
        } else {
            echo "La cédula no es válida";
        }
    }

    public function ejemploValidarCaracteres()
    {
        $texto = "Texto de ejemplo 123";

        if ($this->validar("caracteres", $texto)) {
            echo "El texto es válido";
        } else {
            echo "El texto no es válido";
        }
    }

    public function ejemploValidarRIF()
    {
        $rif = "V123456789";

        if ($this->validar("rif", $rif)) {
            echo "El RIF es válido";
        } else {
            echo "El RIF no es válido";
        }
    }

    public function ejemploValidarEnteros()
    {
        $entero = "123";

        if ($this->validar("enteros", $entero)) {
            echo "El número entero es válido";
        } else {
            echo "El número entero no es válido";
        }
    }

    public function ejemploValidarDinero()
    {
        $monto = "1000.50";

        if ($this->validar("dinero", $monto)) {
            echo "El monto de dinero es válido";
        } else {
            echo "El monto de dinero no es válido";
        }
    }

    public function ejemploValidarBase64()
    {
        $cadenaBase64 = "SGVsbG8gd29ybGQh";

        if ($this->validar("BASE64", $cadenaBase64)) {
            echo "La cadena Base64 es válida";
        } else {
            echo "La cadena Base64 no es válida";
        }
    }

    public function ejemploValidarNumeroCasa()
    {
        $numeroCasa = "123A";

        if ($this->validar("numero_casa", $numeroCasa)) {
            echo "El número de casa es válido";
        } else {
            echo "El número de casa no es válido";
        }
    }

    public function ejemploValidarPassword()
    {
        $password = "Abcd1234";

        if ($this->validar("password", $password)) {
            echo "La contraseña es válida";
        } else {
            echo "La contraseña no es válida";
        }
    }

    public function ejemploValidarTelefono()
    {
        $telefono = "04121234567";

        if ($this->validar("telefono", $telefono)) {
            echo "El número de teléfono es válido";
        } else {
            echo "El número de teléfono no es válido";
        }
    }

    public function ejemploValidarFechas()
    {
        $fecha = "2023-05-31";

        if ($this->validar("fechas", $fecha)) {
            echo "La fecha es válida";
        } else {
            echo "La fecha no es válida";
        }
    }

    public function ejemploValidarCorreo()
    {
        $correo = "correo@example.com";

        if ($this->validar("correo", $correo)) {
            echo "El correo es válido";
        } else {
            echo "El correo no es válido";
        }
    }

    public function ejemploValidarURL()
    {
        $url = "https://www.example.com";

        if ($this->validar("url", $url)) {
            echo "La URL es válida";
        } else {
            echo "La URL no es válida";
        }
    }

    public function ejemploValidarCodigoPostal()
    {
        $codigoPostal = "12345";

        if ($this->validar("codigo_postal", $codigoPostal)) {
            echo "El código postal es válido";
        } else {
            echo "El código postal no es válido";
        }
    }

    public function ejemploValidarNumeroTarjeta()
    {
        $numeroTarjeta = "1234567890123456";

        if ($this->validar("numero_tarjeta", $numeroTarjeta)) {
            echo "El número de tarjeta es válido";
        } else {
            echo "El número de tarjeta no es válido";
        }
    }

    public function ejemploValidarCodigoSeguridad()
    {
        $codigoSeguridad = "123";

        if ($this->validar("codigo_seguridad", $codigoSeguridad)) {
            echo "El código de seguridad es válido";
        } else {
            echo "El código de seguridad no es válido";
        }
    }

    public function ejemploValidarFechaExpiracion()
    {
        $fechaExpiracion = "05/23";

        if ($this->validar("fecha_expiracion", $fechaExpiracion)) {
            echo "La fecha de expiración es válida";
        } else {
            echo "La fecha de expiración no es válida";
        }
    }

    public function ejemploValidarIPv4()
    {
        $ipv4 = "192.168.0.1";

        if ($this->validar("ipv4", $ipv4)) {
            echo "La dirección IPv4 es válida";
        } else {
            echo "La dirección IPv4 no es válida";
        }
    }

    public function ejemploValidarIPv6()
    {
        $ipv6 = "2001:0db8:85a3:0000:0000:8a2e:0370:7334";

        if ($this->validar("ipv6", $ipv6)) {
            echo "La dirección IPv6 es válida";
        } else {
            echo "La dirección IPv6 no es válida";
        }
    }

    public function ejemploValidarHexadecimal()
    {
        $colorHex = "#FF0000";

        if ($this->validar("hexadecimal", $colorHex)) {
            echo "El color hexadecimal es válido";
        } else {
            echo "El color hexadecimal no es válido";
        }
    }
}

