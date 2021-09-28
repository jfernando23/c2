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
        $sentencia=$conexion->prepare("INSERT INTO `usuarios` SET `NOMBRE`=?, `APELLIDO`=?, `FECHA`=?, `FOTO`=?, `CANTIDAD_HIJOS`=?, `COLOR`=?, `USUARIO`=?, `CLAVE`=?");
        $sentencia->bind_param('sssssissss',$Nombre,$Apellido,$Correo,$Direccion,$Hijos,$Ecivil,$Foto,$Usuario,$Contrasena);
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
            $_SESSION['apellido']=$fila['APELLIDO'];
            $_SESSION['fecha']=$fila['FECHA'];
            $_SESSION['foto']=$fila['FOTO'];
            $_SESSION['hijos']=$fila['CANTIDAD_HIJOS'];
            $_SESSION['color']=$fila['COLOR'];
            $_SESSION['usuario']=$fila['USUARIO'];
            $_SESSION['clave']=$fila['CLAVE'];
            header("location:index.html");
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
        
        $sentencia=$conexion->prepare("SELECT * FROM `tuits`");
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
    function cambiard($Nombre1,$Apellido1,$Fecha1,$Foto1,$Hijos1,$Color1){
        require "conexion.php";
        $IDU=$_SESSION['id'];
        $sentencia=$conexion->prepare("UPDATE `usuarios` SET `NOMBRE`=?, `APELLIDO`=?, `FECHA`=?, `FOTO`=?, `CANTIDAD_HIJOS`=?, `COLOR`=? WHERE `ID_USUARIO`=?");
        $sentencia->bind_param('ssssiss',$Nombre1,$Apellido1,$Fecha1,$Foto1,$Hijos1,$Color1,$IDU);
        $sentencia->execute();
        $resultado = $sentencia-> affected_rows;
        if ($resultado==1) {
            $_SESSION['nombre']=$Nombre1;
            $_SESSION['apellido']=$Apellido1;
            $_SESSION['fecha']=$Fecha1;
            $_SESSION['foto']=$Foto1;
            $_SESSION['hijos']=$Hijos1;
            $_SESSION['color']=$Color1;
            echo "<script>alert('Cambio realizado');
            window.location='index.php';
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
?>