<?php
    function crearusu($Nombre,$Apellido,$Correo,$Direccion,$Hijos,$Ecivil,$Foto,$Usuario,$Contrasena){
        require "conexion.php";
        $sentencia=$conexion->prepare("SELECT * FROM `usuarios` WHERE USUARIO = ?");
        $sentencia->bind_param('s',$Usuario);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        if( $resultado>=1){
        echo "<script>alert('Usuario ya se encuentra registrado');
        window.location='registro.php';
        </script>";
        }
        else{
        $sentencia=$conexion->prepare("INSERT INTO `usuarios` SET `NOMBRE`=?, `APELLIDO`=?, `CORREO`=?, `DIRECCION`=?, `HIJOS`=?, `ESTADO`=?, `FOTO`=?, `USUARIO`=?, `CLAVE`=?");
        $sentencia->bind_param('ssssissss',$Nombre,$Apellido,$Correo,$Direccion,$Hijos,$Ecivil,$Foto,$Usuario,$Contrasena);
        $sentencia->execute();
        $resultado = $sentencia-> affected_rows;
        if ($resultado==1) {
            echo "<script>alert('Usuario creado');
            window.location='index.php';
            </script>";
        }else{
            echo "<script>alert('Errror al crear usuario');
            </script>";
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
        }else {
            echo "<script>alert('Contraseña incorrecta');
            </script>";
        }
        }else{
        echo "<script>alert('Usuario no existe');
        </script>";
        }
        $sentencia->close();
        $conexion->close();
    }
    function tuit($id,$tuit){
        require "conexion.php";
        
        $sentencia=$conexion->prepare("INSERT INTO `tuits` SET `ID_USUARIO`=?, `TUIT`=?");
        $sentencia->bind_param('is',$id,$tuit);
        $sentencia->execute();
        $sentencia->close();
        $conexion->close();
    }

    function mostrar(){
        require "conexion.php";
        
        $sentencia=$conexion->prepare("SELECT U.NOMBRE, U.FOTO, T.TUIT, T.FECHA FROM tuits AS T INNER JOIN usuarios U ON U.ID_USUARIO = T.ID_USUARIO WHERE T.PUBLICO = 'Sí' ORDER BY T.FECHA DESC");
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
        }else {
            echo "<script>alert('No se puede eliminar');
            </script>";
        }
        }else{
        echo "<script>alert('No existe el tuit');
        </script>";
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
        }else {
            echo "<script>alert('No se puede eliminar');
            </script>";
        }
        }else{
        echo "<script>alert('No existe el tuit');
        </script>";
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
        }else {
            echo "<script>alert('No se puede eliminar');
            </script>";
        }
        }else{
        echo "<script>alert('No existe el tuit');
        </script>";
        }  
    }
    function cambiard($Nombre1,$Apellido1,$Correo1,$Direccion1,$Hijos1,$Estado1,$Foto1){
        require "conexion.php";
        $IDU=$_SESSION['id'];
        echo $IDU;
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
            echo "<script>alert('Cambio realizado');
            window.location='principal.php';
            </script>";
        }else{
            echo "<script>alert('No se pudo realizar el cambio');
            </script>";
        }
        
        $sentencia->close();
        $conexion->close();    
    }
    function cambiarc($contrasena1,$contrasena2){
        require "conexion.php";
        $IDU=$_SESSION['id'];
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
                session_destroy();
                echo "<script>alert('Cambio realizado');
                window.location='login.php';
                </script>";
            }else{
                echo "<script>alert('No se pudo realizar el cambio');
                </script>";
            }
            
        }else {
            echo "<script>alert('La contraseña no coincide');
            </script>";
        }
        }else{
        echo "<script>alert('Usuario no existe');
        </script>";
        }
        $sentencia->close();
        $conexion->close();    
    }
