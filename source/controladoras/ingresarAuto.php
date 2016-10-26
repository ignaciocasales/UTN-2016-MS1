<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    require ('../modelo/Vehiculo.php');
    require ('../DAO/VehiculoJsonDao.php');
    //requiere (modelo/Persona.php);
    //requiere (DAO/PersonaJsonDao.php);

    $vehiculos = new VehiculoJsonDao();

    if(empty($_POST['check'])){
        $patente   = $_POST['patente'];
        $marca     = $_POST['marca'  ];
        $modelo    = $_POST['modelo' ];
        /*$nombreTitular    = $_POST['titular'];
        $dniTitular       = $_POST['dni'];
        $domicilioTitular = $_POST['domicilio'];*/

        $vehiculo  = new Vehiculo($modelo,$marca,$patente,null);
        //$persona   = new Persona($nombre,$dni,$domicilio);

        //$personas  = new PersonasJsonDao();

        $vehiculos->agregar($vehiculo); 
        //$personas->agregar($persona);

        //$lista_personas = $personas->dameTodos();
    }
   
    $lista_vehiculos = $vehiculos->dameTodos();

    include '../vista/vistaVehiculo.php';
    