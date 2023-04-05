@echo off
echo ===================Creacion de Modulos=================== 
echo.
set /p nombre=Ingrese el nombre del nuevo modulo: 
powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc ../modelo/ejemplo_class.php) -replace 'Ejemplo', $nombre | Out-File ../modelo/%nombre%_class.php"
echo.
echo el modelo: modelo/%nombre%_class.php" fue creado exitosamente.
powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc ../controlador/ejemplo_controlador.php) -replace 'Ejemplo', $nombre | Out-File ../controlador/%nombre%_controlador.php"
echo el controlador: controlador/%nombre%_controlador.php" fue creado exitosamente.
echo.
echo =========================Fin===============================
pause
