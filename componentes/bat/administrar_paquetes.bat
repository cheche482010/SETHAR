@echo off
REM Obtener la ruta del directorio del proyecto
set "project_dir=%~dp0..\..\..\"

REM Navegar al directorio "componentes" del proyecto
cd /d "%project_dir%SETHAR\componentes"

setlocal

:menu
cls
echo.
echo ===================Administrar Paquetes Composer=================== 
echo.
echo 1. Ver paquetes instalados
echo 2. Agregar paquete
echo 3. Eliminar paquete
echo 4. Actualizar paquetes
echo 5. Cargar clases
echo 6. Salir
echo.
set /p opcion="Elija una opcion: "

if "%opcion%"=="1" goto ver_paquetes_instalados
if "%opcion%"=="2" goto agregar_paquete
if "%opcion%"=="3" goto eliminar_paquete
if "%opcion%"=="4" goto actualizar_paquetes
if "%opcion%"=="5" goto cargar_clases
if "%opcion%"=="6" goto fin

:ver_paquetes_instalados
REM Verificar si el directorio "componentes" existe dentro del proyecto
if exist "%project_dir%SETHAR\componentes" (
    REM Navegar al directorio "componentes"
    cd /d "%project_dir%SETHAR\componentes"

    REM Ejecutar el comando "composer show"
    call composer show
) else (
    echo El directorio "%project_dir%SETHAR\componentes" no existe.
)

pause
goto menu

:agregar_paquete
set /p paquete="Escriba el nombre del paquete a instalar: "
call composer require %paquete%
echo Paquete instalado exitosamente.
pause
goto menu

:eliminar_paquete
set /p paquete="Escriba el nombre del paquete a eliminar: "
call composer remove %paquete%
echo Paquete eliminado exitosamente.
pause
goto menu

:actualizar_paquetes
call composer update
echo Paquetes actualizados exitosamente.
pause
goto menu

:cargar_clases
call composer dump-autoload -o
echo Clases cargadas exitosamente.
pause
goto menu

:fin
echo ======================Fin======================
endlocal
pause
