<?php

function Auto_Cargar($directory)
{
    $files = glob("/".$directory . '/*.php');
    foreach ($files as $file) {
        require_once $file;
    }
}

Auto_Cargar("traits");
Auto_Cargar("interfaces");
Auto_Cargar("validacion");
Auto_Cargar("../controlador/interfaces");
Auto_Cargar("../modelo/interfaces");

