<?php

class Ejemplo_Trait_Json
{
    use Componentes\Funciones\Json;

    public function codificarJson()
    {
        $data = ['nombre' => 'Juan', 'edad' => 30];

        $json = $this->Codificar_Json($data);
        echo $json;
    }

    public function decodificarJson()
    {
        $json = '{"nombre":"Juan","edad":30}';

        $data = $this->Decodificar_Json($json);
        print_r($data);
    }

    public function validarJson()
    {
        $json = '{"nombre":"Juan","edad":30}';

        $valido = $this->Validar_Json($json);
        echo ($valido) ? 'El JSON es válido' : 'El JSON no es válido';
    }

    public function validarEsquemaJson()
    {
        $data = '{"nombre":"Juan","edad":30}';
        $schema = '{"nombre":"string","edad":"integer"}';

        $valido = $this->Validar_Esquema_Json($data, $schema);
        echo ($valido) ? 'Los datos cumplen con el esquema' : 'Los datos no cumplen con el esquema';
    }

    public function serializarObjetoJson()
    {
        $objeto = new stdClass();
        $objeto->nombre = 'Juan';
        $objeto->edad = 30;

        $json = $this->Serializar_Objeto_Json($objeto);
        echo $json;
    }

    public function deserializarObjetoJson()
    {
        $json = '{"nombre":"Juan","edad":30}';
        $className = 'Persona';

        $objeto = $this->Deserializar_Objeto_Json($json, $className);
        echo $objeto->nombre; // Imprime 'Juan'
        echo $objeto->edad; // Imprime 30
    }

    public function buscarValorJson()
    {
        $json = '{"persona":{"nombre":"Juan","edad":30}}';
        $key = 'persona.nombre';

        $valor = $this->Buscar_Valor_Json($json, $key);
        echo $valor; // Imprime 'Juan'
    }

    public function ordenarArregloJson()
    {
        $json = '[{"nombre":"Juan","edad":30},{"nombre":"Ana","edad":25}]';
        $key = 'edad';

        $jsonOrdenado = $this->Ordenar_Arreglo_Json($json, $key);
        echo $jsonOrdenado; // Imprime '[{"nombre":"Ana","edad":25},{"nombre":"Juan","edad":30}]'
    }

    public function embellecerJson()
    {
        $json = '{"nombre":"Juan","edad":30}';

        $jsonEmbellecido = $this->Embellecer_Json($json);
        echo $jsonEmbellecido;
        // Imprime:
        // {
        //    "nombre": "Juan",
        //    "edad": 30
        // }
    }

    public function codificarBinarioJson()
    {
        $data = file_get_contents('ruta/a/archivo.jpg');

        $json = $this->Codificar_Binario_Json($data);
        echo $json;
    }

    public function decodificarBinarioJson()
    {
        $json = '["aGVsbG8gd29ybGQ="]';

        $data = $this->Decodificar_Binario_Json($json);
        file_put_contents('ruta/a/archivo.jpg', $data);
    }
}

