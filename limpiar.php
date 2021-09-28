<?php
    function LimpiarCadena($cadena)
    {
        $cadena = str_replace('<script>','',$cadena);
        $cadena = htmlspecialchars($cadena);
        return $cadena;
    }
?>