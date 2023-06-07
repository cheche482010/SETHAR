@echo off
echo ===================Creacion de Modulos=================== 
echo.
set /p nombre=Ingrese el nombre del nuevo modulo: 

powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc ../../modelo/ejemplo_class.php) -replace 'Ejemplo', $nombre | Out-File ../../modelo/%nombre%_class.php"
echo el modelo: modelo/%nombre%_class.php" fue creado exitosamente.

powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc ../../modelo/entidades/ejemplo.php) -replace 'Ejemplo', $nombre | Out-File ../../modelo/entidades/%nombre%.php"
echo la entidad: modelo/entidades/%nombre%.php" fue creado exitosamente.

powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc ../../controlador/ejemplo_controlador.php) -replace 'Ejemplo', $nombre | Out-File ../../controlador/%nombre%_controlador.php"
echo el controlador: controlador/%nombre%_controlador.php" fue creado exitosamente.

powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc ../../controlador/propiedades/ejemplo.php) -replace 'Ejemplo', $nombre | Out-File ../../controlador/propiedades/%nombre%.php"
echo la propiedad: controlador/propiedades/%nombre%.php" fue creado exitosamente.

echo.
choice /C YN /M "¿Desea crear la plantilla para validacion Backend del modulo %nombre%? (Y/N)"
if errorlevel 2 goto :fin

powershell -Command "$nombre = '%nombre%'; $nombre = $nombre.ToLower(); $nombre = $nombre.Substring(0,1).ToUpper() + $nombre.Substring(1); (gc validacion/ejemplo_validacion.php) -replace 'Ejemplo', $nombre | Out-File validacion/%nombre%_validacion.php"
echo la plantilla de validacion: componentes/validacion/%nombre%_validacion.php" fue creada exitosamente.

:fin
echo.
echo =========================Fin===============================
pause