<?php
require 'C:/xampp/htdocs/TiendaEnLinea/vendor/autoload.php';


$pelicula = new shophub\Pelicula;

if($_SERVER['REQUEST_METHOD'] ==='POST'){
        if($_POST['accion'] === 'Registrar'){
            if(empty($_POST['titulo']))
                exit('Completar titulo');

            if(empty($_POST['descripcion']))
                exit('Completar descripcion');

            if(empty($_POST['categoria_id']))
                exit('Seleccionar una categoria');

            if(!is_numeric($_POST['categoria_id']))
                exit('Seleccionar una categoria valida');


            $_params = array(
            'titulo'=>$_POST['titulo'],
            'descripcion'=>$_POST['descripcion'],
            'foto'=>subirFoto(),
            'precio'=>$_POST['precio'],
            'categoria_id'=>$_POST['categoria_id'],
            'fecha'=>date('y-m-d')
            );

            $rpt = $pelicula->registrar($_params);
            if($rpt)
                header('Location: peliculas/index.php');
            else
                print 'Error al registrar una pelicula';
            

    }

}

function subirFoto(){
    $carpeta = __DIR__.'../../upload/';

    $archivo = $carpeta.$_FILES['foto']['name'];

    move_uploaded_file($_FILES['foto']['tmp_name'],$archivo);

    return $_FILES['foto']['name'];
}