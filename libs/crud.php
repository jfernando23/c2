<?php
    function crearusu($Nombre,$Apellido,$Correo,$Direccion,$Hijos,$Ecivil,$Foto,$Usuario,$Contrasena){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT * FROM `usuarios` WHERE USUARIO = ?");
        $sentencia->bind_param('s',$Usuario);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        if( $resultado>=1){
            $_SESSION['error']=7;
        }
        else{
        $sentencia=$conexion->prepare("INSERT INTO `usuarios` SET `NOMBRE`=?, `APELLIDO`=?, `CORREO`=?, `DIRECCION`=?, `HIJOS`=?, `ESTADO`=?, `FOTO`=?, `USUARIO`=?, `CLAVE`=?");
        $sentencia->bind_param('ssssissss',$Nombre,$Apellido,$Correo,$Direccion,$Hijos,$Ecivil,$Foto,$Usuario,$Contrasena);
        $sentencia->execute();
        $resultado = $sentencia-> affected_rows;
        if ($resultado==1) {
            $_SESSION['error']=6;
            header('location: index.php');
            return 1;
        }else{
            $_SESSION['error']=3;
            return 0;
        }
        }
        $sentencia->close();
        $conexion->close();
        
    }
    function login($usuario,$contrasena){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT * FROM `usuarios` WHERE usuario=?");
        $sentencia->bind_param('s',$usuario);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        if ($fila = $resultado->fetch_assoc()) {
        $pass_db = $fila['CLAVE']; 
        if ($contrasena == $pass_db) {
            $_SESSION['error'] = 0;
            $_SESSION['id']=$fila['ID_USUARIO'];
            $_SESSION['nombre']=$fila['NOMBRE'];
            $_SESSION['apellidos']=$fila['APELLIDO'];
            $_SESSION['correo']=$fila['CORREO'];
            $_SESSION['direccion']=$fila['DIRECCION'];
            $_SESSION['hijos']=$fila['HIJOS'];
            $_SESSION['estado']=$fila['ESTADO'];
            $_SESSION['foto']=$fila['FOTO'];
            $_SESSION['usuario']=$fila['USUARIO'];
            $_SESSION['clave']=$fila['CLAVE'];
            header("location:principal.php");
            return $fila;
        }else {
            $_SESSION['error']=1;
        }
        }else{
            $_SESSION['error']=2;
        }
        $sentencia->close();
        $conexion->close();
    }
    function tuit($id,$tuit,$publico){
        require "conexion.php";
        
        $sentencia=$conexion->prepare("INSERT INTO `tuits` SET `ID_USUARIO`=?, `TUIT`=?, `PUBLICO`=?");
        $sentencia->bind_param('iss',$id,$tuit,$publico);
        $sentencia->execute();
        $resultado = $sentencia-> affected_rows;
        if ($resultado==1) {
            $_SESSION['error']=15;
            header("location:principal.php");
            return 'Creado con éxito';
        }else{
            $_SESSION['error']=16;
            header("location:principal.php");
            return 'El tuit no se pudo crear';
        }
        $sentencia->close();
        $conexion->close();
    }

    function enviarmensaje($ido, $iddes, $mensaje,$Foto1){     
        require "conexion.php";
        $sentencia=$conexion->prepare("INSERT INTO `mensajes` SET `MENSAJE`=?, `ID_USUARIOD`=?, `ID_USUARIOO`=? ,`ARCHIVO`=?");
        $sentencia->bind_param('siis',$mensaje,$iddes,$ido,$Foto1);
        $sentencia->execute();
        $resultado = $sentencia-> affected_rows;
        if ($resultado==1) {
            $_SESSION['error']=17;
            header("location:principal.php#resume");
            return "Mensaje Creado"; 
        }else{
            $_SESSION['error']=18;
            header("location:principal.php#resume");
            return "No se pudo enviar el Mensaje"; 
        }
        $sentencia->close();
        $conexion->close();
    }
    function mostrar(){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT U.NOMBRE, U.APELLIDO, U.FOTO, T.TUIT, T.FECHA FROM tuits AS T INNER JOIN usuarios U ON U.ID_USUARIO = T.ID_USUARIO WHERE T.PUBLICO = 'Sí' ORDER BY T.FECHA DESC");
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado;
    }
    function mostrarusu(){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDO FROM `usuarios`");
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado;
    }
    function mostrarid($id){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT U.NOMBRE, U.FOTO, T.ID_TUIT, T.TUIT, T.FECHA, T.PUBLICO FROM tuits AS T INNER JOIN usuarios U ON U.ID_USUARIO = T.ID_USUARIO WHERE T.ID_USUARIO = ? ORDER BY T.FECHA DESC");
        $sentencia->bind_param('i',$id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado;
    }
    function mostrarmensajes($id){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT ID_MENSAJE,MENSAJE,U.NOMBRE AS 'DESTINO', O.NOMBRE AS 'ORIGEN',O.FOTO, ARCHIVO, FECHA FROM `mensajes` AS M INNER JOIN usuarios U ON U.ID_USUARIO = M.ID_USUARIOD INNER JOIN usuarios O ON O.ID_USUARIO = M.ID_USUARIOO WHERE ID_USUARIOD = ? ORDER BY `FECHA` DESC");
        $sentencia->bind_param('i',$id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado;
    }
    function mostrarmensajesen($id){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT ID_MENSAJE,MENSAJE,U.NOMBRE AS 'DESTINO', O.NOMBRE AS 'ORIGEN',U.FOTO, ARCHIVO, FECHA FROM `mensajes` AS M INNER JOIN usuarios U ON U.ID_USUARIO = M.ID_USUARIOD INNER JOIN usuarios O ON O.ID_USUARIO = M.ID_USUARIOO WHERE ID_USUARIOO = ? ORDER BY `FECHA` DESC");
        $sentencia->bind_param('i',$id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado;
    }
    function eliminar($idt,$idu){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT * FROM `tuits` WHERE ID_TUIT=?");
        $sentencia->bind_param('i',$idt);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        if ($fila = $resultado->fetch_assoc()) {
        $id = $fila['ID_USUARIO'];
        if ($id == $idu) {
            $sentencia=$conexion->prepare("DELETE FROM `tuits` WHERE ID_TUIT =?");
            $sentencia->bind_param('i',$idt);
            $sentencia->execute();
            $resultado = $sentencia->get_result();

            $_SESSION['error']=21;
            header("location:principal.php");
            return 'Se elimino correctamente el tuit';
        }else {
            $_SESSION['error']=22;
            header("location:principal.php");
            return 'La acción no se pudo completar';
        }
        }else{
            $_SESSION['error']=22;
            header("location:principal.php");
            return 'La acción no se pudo completar';
        }  
    }
    function publicar($idt,$idu){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT * FROM `tuits` WHERE ID_TUIT=?");
        $sentencia->bind_param('i',$idt);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        if ($fila = $resultado->fetch_assoc()) {
        $id = $fila['ID_USUARIO'];
        if ($id == $idu) {
            $sentencia=$conexion->prepare("UPDATE `tuits` SET `PUBLICO`='Sí' WHERE ID_TUIT = ?");
            $sentencia->bind_param('i',$idt);
            $sentencia->execute();
            $resultado = $sentencia->get_result();

            $_SESSION['error']=21;
            header("location:principal.php");
            return 'Se publico el tuit';
        }else {
            $_SESSION['error']=22;
            header("location:principal.php");
            return 'La acción no se pudo completar';
        }
        }else{
            $_SESSION['error']=22;
            header("location:principal.php");
            return 'La acción no se pudo completar';
        }  
    }
    function despublicar($idt,$idu){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT * FROM `tuits` WHERE ID_TUIT=?");
        $sentencia->bind_param('i',$idt);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        if ($fila = $resultado->fetch_assoc()) {
        $id = $fila['ID_USUARIO'];
        if ($id == $idu) {
            $sentencia=$conexion->prepare("UPDATE `tuits` SET `PUBLICO`='No' WHERE ID_TUIT = ?");
            $sentencia->bind_param('i',$idt);
            $sentencia->execute();
            $resultado = $sentencia->get_result();

            $_SESSION['error']=21;
            header("location:principal.php");
            return 'Se despublico el tuit';
        }else {
            $_SESSION['error']=22;
            header("location:principal.php");
            return 'El tuit no le petenece al usuario';
        }
        }else{
            $_SESSION['error']=22;
            header("location:principal.php");
            return 'No existe el tuit';
        }  
    }
    function cambiard($Nombre1,$Apellido1,$Correo1,$Direccion1,$Hijos1,$Estado1,$Foto1,$IDU){
        require "conexion.php";
        //$IDU=$_SESSION['id'];
        $sentencia=$conexion->prepare("UPDATE `usuarios` SET `NOMBRE`=?, `APELLIDO`=?, `CORREO`=?, `DIRECCION`=?, `HIJOS`=?, `ESTADO`=?, `FOTO`=? WHERE `ID_USUARIO`=?");
        $sentencia->bind_param('ssssissi',$Nombre1,$Apellido1,$Correo1,$Direccion1,$Hijos1,$Estado1,$Foto1,$IDU);
        $sentencia->execute();
        $resultado = $sentencia-> affected_rows;
        if ($resultado==1) {
            $_SESSION['nombre']=$Nombre1;
            $_SESSION['apellidos']=$Apellido1;
            $_SESSION['correo']=$Correo1;
            $_SESSION['direccion']=$Direccion1;
            $_SESSION['hijos']=$Hijos1;
            $_SESSION['estado']=$Estado1;
            $_SESSION['foto']=$Foto1;

            $_SESSION['error']=19;
            header("location:principal.php");
            return "Datos actualizados";
        }else{
            $_SESSION['error']=20;
            header("location:principal.php");
            return "Datos NO actualizados";   
        } 
        $sentencia->close();
        $conexion->close();    
    }
    function cambiarc($contrasena1,$contrasena2,$IDU){
        require "conexion.php";
        //$IDU=$_SESSION['id'];
        $sentencia=$conexion->prepare("SELECT * FROM `usuarios` WHERE `ID_USUARIO`=?");
        $sentencia->bind_param('i',$IDU);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        if ($fila = $resultado->fetch_assoc()) {
        $pass_db = $fila['CLAVE']; 
        if ($contrasena1 == $pass_db) {
            $sentencia=$conexion->prepare("UPDATE `usuarios` SET CLAVE=? WHERE `ID_USUARIO`=?");
            $sentencia->bind_param('si',$contrasena2,$IDU);
            $sentencia->execute();
            $resultado = $sentencia-> affected_rows;
            if ($resultado==1) {
                $_SESSION['error']=0;
                echo '<div class="alert alert-info">La contrseña se cambio correctamente</div> ';
                header("refresh:1; url= index.php");
                session_destroy();
            }else{
                $_SESSION['error']=24;
            }
        }else {
            $_SESSION['error']=24;
        }
        }else{
            $_SESSION['error']=24;
        }
        $sentencia->close();
        $conexion->close();    
    }
?>