<?php
function  otro($archivo){

  if (isset($archivo['name'])) {
      $fileTmpPath = $archivo['tmp_name'];
      $fileName = $archivo['name'];
      $fileSize = $archivo['size'];
      $fileType = $archivo['type'];
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));

      $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

      $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'docx', 'xlsx', 'pptx');
      if (in_array($fileExtension, $allowedfileExtensions)) {

          // directory in which the uploaded file will be moved
          $directorio = '../archivos/';
          if (!file_exists($directorio)) {
              mkdir($directorio, 0777);
          }

          $dir = opendir($directorio);
          $ruta = $directorio . '/' . $newFileName;

          if (move_uploaded_file($fileTmpPath, $ruta)) {
              //echo "El archivo $newFileName se ha almacenado correctamente";
              $allowedfileExtensions2 = array('jpg', 'gif', 'png', 'jpeg');
              if (in_array($fileExtension, $allowedfileExtensions2)){
                $img = imagecreatefromjpeg($ruta);
                imagejpeg($img, $ruta, 100);
                imagedestroy($img);
                //echo "Se destruyo: $img";
                return $newFileName;
              }else{
                return $newFileName;
              }
          } else {
            return 'No cargado';
          }
          closedir($dir);
      }else {
        return 'No cargado';
         // $_SESSION['error'] = 4;
      }
  } else {
      return 'No cargado';
  }
}
?>
