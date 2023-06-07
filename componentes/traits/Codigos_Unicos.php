<?php

namespace Componentes\Funciones;

trait Codigos_Unicos
{
    /**
     * Genera un código único basado en un prefijo y una longitud.
     *
     * @param string $prefix Prefijo del código (opcional)
     * @param int $length Longitud del código (sin contar el prefijo)
     * @return string El código único generado
     */
    public function Generar_Codigo_Unico($prefix = '', $length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $code       = $prefix;

        while (strlen($code) < $length) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $code;
    }

    /**
     * Genera un identificador de usuario único.
     *
     * @return string El identificador de usuario único generado
     */
    public function Generar_Id_Usuario_Unico()
    {
        $prefix = 'USR';
        $length = 10;

        return $this->Generar_Codigo_Unico($prefix, $length);
    }

    /**
     * Genera un código de verificación único.
     *
     * @return string El código de verificación único generado
     */
    public function Generar_Codigo_Verificacion_Unico()
    {
        $prefix = 'CODE';
        $length = 6;

        return $this->Generar_Codigo_Unico($prefix, $length);
    }

    /**
     * Genera un código de descuento único.
     *
     * @return string El código de descuento único generado
     */
    public function Generar_Codigo_Descuento_Unico()
    {
        $prefix = 'DISCOUNT';
        $length = 8;

        return $this->Generar_Codigo_Unico($prefix, $length);
    }

    /**
     * Genera un código alfanumérico aleatorio con una longitud específica.
     *
     * @param int $longitud Longitud del código generado.
     * @return string El código alfanumérico generado.
     */
    public function Generar_Codigo_Aleatorio($longitud)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo     = '';
        $max        = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[random_int(0, $max)];
        }

        return $codigo;
    }

    /**
     * Genera un código seguro utilizando técnicas de criptografía.
     *
     * @param string $dato Datos para generar el código seguro.
     * @return string El código seguro generado.
     */
    public function Generar_Codigo_Seguro($dato)
    {
        return hash('sha256', $dato);
    }

    /**
     * Genera un código único que tiene una caducidad o fecha de expiración.
     *
     * @param int $expiracion Tiempo de expiración en segundos.
     * @return string El código temporal generado.
     */
    public function Generar_Codigo_Temporizado($expiracion)
    {
        $codigo = $this->Generar_Codigo_Aleatorio(8);
        $codigo .= time() + $expiracion;
        return $codigo;
    }

    /**
     * Genera un código alfanumérico único basado en una combinación de letras y números.
     *
     * @param int $longitud Longitud del código generado.
     * @return string El código alfanumérico generado.
     */
    public function Generar_Codigo_Alfa($longitud)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo     = '';
        $max        = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[random_int(0, $max)];
        }

        return $codigo;
    }

    /**
     * Genera un código único utilizando el formato UUID (Universally Unique Identifier).
     *
     * @return string El código UUID generado.
     */
    public function Generar_Codigo_UUID()
    {
        return uuid_create();
    }

    /**
     * Genera un código único utilizando un algoritmo de hash.
     *
     * @param string $dato Datos para generar el código hash.
     * @param string $algoritmo Algoritmo de hash a utilizar (e.g., "md5", "sha1", "sha256").
     * @return string El código hash generado.
     */
    public function Generar_Codigo_Hash($dato, $algoritmo)
    {
        return hash($algoritmo, $dato);
    }
}
