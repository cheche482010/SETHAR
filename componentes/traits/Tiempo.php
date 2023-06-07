<?php

namespace Componentes\Funciones;

trait Tiempo
{
    /**
     * Formatea una fecha en el formato deseado.
     *
     * @param string $fecha La fecha a formatear.
     * @param string $formato El formato de salida deseado (por ejemplo, 'Y-m-d' para '2022-01-01').
     *
     * @return string La fecha formateada.
     */
    public function Formatear_Fecha($fecha, $formato)
    {
        return date($formato, strtotime($fecha));
    }

    /**
     * Calcula la diferencia de tiempo entre dos fechas.
     *
     * @param string $fechaInicio La fecha inicial.
     * @param string $fechaFin La fecha final.
     * @param string $unidad La unidad de tiempo deseada para la diferencia ('d' para días, 'h' para horas, 'm' para minutos, 's' para segundos).
     *
     * @return int La diferencia de tiempo en la unidad especificada.
     */
    public function Calcular_Diferencia_Tiempo($fechaInicio, $fechaFin, $unidad)
    {
        $fechaInicio = strtotime($fechaInicio);
        $fechaFin    = strtotime($fechaFin);
        $diferencia  = $fechaFin - $fechaInicio;

        switch ($unidad) {
            case 'd':
                return round($diferencia / (60 * 60 * 24));
            case 'h':
                return round($diferencia / (60 * 60));
            case 'm':
                return round($diferencia / 60);
            case 's':
                return $diferencia;
            default:
                return 0;
        }
    }

    /**
     * Convierte una fecha de un formato a otro.
     *
     * @param string $fecha La fecha a convertir.
     * @param string $formatoActual El formato actual de la fecha.
     * @param string $formatoNuevo El formato deseado para la fecha.
     *
     * @return string La fecha convertida al nuevo formato.
     */
    public function Convertir_Formato_Fecha($fecha, $formatoActual, $formatoNuevo)
    {
        $fechaObjeto = DateTime::createFromFormat($formatoActual, $fecha);
        if ($fechaObjeto === false) {
            return '';
        }
        return $fechaObjeto->format($formatoNuevo);
    }

    /**
     * Obtener el primer día del mes de una fecha dada.
     *
     * @param string $fecha La fecha de referencia.
     * @param string $formato El formato de salida deseado.
     *
     * @return string El primer día del mes en el formato especificado.
     */
    public function Primer_Dia_Mes($fecha, $formato = 'Y-m-d')
    {
        return date($formato, strtotime('Primer dia de ' . $fecha));
    }

    /**
     * Obtener el último día del mes de una fecha dada.
     *
     * @param string $fecha La fecha de referencia.
     * @param string $formato El formato de salida deseado.
     *
     * @return string El último día del mes en el formato especificado.
     */
    public function Ultimo_Dia_Mes($fecha, $formato = 'Y-m-d')
    {
        return date($formato, strtotime('Ultimo dia de ' . $fecha));
    }

    /**
     * Verificar si una fecha está en un rango determinado.
     *
     * @param string $fecha La fecha a verificar.
     * @param string $rangoInicio La fecha de inicio del rango.
     * @param string $rangoFin La fecha de fin del rango.
     *
     * @return bool True si la fecha está dentro del rango, false en caso contrario.
     */
    public function Fecha_En_Rango($fecha, $rangoInicio, $rangoFin)
    {
        $fechaTimestamp       = strtotime($fecha);
        $rangoInicioTimestamp = strtotime($rangoInicio);
        $rangoFinTimestamp    = strtotime($rangoFin);

        return ($fechaTimestamp >= $rangoInicioTimestamp && $fechaTimestamp <= $rangoFinTimestamp);
    }

    /**
     * Obtener la edad a partir de una fecha de nacimiento.
     *
     * @param string $fechaNacimiento La fecha de nacimiento en formato Y-m-d.
     *
     * @return int La edad calculada.
     */
    public function Calcular_Edad($fechaNacimiento)
    {
        $fechaActual = date('Y-m-d');
        $edad        = date_diff(date_create($fechaNacimiento), date_create($fechaActual));
        return $edad->y;
    }

    /**
     * Obtener el nombre del mes a partir de su número.
     *
     * @param int $numeroMes El número del mes (1-12).
     * @param string $idioma El idioma del nombre del mes (por defecto: 'es' para español).
     *
     * @return string El nombre del mes correspondiente.
     */
    public function Obtener_Nombre_Mes($numeroMes, $idioma = 'es')
    {
        $meses = [
            'es' => ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], // Español
            'en' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], // Inglés
            'fr' => ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], // Francés
            'de' => ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'], // Alemán
        ];

        return $meses[$idioma][$numeroMes - 1] ?? '';
    }

    /**
     * Verificar si una fecha es válida.
     *
     * @param string $fecha La fecha a verificar.
     * @param string $formato El formato de la fecha (por defecto: 'Y-m-d').
     *
     * @return bool True si la fecha es válida, false en caso contrario.
     */
    public function Fecha_Valida($fecha, $formato = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($formato, $fecha);
        return $d && $d->format($formato) === $fecha;
    }

    /**
     * Obtener la fecha actual en un formato específico.
     *
     * @param string $formato El formato deseado para la fecha (por defecto: 'Y-m-d H:i:s').
     *
     * @return string La fecha actual en el formato especificado.
     */
    public function Obtener_Fecha_Actual($formato = 'Y-m-d H:i:s')
    {
        return date($formato);
    }

    /**
     * Sumar o restar días a una fecha dada.
     *
     * @param string $fecha La fecha de referencia.
     * @param int $dias El número de días a sumar o restar (puede ser negativo).
     * @param string $formato El formato deseado para la fecha resultante (por defecto: 'Y-m-d').
     *
     * @return string La fecha resultante después de sumar o restar los días.
     */
    public function Calcular_Dias($fecha, $dias, $formato = 'Y-m-d')
    {
        $nuevaFecha = strtotime("$fecha $dias days");
        return date($formato, $nuevaFecha);
    }

    /**
     * Calcular la diferencia de días entre dos fechas.
     *
     * @param string $fechaInicio La fecha de inicio.
     * @param string $fechaFin La fecha de fin.
     *
     * @return int El número de días de diferencia entre las dos fechas.
     */
    public function Diferencia_Dias($fechaInicio, $fechaFin)
    {
        $diferencia = strtotime($fechaFin) - strtotime($fechaInicio);
        return floor($diferencia / (60 * 60 * 24));
    }

    /**
     * Obtener el nombre del día de la semana a partir de una fecha.
     *
     * @param string $fecha La fecha de referencia.
     * @param string $idioma El idioma del nombre del día (por defecto: 'es' para español).
     *
     * @return string El nombre del día de la semana correspondiente.
     */
    public function Obtener_Nombre_Dia_Semana($fecha, $idioma = 'es')
    {
        // Nombres de días de la semana en diferentes idiomas
        $diasSemana = [
            'es' => ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'], // Español
            'en' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], // Inglés
            'fr' => ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'], // Francés
            'de' => ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'], // Alemán
        ];

        $numeroDia = date('N', strtotime($fecha));
        return $diasSemana[$idioma][$numeroDia - 1] ?? '';
    }

    /**
     * Cambiar la zona horaria.
     *
     * @param string $zonaHoraria La nueva zona horaria a configurar. Por defecto: "America/Caracas".
     *
     * @return void
     */
    public function Cambiar_Zona_Horaria($zonaHoraria = 'America/Caracas')
    {
        date_default_timezone_set($zonaHoraria);
    }

}
