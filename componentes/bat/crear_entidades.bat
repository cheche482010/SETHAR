@echo off
echo ===================Creacion de Entidad/Propiedad Modulos=================== 

echo Recordatori: El modulo se creara en base a la tabla padre de su bd.
echo.
REM Obtener la ruta del directorio del proyecto
set "project_dir=%~dp0..\..\"

REM Navegar al directorio "componentes/clases" del proyecto
cd /d "%project_dir%componentes\clases"

set /p tableName=Ingrese el nombre del Modulo (nombre de la tabla):
echo.
REM Solicitar al usuario el tipo de archivo (Entidad = 1, Propiedad = 2)
echo Seleccione el tipo de archivo:
echo 1. Entidad   (entidades relacionada a los modelos)
echo 2. Propiedad (propiedades relacionada a los controladores)
echo.
set /p tipo=Ingrese el numero correspondiente al tipo de archivo:
echo.
php -f Generador.php %tableName% %tipo%
echo.
echo =========================Fin===============================
pause
