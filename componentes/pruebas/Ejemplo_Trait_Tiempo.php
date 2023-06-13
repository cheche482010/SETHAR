<?php

class Ejemplo_Trait_Tiempo
{
    use Tiempo;

    public function __construct()
    {
        // Aquí va la lógica de inicialización de la clase
    }

    public function ejemploFormatearFecha()
    {
        $fecha = "2023-05-31";
        $formato = "d/m/Y";

        $fechaFormateada = $this->Formatear_Fecha($fecha, $formato);
        echo "Fecha formateada: " . $fechaFormateada;
    }

    public function ejemploCalcularDiferenciaTiempo()
    {
        $fechaInicio = "2023-05-01 08:00:00";
        $fechaFin = "2023-05-31 18:30:00";
        $unidad = "h";

        $diferenciaTiempo = $this->Calcular_Diferencia_Tiempo($fechaInicio, $fechaFin, $unidad);
        echo "Diferencia de tiempo: " . $diferenciaTiempo . " horas";
    }

    public function ejemploConvertirFormatoFecha()
    {
        $fecha = "2023-05-31";
        $formatoActual = "Y-m-d";
        $formatoNuevo = "d/m/Y";

        $fechaConvertida = $this->Convertir_Formato_Fecha($fecha, $formatoActual, $formatoNuevo);
        echo "Fecha convertida: " . $fechaConvertida;
    }

    public function ejemploPrimerDiaMes()
    {
        $fecha = "2023-05-31";
        $formato = "Y-m-d";

        $primerDiaMes = $this->Primer_Dia_Mes($fecha, $formato);
        echo "Primer día del mes: " . $primerDiaMes;
    }

    public function ejemploUltimoDiaMes()
    {
        $fecha = "2023-05-31";
        $formato = "Y-m-d";

        $ultimoDiaMes = $this->Ultimo_Dia_Mes($fecha, $formato);
        echo "Último día del mes: " . $ultimoDiaMes;
    }

    public function ejemploFechaEnRango()
    {
        $fecha = "2023-05-31";
        $rangoInicio = "2023-05-01";
        $rangoFin = "2023-05-31";

        $fechaEnRango = $this->Fecha_En_Rango($fecha, $rangoInicio, $rangoFin);
        echo $fechaEnRango ? "La fecha está dentro del rango" : "La fecha no está dentro del rango";
    }

    public function ejemploCalcularEdad()
    {
        $fechaNacimiento = "1990-05-31";

        $edad = $this->Calcular_Edad($fechaNacimiento);
        echo "Edad: " . $edad . " años";
    }

    public function ejemploObtenerNombreMes()
    {
        $numeroMes = 5;
        $idioma = "es";

        $nombreMes = $this->Obtener_Nombre_Mes($numeroMes, $idioma);
        echo "Nombre del mes: " . $nombreMes;
    }

    public function ejemploFechaValida()
    {
        $fecha = "2023-05-31";

        $esValida = $this->Fecha_Valida($fecha);
        echo $esValida ? "La fecha es válida" : "La fecha no es válida";
    }

    public function ejemploObtenerFechaActual()
    {
        $formato = "Y-m-d H:i:s";

        $fechaActual = $this->Obtener_Fecha_Actual($formato);
        echo "Fecha actual: " . $fechaActual;
    }

    public function ejemploCalcularDias()
    {
        $fecha = "2023-05-31";
        $dias = 7;
        $formato = "Y-m-d";

        $nuevaFecha = $this->Calcular_Dias($fecha, $dias, $formato);
        echo "Nueva fecha: " . $nuevaFecha;
    }

    public function ejemploDiferenciaDias()
    {
        $fechaInicio = "2023-05-01";
        $fechaFin = "2023-05-31";

        $diferenciaDias = $this->Diferencia_Dias($fechaInicio, $fechaFin);
        echo "Diferencia de días: " . $diferenciaDias;
    }

    public function ejemploObtenerNombreDiaSemana()
    {
        $fecha = "2023-05-31";
        $idioma = "es";

        $nombreDiaSemana = $this->Obtener_Nombre_Dia_Semana($fecha, $idioma);
        echo "Nombre del día de la semana: " . $nombreDiaSemana;
    }

    public function ejemploCambiarZonaHoraria()
    {
        $zonaHoraria = "America/New_York";

        $this->Cambiar_Zona_Horaria($zonaHoraria);

        $fechaActual = $this->Obtener_Fecha_Actual();
        echo "Fecha actual en la nueva zona horaria: " . $fechaActual;
    }
}

