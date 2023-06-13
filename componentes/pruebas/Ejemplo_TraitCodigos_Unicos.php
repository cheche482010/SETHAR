<?php

use Componentes\Funciones\Codigos_Unicos;

class Ejemplo_TraitCodigos_Unicos
{
    use Codigos_Unicos;

    /**
     * Ejemplo de generación de un código único.
     */
    public function ejemploGenerarCodigoUnico()
    {
        $prefix = 'CODE';
        $length = 8;
        $codigo = $this->Generar_Codigo_Unico($prefix, $length);

        echo "Código único generado: $codigo";
    }

    /**
     * Ejemplo de generación de un identificador de usuario único.
     */
    public function ejemploGenerarIdUsuarioUnico()
    {
        $idUsuario = $this->Generar_Id_Usuario_Unico();

        echo "Identificador de usuario único generado: $idUsuario";
    }

    /**
     * Ejemplo de generación de un código de verificación único.
     */
    public function ejemploGenerarCodigoVerificacionUnico()
    {
        $codigoVerificacion = $this->Generar_Codigo_Verificacion_Unico();

        echo "Código de verificación único generado: $codigoVerificacion";
    }

    /**
     * Ejemplo de generación de un código de descuento único.
     */
    public function ejemploGenerarCodigoDescuentoUnico()
    {
        $codigoDescuento = $this->Generar_Codigo_Descuento_Unico();

        echo "Código de descuento único generado: $codigoDescuento";
    }

    /**
     * Ejemplo de generación de un código alfanumérico aleatorio.
     */
    public function ejemploGenerarCodigoAleatorio()
    {
        $longitud = 10;
        $codigoAleatorio = $this->Generar_Codigo_Aleatorio($longitud);

        echo "Código alfanumérico aleatorio generado: $codigoAleatorio";
    }

    /**
     * Ejemplo de generación de un código seguro utilizando técnicas de criptografía.
     */
    public function ejemploGenerarCodigoSeguro()
    {
        $dato = 'informacion_secreta';
        $codigoSeguro = $this->Generar_Codigo_Seguro($dato);

        echo "Código seguro generado: $codigoSeguro";
    }

    /**
     * Ejemplo de generación de un código temporal con fecha de expiración.
     */
    public function ejemploGenerarCodigoTemporizado()
    {
        $expiracion = 3600; // 1 hora de expiración
        $codigoTemporizado = $this->Generar_Codigo_Temporizado($expiracion);

        echo "Código temporal generado: $codigoTemporizado";
    }

    /**
     * Ejemplo de generación de un código alfanumérico único.
     */
    public function ejemploGenerarCodigoAlfa()
    {
        $longitud = 12;
        $codigoAlfa = $this->Generar_Codigo_Alfa($longitud);

        echo "Código alfanumérico único generado: $codigoAlfa";
    }

    /**
     * Ejemplo de generación de un código UUID único.
     */
    public function ejemploGenerarCodigoUUID()
    {
        $codigoUUID = $this->Generar_Codigo_UUID();

        echo "Código UUID generado: $codigoUUID";
    }

    /**
     * Ejemplo de generación de un código hash utilizando un algoritmo específico.
     */
    public function ejemploGenerarCodigoHash()
    {
        $dato = 'informacion_secreta';
        $algoritmo = 'sha256';
        $codigoHash = $this->Generar_Codigo_Hash($dato, $algoritmo);

        echo "Código hash generado: $codigoHash";
    }
}
