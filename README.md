# Documentación del Framework [SETHAR]

# Descripción
El Framework SETHAR es una herramienta diseñada para facilitar el desarrollo de aplicaciones web en PHP. Proporciona una estructura organizada y componentes reutilizables para acelerar el proceso de desarrollo y mejorar la mantenibilidad del código.

# Estructura del proyecto
El proyecto sigue la siguiente estructura de carpetas:

app: Contiene la lógica de la aplicación.
componentes: Incluye componentes adicionales utilizados por el framework, como base de datos, validación, logs, etc.
recursos: Contiene archivos estáticos como CSS, JavaScript e imágenes.
controlador: Contiene los controladores de la aplicación.
interface: Define las interfaces de los controladores.
propiedades: Contiene las propiedades de los controladores.
modelo: Contiene los modelos de la aplicación.
entidades: Contiene las entidades de los modelos.
interface: Define las interfaces de los modelos.
vista: Contiene las vistas de la aplicación.
ejemplo: Ejemplo de una vista específica.
publico: Contiene vistas públicas.
privado: Contiene vistas privadas.
index.php: Punto de entrada de la aplicación.

# Configuración inicial
Antes de comenzar a utilizar el framework, siga los siguientes pasos de configuración:

Clone el repositorio [https://github.com/cheche482010/SETHAR] en su entorno local.
Instale las dependencias ejecutando el comando "composer install" en la raíz del proyecto.
Configure la conexión a la base de datos en el archivo de configuración "componentes/traits/Componentes.php".
Realice otras configuraciones necesarias según sus requisitos específicos.

# Uso del framework
El framework ofrece una estructura y componentes reutilizables para facilitar el desarrollo de aplicaciones web en PHP. A continuación, se describen los principales componentes del framework y cómo utilizarlos:

# Creación de Plantillas:
El script "crear_modulo.bat" ubicado en la carpeta "componentes" permite crear plantillas de módulos de forma automatizada. Este script realiza las siguientes acciones:

Solicita al usuario el nombre del nuevo módulo.
Utiliza PowerShell para generar archivos de modelo, entidad, controlador, propiedades y validación con el nombre proporcionado.
Ofrece la opción de crear la plantilla de validación para el módulo.
Controladores:
Los controladores se encuentran en la carpeta "controlador" y son responsables de manejar las solicitudes y generar las respuestas correspondientes. Siga las pautas establecidas en la documentación del framework para crear nuevos controladores.

# Modelos:
Los modelos se encuentran en la carpeta "modelo" y representan la lógica de negocio y la interacción con la base de datos. Siga las pautas establecidas en la documentación del framework para crear nuevos modelos.

# Vistas:
Las vistas se encuentran en la carpeta "vista" y son responsables de mostrar la interfaz de usuario al usuario final. Organice las vistas en subcarpetas según la funcionalidad o el contexto.

# Configuración adicional
Si necesita configurar componentes adicionales, como el enrutamiento, la autenticación, la validación o cualquier otro componente proporcionado por el framework, consulte la documentación específica de cada componente en la carpeta "componentes".

# Contribución
¡Nos encantaría recibir contribuciones de la comunidad! Si desea contribuir al desarrollo del framework, consulte las pautas de contribución en el archivo CONTRIBUTING.md en la raíz del proyecto.
