<?php

namespace Componentes\Funciones;

use DOMDocument;
use SimpleXMLElement;
use XSLTProcessor;

class Ejemplo_Trait_XML
{
    use XML;

    public function codificarEjemplo()
    {
        $data = [
            'nombre' => 'John Doe',
            'edad' => 30,
            'email' => 'johndoe@example.com'
        ];
    
        $xmlString = $this->Codificar_XML($data, 'person');
        echo $xmlString;
    }

    public function decodificarEjemplo()
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
        <person>
            <nombre>John Doe</nombre>
            <edad>30</edad>
            <email>johndoe@example.com</email>
        </person>';
    
        $data = $this->Decodificar_XML($xmlString);
        print_r($data);
    }

    public function validarEsquemaEjemplo()
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
        <book>
            <title>Harry Potter</title>
            <author>J.K. Rowling</author>
        </book>';
    
        $xsdString = '<?xml version="1.0"?>
        <xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
            <xs:element name="book">
                <xs:complexType>
                    <xs:sequence>
                        <xs:element name="title" type="xs:string"/>
                        <xs:element name="author" type="xs:string"/>
                    </xs:sequence>
                </xs:complexType>
            </xs:element>
        </xs:schema>';
    
        $isValid = $this->Validar_Esquema_XML($xmlString, $xsdString);
        echo $isValid ? 'El XML cumple con el esquema.' : 'El XML no cumple con el esquema.';
    }

    public function extraerValorEjemplo()
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
        <book>
            <title>Harry Potter</title>
            <author>J.K. Rowling</author>
        </book>';
    
        $value = $this->Extraer_Valor_XML($xmlString, 'author');
        echo $value;
    }

    public function generarXMLEjemplo()
    {
        $data = [
            'product' => [
                'name' => 'Phone',
                'price' => 500,
                'description' => 'A smartphone'
            ]
        ];
    
        $xmlString = $this->Generar_XML($data, 'catalog');
        echo $xmlString;
    }

    public function transformarXMLEjemplo()
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
        <catalog>
            <product>
                <name>Phone</name>
                <price>500</price>
                <description>A smartphone</description>
            </product>
        </catalog>';
    
        $xslString = '<?xml version="1.0" encoding="UTF-8"?>
        <xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
            <xsl:template match="/">
                <html>
                    <body>
                        <h1>Product Catalog</h1>
                    </body>
                </html>
            </xsl:template>
        </xsl:stylesheet>';
    
        $transformedXml = $this->Transformar_XML($xmlString, $xslString);
        echo $transformedXml;
    }

    public function validarXMLEjemplo()
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
        <book>
            <title>Harry Potter</title>
            <author>J.K. Rowling</author>
        </book>';
    
        $isValid = $this->Validar_XML($xmlString);
        echo $isValid ? 'El XML es válido.' : 'El XML no es válido.';
    }
}

// Uso de la clase XMLHelperClass
$xmlHelper = new XMLHelperClass();

echo "Ejemplo de Codificar_XML():\n";
$xmlHelper->codificarEjemplo();

echo "\nEjemplo de Decodificar_XML():\n";
$xmlHelper->decodificarEjemplo();

echo "\nEjemplo de Validar_Esquema_XML():\n";
$xmlHelper->validarEsquemaEjemplo();

echo "\nEjemplo de Extraer_Valor_XML():\n";
$xmlHelper->extraerValorEjemplo();

echo "\nEjemplo de Generar_XML():\n";
$xmlHelper->generarXMLEjemplo();

echo "\nEjemplo de Transformar_XML():\n";
$xmlHelper->transformarXMLEjemplo();

echo "\nEjemplo de Validar_XML():\n";
$xmlHelper->validarXMLEjemplo();
