<div style="display: flex; align-items: center; height: 100vh;">
  <img src="recursos/img/web/x.png" alt="Logo Personal" style="width: 300px; height: auto; border-radius: 5px;">
</div>

# Documentación del Framework [SETHAR]

# Descripción
El Framework SETHAR es una herramienta diseñada para facilitar el desarrollo de aplicaciones web en PHP. Proporciona una estructura organizada y componentes reutilizables para acelerar el proceso de desarrollo y mejorar la mantenibilidad del código.

# Estructura del proyecto
El proyecto sigue la siguiente estructura de carpetas:

- **app**: Contiene la lógica de la aplicación.
  - **App.php**: Frontcontroller de la aplicacion.
  - **Base_Datos.php**: conexion a la base de datos.
  - **Configuracion.php**: configuracion de credenciales.
  - **Controlador.php**: clase padre provedora de herramientas al los controladores.
  - **Modelo.php**: clase padre provedora de herramientas al los modelos.
  - **Vista.php**: clase proveedora de las rutas y recursos del sistema.

- **componentes**:
  - **base de datos**: Aquí encontrarás archivos relacionados con la configuración y manejo de la base de datos, como la conexión y las consultas SQL.
  - **bat**: carpeta contenedora de archivos bat, podras encontrar ejecutables que te proporcionaran ayuda.
  - **clases**: componente de clases con herramientas y funcionalidades para el sistema.
  - **interface**: Puedes tener interfaces que definan contratos para componentes específicos de tu aplicación, como autenticación, envío de correos electrónicos, etc.
  - **json**: Aquí puedes almacenar archivos json asi como optener los proporsionados por el framework.
  - **logs**: Aquí puedes almacenar archivos de registro (logs) para rastrear errores o eventos importantes en tu aplicación.
  - **pruebas**: Contiene ejemplo de las funcionalidades.
  - **TCPDF**: Librera de manejo de pdf.
  - **tests**: Puedes tener archivos de prueba para tus componentes, utilizando una herramienta de pruebas como PHPUnit.
  - **traits**: Aquí puedes tener traits reutilizables que contengan métodos comunes que se pueden usar en múltiples clases.
  - **validacion**: Puedes tener archivos relacionados con la validación de datos, como reglas de validación y funciones de validación personalizadas.
  - **vendor**: Esta carpeta puede ser generada por Composer y contendría las dependencias de terceros instaladas en tu proyecto.

- **controlador**: carpeta donde guararas los controladores del sistema
  - **interface**: Aquí puedes tener interfaces que definan contratos para tus controladores, lo que ayuda a establecer un estándar en los métodos que deben implementar.
  - **propiedades**: Puedes tener archivos que contengan definiciones de propiedades y constantes que se utilizan en tus controladores.

- **modelo**: carpeta donde guararas los modelos del sistema
  - **entidades**: Aquí puedes tener clases que representen las entidades o modelos de tu aplicación, mapeando a tablas de la base de datos.
  - **interface**: Puedes tener interfaces que definan contratos para tus modelos, especificando los métodos que deben implementar.

- **recursos**:
  - **css**: Aquí puedes almacenar tus archivos CSS para estilos personalizados.
  - **js**: Puedes tener tus archivos JavaScript para funcionalidades interactivas del lado del cliente.
  - **img**: Aquí puedes guardar las imágenes utilizadas en tu aplicación.
  - **plugins**: Puedes incluir bibliotecas o complementos de terceros utilizados en tu aplicación.
  - **scss**: Si utilizas Sass para escribir tus estilos, puedes tener archivos .scss aquí que se compilen en CSS.

- **vista**:
  - **ejemplo**: Ejemplo de una vista específica.
    - **css**: Aquí puedes almacenar los archivos CSS específicos para el módulo "ejemplo".
    - **js**: Aquí puedes tener los archivos JavaScript específicos para el módulo "ejemplo".
    - **modal**: Aquí puedes tener archivos relacionados con los modales específicos para el módulo "ejemplo".
  - **publico**: Aquí puedes tener archivos de plantillas para las páginas públicas de tu aplicación.
  - **privado**: Puedes tener archivos de plantillas para las páginas privadas o con acceso restringido.

- **index.php**: Punto de entrada de la aplicación.


# Configuración inicial
Antes de comenzar a utilizar el framework, sigue los siguientes pasos de configuración:

1. Clone el repositorio [https://github.com/cheche482010/SETHAR] en tu entorno local.
2. Instala las dependencias ejecutando el comando "composer install" en la raíz del proyecto.
3. Configura la conexión a la base de datos en el archivo de configuración "APP/Configuracion.php.php".
4. Realiza otras configuraciones necesarias según tus requisitos específicos.

# Uso del framework
El framework ofrece una estructura y componentes reutilizables para facilitar el desarrollo de aplicaciones web en PHP. A continuación, se describen los principales componentes del framework y cómo utilizarlos:

## Creación de Plantillas
El script "crear_modulo.bat" ubicado en la carpeta "componentes/bat" permite crear plantillas de módulos de forma automatizada. Este script realiza las siguientes acciones:

1. Solicita al usuario el nombre del nuevo módulo.
2. Utiliza PowerShell para generar archivos de modelo, entidad, controlador, propiedades y validación con el nombre proporcionado.
3. Ofrece la opción de crear la plantilla de validación para el módulo.

## Controladores
Los controladores se encuentran en la carpeta "controlador" y son responsables de manejar las solicitudes y generar las respuestas correspondientes. Sigue las pautas establecidas en la documentación del framework para crear nuevos controladores.

```php 
class Ejmplo extends Controlador
{
   
    public function __construct()
    {
        parent::__construct();
    }

    public function Cargar_Vistas()
    {
        Vista::Ejmplo('index');
    }
} 
```

## Modelos
Los modelos se encuentran en la carpeta "modelo" y representan la lógica de negocio y la interacción con la base de datos. Sigue las pautas establecidas en la documentación del framework para crear nuevos modelos.

```php
class Ejemplo_Modelo extends Modelo
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Configurar(array $configuracion): self
    {
        $this->configuracion = $configuracion;
        $this->SQL           = isset($this->configuracion['sql']) ? $this->configuracion['sql'] : null;
        $this->datos         = isset($this->configuracion['datos']) ? $this->configuracion['datos'] : null;
        $this->opciones      = isset($this->configuracion['opciones']) ? array_merge($this->opciones_predeterminadas, $this->configuracion['opciones']) : $this->opciones_predeterminadas;
        return $this;
    }

    public function Sentencia():  ? string
    {
        $this->class = new Clases("Ejemplo_Modelo");
        return $this->class->verificar_funcion($this->SQL) ? $this->{$this->SQL}() : Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->SQL . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
    }

    /**
     * Administra el modelo y ejecuta la sentencia actual.
     *
     * @return mixed Resultado de la operación.
     */
    public function Administrar() : mixed
    {
        $this->sentencia = $this->Sentencia();
        try {
            $this->resultado = $this->Ejecutar(
                $this->sentencia,
                $this->datos,
                $this->opciones['forzado'],
                $this->opciones['transaccion'],
                $this->opciones['tipo_valor'],
                $this->opciones['ultimo_id'],
                $this->opciones['cache'],
                $this->opciones['filtrado']
            );
            $this->Desconectar();
            return $this->resultado;
        } catch (PDOException $e) {
            Errores::Capturar()->Manejo_Excepciones($e);
        }
    }

}  
```

## Vistas
Las vistas se encuentran en la carpeta "vista" y son responsables de mostrar la interfaz de usuario al usuario final. Organiza las vistas en subcarpetas según la funcionalidad o el contexto.

```php
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php Vista::Recursos("Meta"); ?>
        <?php Vista::Recursos("Titulo"); ?>
        <?php Vista::Recursos("Estilos"); ?>
    </head>

    <body class="hold-transition text-sm layout-top-nav layout-fixed layout-navbar-fixed layout-footer-fixed" id="body">
        <main class="wrapper">
            <?php Vista::Recursos("Navbar"); ?>
            <!-- Contenido de la pagina -->
            <div class="content-wrapper">
                <?php Vista::Recursos("Contenido"); ?>
            </div>
            <!-- /.content-wrapper -->
            <?php Vista::Recursos("Footer"); ?>
        </main>
        <?php Vista::Recursos("Script"); ?>
    </body>
</html>  
```

## Configuración adicional
Si necesitas configurar componentes adicionales, como el enrutamiento, la autenticación, la validación o cualquier otro componente proporcionado por el framework, consulta la documentación específica de cada componente en la carpeta "componentes".

# Paquetes Instalados

El Framework SETHAR utiliza varios paquetes de terceros para mejorar su funcionalidad y ofrecer características adicionales. A continuación se describen los paquetes instalados en el framework:

- **doctrine/dbal**: Versión "^3.3". Este paquete proporciona una capa de abstracción para interactuar con la base de datos utilizando la biblioteca Doctrine DBAL. Permite ejecutar consultas SQL, gestionar la conexión a la base de datos y trabajar con diferentes tipos de datos.

- **doctrine/orm**: Versión "^2.14". Doctrine ORM es una biblioteca de mapeo objeto-relacional (ORM) que proporciona una forma conveniente de trabajar con la base de datos utilizando modelos y entidades. Facilita la manipulación de los datos almacenados en la base de datos y ofrece funcionalidades avanzadas como consultas, relaciones entre entidades y generación de esquemas.

- **doctrine/cache**: Versión "^1.11". Este paquete proporciona una capa de abstracción para trabajar con la caché en el framework. Permite almacenar y recuperar datos en caché, lo que mejora el rendimiento de la aplicación al reducir la necesidad de realizar operaciones costosas.

- **doctrine/annotations**: Versión "^1.0". Doctrine Annotations es una biblioteca que permite utilizar anotaciones en el código PHP para definir metadatos adicionales. Estos metadatos se utilizan, por ejemplo, en el mapeo de objetos a la base de datos o en la configuración de rutas en el enrutador del framework.

- **monolog/monolog**: Versión "^2.9". Monolog es una biblioteca de registro (logging) para PHP que permite registrar mensajes y eventos en diferentes canales y formatos. Proporciona flexibilidad en la configuración del registro y facilita la depuración y monitorización de la aplicación.

- **tedivm/stash**: Versión "^0.17.6". Stash es una biblioteca de almacenamiento en caché que permite almacenar y recuperar datos en caché de manera eficiente. Ofrece diferentes adaptadores de almacenamiento (como archivos, memoria y bases de datos) y opciones avanzadas de configuración.

- **tedivm/jshrink**: Versión "^1.6". JShrink es una biblioteca para minificar y comprimir código JavaScript. Permite reducir el tamaño de los archivos JavaScript para mejorar el rendimiento de la aplicación web al reducir el tiempo de carga de la página.

- **cache/filesystem-adapter**: Versión "^1.1". Este paquete proporciona un adaptador para el almacenamiento en caché utilizando el sistema de archivos. Permite almacenar y recuperar datos en caché utilizando archivos en el sistema de archivos del servidor.

- **phpmailer/phpmailer**: Versión "^6.8". PHPMailer es una biblioteca de envío de correos electrónicos en PHP. Proporciona una interfaz sencilla para enviar correos electrónicos con capacidades avanzadas, como adjuntar archivos, enviar correos en formato HTML y utilizar protocolos de seguridad.

Estos paquetes son utilizados en el framework para agregar funcionalidades adicionales y mejorar la experiencia de desarrollo al trabajar con el framework SETHAR.

# Contribución
¡Nos encantaría recibir contribuciones de la comunidad! Si deseas contribuir al desarrollo del framework, consulta las pautas de contribución en el archivo CONTRIBUTING.md en la raíz del proyecto.
