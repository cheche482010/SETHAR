<div style="display: flex; align-items: center; height: 100vh;">
  <img src="recursos/img/web/x.png" alt="Logo Personal" style="width: 300px; height: auto; border-radius: 5px;">
</div>

# Documentación del Framework [SETHAR]

# Descripción
El Framework SETHAR es una herramienta diseñada para facilitar el desarrollo de aplicaciones web en PHP. Proporciona una estructura organizada y componentes reutilizables para acelerar el proceso de desarrollo y mejorar la mantenibilidad del código.

# Estructura del proyecto
El proyecto sigue la siguiente estructura de carpetas:

- **app**: Contiene la lógica de la aplicación.

- **componentes**:
  - **base de datos**: Aquí encontrarás archivos relacionados con la configuración y manejo de la base de datos, como la conexión y las consultas SQL.
  - **interface**: Puedes tener interfaces que definan contratos para componentes específicos de tu aplicación, como autenticación, envío de correos electrónicos, etc.
  - **logs**: Aquí puedes almacenar archivos de registro (logs) para rastrear errores o eventos importantes en tu aplicación.
  - **tests**: Puedes tener archivos de prueba para tus componentes, utilizando una herramienta de pruebas como PHPUnit.
  - **traits**: Aquí puedes tener traits reutilizables que contengan métodos comunes que se pueden usar en múltiples clases.
  - **validacion**: Puedes tener archivos relacionados con la validación de datos, como reglas de validación y funciones de validación personalizadas.
  - **vendor**: Esta carpeta puede ser generada por Composer y contendría las dependencias de terceros instaladas en tu proyecto.

- **controlador**:
  - **interface**: Aquí puedes tener interfaces que definan contratos para tus controladores, lo que ayuda a establecer un estándar en los métodos que deben implementar.
  - **propiedades**: Puedes tener archivos que contengan definiciones de propiedades y constantes que se utilizan en tus controladores.

- **modelo**:
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
3. Configura la conexión a la base de datos en el archivo de configuración "componentes/traits/Componentes.php".
4. Realiza otras configuraciones necesarias según tus requisitos específicos.

# Uso del framework
El framework ofrece una estructura y componentes reutilizables para facilitar el desarrollo de aplicaciones web en PHP. A continuación, se describen los principales componentes del framework y cómo utilizarlos:

## Creación de Plantillas
El script "crear_modulo.bat" ubicado en la carpeta "componentes" permite crear plantillas de módulos de forma automatizada. Este script realiza las siguientes acciones:

1. Solicita al usuario el nombre del nuevo módulo.
2. Utiliza PowerShell para generar archivos de modelo, entidad, controlador, propiedades y validación con el nombre proporcionado.
3. Ofrece la opción de crear la plantilla de validación para el módulo.

## Controladores
Los controladores se encuentran en la carpeta "controlador" y son responsables de manejar las solicitudes y generar las respuestas correspondientes. Sigue las pautas establecidas en la documentación del framework para crear nuevos controladores.

## Modelos
Los modelos se encuentran en la carpeta "modelo" y representan la lógica de negocio y la interacción con la base de datos. Sigue las pautas establecidas en la documentación del framework para crear nuevos modelos.

## Vistas
Las vistas se encuentran en la carpeta "vista" y son responsables de mostrar la interfaz de usuario al usuario final. Organiza las vistas en subcarpetas según la funcionalidad o el contexto.

## Configuración adicional
Si necesitas configurar componentes adicionales, como el enrutamiento, la autenticación, la validación o cualquier otro componente proporcionado por el framework, consulta la documentación específica de cada componente en la carpeta "componentes".

# Contribución
¡Nos encantaría recibir contribuciones de la comunidad! Si deseas contribuir al desarrollo del framework, consulta las pautas de contribución en el archivo CONTRIBUTING.md en la raíz del proyecto.
