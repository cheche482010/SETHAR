<?php
trait Html
{
    /**
     * Genera un elemento <div>.
     *
     * @param string $content Contenido del elemento.
     * @param array $attributes Atributos del elemento.
     * @return string
     */
    public function Div($content, $attributes = [])
    {
        $html = '<div';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>' . $content . '</div>';

        return $html;
    }

    /**
     * Genera un enlace <a>.
     *
     * @param string $text Texto del enlace.
     * @param string $url URL del enlace.
     * @param array $attributes Atributos del enlace.
     * @return string
     */
    public function Link($text, $url, $attributes = [])
    {
        $html = '<a href="' . $url . '"';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>' . $text . '</a>';

        return $html;
    }

    /**
     * Genera un párrafo <p>.
     *
     * @param string $content Contenido del párrafo.
     * @param array $attributes Atributos del párrafo.
     * @return string
     */

    public function Parrafo($content, $attributes = [])
    {
        $html = '<p';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>' . $content . '</p>';

        return $html;
    }

    /**
     * Genera una imagen <img>.
     *
     * @param string $src Ruta de la imagen.
     * @param string $alt Texto alternativo de la imagen.
     * @param array $attributes Atributos de la imagen.
     * @return string
     */
    public function Imagen($src, $alt = '', $attributes = [])
    {
        $html = '<img src="' . $src . '" alt="' . $alt . '"';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>';

        return $html;
    }

    /**
     * Genera una lista <ul> con elementos <li>.
     *
     * @param array $items Elementos de la lista.
     * @param array $attributes Atributos de la lista.
     * @return string
     */

    public function Lista($items, $attributes = [])
    {
        $html = '<ul';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>';

        foreach ($items as $item) {
            $html .= '<li>' . $item . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * Genera una tabla <table> con filas <tr> y celdas <td>.
     *
     * @param array $data Datos de la tabla.
     * @param array $attributes Atributos de la tabla.
     * @return string
     */

    public function Tabla($data, $attributes = [])
    {
        $html = '<table';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>';

        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . $cell . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
    }

    /**
     * Genera un título <h1> - <h6>.
     *
     * @param string $text Texto del título.
     * @param int $level Nivel del título (1 - 6).
     * @param array $attributes Atributos del título.
     * @return string
     */

    public function Titulo($text, $level = 1, $attributes = [])
    {
        $html = '<h' . $level;
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>' . $text . '</h' . $level . '>';

        return $html;
    }

    /**
     * Genera un enlace <a> con una imagen <img>.
     *
     * @param string $url URL del enlace.
     * @param string $imageSrc Ruta de la imagen.
     * @param string $alt Texto alternativo de la imagen.
     * @param array $attributes Atributos del enlace.
     * @return string
     */

    public function Imagen_Link($url, $imageSrc, $alt = '', $attributes = [])
    {
        $html = '<a href="' . $url . '"';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '><img src="' . $imageSrc . '" alt="' . $alt . '"></a>';

        return $html;
    }

    /**
     * Genera un botón <button>.
     *
     * @param string $text Texto del botón.
     * @param array $attributes Atributos del botón.
     * @return string
     */
    public function Boton($text, $attributes = [])
    {
        $html = '<button';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>' . $text . '</button>';

        return $html;
    }

    /**
     * Genera un formulario <form>.
     *
     * @param string $action URL de acción del formulario.
     * @param string $method Método del formulario (POST o GET).
     * @param array $attributes Atributos del formulario.
     * @return string
     */
    public function Formulario($action, $method = 'POST', $attributes = [])
    {
        $html = '<form action="' . $action . '" method="' . $method . '"';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>';

        return $html;
    }

    /**
     * Genera un elemento <input>.
     *
     * @param string $type Tipo de input.
     * @param string $name Nombre del input.
     * @param string $value Valor del input.
     * @param array $attributes Atributos del input.
     * @return string
     */

    public function Input($type, $name, $value = '', $attributes = [])
    {
        $html = '<input type="' . $type . '" name="' . $name . '" value="' . $value . '"';
        foreach ($attributes as $name => $value) {
            $html .= ' ' . $name . '="' . $value . '"';
        }
        $html .= '>';

        return $html;
    }

}
