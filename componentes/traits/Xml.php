<?php

namespace Componentes\Funciones;

trait XML
{
    /**
     * Convierte un objeto o arreglo en formato XML.
     *
     * @param mixed $data Los datos a convertir en XML.
     * @param string $rootElement El nombre del elemento raíz (opcional, valor por defecto: "root").
     * @return string|null La representación XML de los datos o null en caso de error.
     */
    public function Codificar_XML($data, $rootElement = "root")
    {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><{$rootElement}></{$rootElement}>");
        $this->arrayToXML($data, $xml);
        return $xml->asXML();
    }

    /**
     * Función auxiliar para convertir un arreglo en formato XML.
     *
     * @param array $data Los datos a convertir en XML.
     * @param SimpleXMLElement $xml El objeto SimpleXMLElement actual.
     */
    private function Array_XML($data, &$xml)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = "item";
                }
                $subnode = $xml->addChild($key);
                $this->arrayToXML($value, $subnode);
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
    }

    /**
     * Convierte una cadena XML en un objeto o arreglo PHP.
     *
     * @param string $xml La cadena XML a convertir.
     * @return mixed Los datos XML convertidos en formato PHP o null en caso de error.
     */
    public function Decodificar_XML($xml)
    {
        $data = simplexml_load_string($xml);
        if ($data) {
            return $this->xmlToArray($data);
        }
        return null;
    }

    /**
     * Función auxiliar para convertir un objeto SimpleXMLElement en formato PHP.
     *
     * @param SimpleXMLElement $xml El objeto SimpleXMLElement a convertir.
     * @return mixed Los datos XML convertidos en formato PHP.
     */
    private function XML_Array($xml)
    {
        $array = [];
        foreach ($xml->children() as $key => $value) {
            if ($value->count() > 0) {
                $array[$key] = $this->xmlToArray($value);
            } else {
                $array[$key] = (string) $value;
            }
        }
        return $array;
    }

    /**
     * Valida la estructura y el esquema de un archivo XML utilizando un esquema XML (XSD).
     *
     * @param string $xml La cadena XML a validar.
     * @param string $xsd El esquema XML (XSD) a utilizar para la validación.
     * @return bool True si el XML cumple con el esquema, False en caso contrario.
     */
    public function Validar_Esquema_XML($xml, $xsd)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        return $dom->schemaValidate($xsd);
    }

    /**
     * Busca y extrae valores específicos de un archivo XML.
     *
     * @param string $xml La cadena XML en la que se realizará la búsqueda.
     * @param string $tag La etiqueta XML a buscar.
     * @return mixed El valor encontrado o null si no se encuentra.
     */
    public function Extraer_Valor_XML($xml, $tag)
    {
        $data   = simplexml_load_string($xml);
        $result = $data->xpath("//{$tag}");
        return $result ? (string) $result[0] : null;
    }

    /**
     * Genera dinámicamente un archivo XML a partir de datos proporcionados.
     *
     * @param array $data Los datos a incluir en el archivo XML.
     * @param string $rootElement El nombre del elemento raíz (opcional, valor por defecto: "root").
     * @return string|null La representación XML generada o null en caso de error.
     */
    public function Generar_XML($data, $rootElement = "root")
    {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><{$rootElement}></{$rootElement}>");
        $this->arrayToXML($data, $xml);
        return $xml->asXML();
    }

    /**
     * Aplica una transformación XSLT a un archivo XML.
     *
     * @param string $xml La cadena XML a transformar.
     * @param string $xsl La cadena XSLT a aplicar.
     * @return string|null La representación XML transformada o null en caso de error.
     */
    public function Transformar_XML($xml, $xsl)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xslt = new XSLTProcessor();
        $xslt->importStylesheet(new SimpleXMLElement($xsl));

        return $xslt->transformToXML($dom);
    }

    /**
     * Valida la sintaxis y estructura de un archivo XML.
     *
     * @param string $xml La cadena XML a validar.
     * @return bool True si el XML es válido, False en caso contrario.
     */
    public function Validar_XML($xml)
    {
        $dom = new DOMDocument();
        return $dom->loadXML($xml);
    }
}
