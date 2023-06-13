<?php


use Componentes\Funciones\Html;

class Ejemplo_Trait_Html
{
    use \Html;

    public function generarDiv()
    {
        $content = 'Contenido del div';
        $attributes = ['class' => 'mi-div'];

        $html = $this->Div($content, $attributes);

        echo $html;
    }

    public function generarLink()
    {
        $text = 'Texto del enlace';
        $url = 'https://www.example.com';
        $attributes = ['class' => 'mi-enlace'];

        $html = $this->Link($text, $url, $attributes);

        echo $html;
    }

    public function generarParrafo()
    {
        $content = 'Contenido del párrafo';
        $attributes = ['style' => 'color: blue'];

        $html = $this->Parrafo($content, $attributes);

        echo $html;
    }

    public function generarImagen()
    {
        $src = 'ruta/imagen.jpg';
        $alt = 'Texto alternativo de la imagen';
        $attributes = ['class' => 'mi-imagen'];

        $html = $this->Imagen($src, $alt, $attributes);

        echo $html;
    }

    public function generarLista()
    {
        $items = ['Item 1', 'Item 2', 'Item 3'];
        $attributes = ['class' => 'mi-lista'];

        $html = $this->Lista($items, $attributes);

        echo $html;
    }

    public function generarTabla()
    {
        $data = [
            ['Dato 1', 'Dato 2', 'Dato 3'],
            ['Dato 4', 'Dato 5', 'Dato 6'],
            ['Dato 7', 'Dato 8', 'Dato 9'],
        ];
        $attributes = ['class' => 'mi-tabla'];

        $html = $this->Tabla($data, $attributes);

        echo $html;
    }

    public function generarTitulo()
    {
        $text = 'Título de nivel 1';
        $level = 1;
        $attributes = ['class' => 'mi-titulo'];

        $html = $this->Titulo($text, $level, $attributes);

        echo $html;
    }

    public function generarImagenLink()
    {
        $url = 'https://www.example.com';
        $imageSrc = 'ruta/imagen.jpg';
        $alt = 'Texto alternativo';
        $attributes = ['class' => 'mi-enlace-imagen'];

        $html = $this->Imagen_Link($url, $imageSrc, $alt, $attributes);

        echo $html;
    }

    public function generarBoton()
    {
        $text = 'Texto del botón';
        $attributes = ['class' => 'mi-boton'];

        $html = $this->Boton($text, $attributes);

        echo $html;
    }

    public function generarFormulario()
    {
        $action = 'procesar.php';
        $method = 'POST';
        $attributes = ['class' => 'mi-formulario'];

        $html = $this->Formulario($action, $method, $attributes);

        echo $html;
    }

    public function generarInput()
    {
        $type = 'text';
        $name = 'nombre';
        $value = '';
        $attributes = ['class' => 'mi-input'];

        $html = $this->Input($type, $name, $value, $attributes);

        echo $html;
    }
}
