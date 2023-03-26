@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\SETHAR
echo.
echo ===================Pruebas del modulo ejemplo=================== 
echo.
php vendor/bin/phpunit tests/ejemploTest.php --testdox-xml componentes/tests/resultados/ejemplo/ejemplo-resultados.xml --testdox-html componentes/tests/resultados/ejemplo/ejemplo-resultados.html --testdox --log-junit componentes/tests/resultados/ejemplo/ejemplo-resultados.xml  --testdox --log-junit componentes/tests/resultados/ejemplo/ejemplo-resultados.log  --cache-result-file componentes/tests/resultados/ejemplo/.phpunit.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause