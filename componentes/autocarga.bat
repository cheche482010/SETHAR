@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\SETHAR\componentes
echo.
echo ===================Carga de Clases=================== 
composer dump-autoload -o
echo ======================Fin de la Carga======================
echo.
pause
echo Presione cualquier tecla para salir...
