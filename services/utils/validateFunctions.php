<?php
    function validString($data, $length){
        $validStatus = NULL;
        if (!preg_match("/^[A-Za-z0-9 \-\"\'_!¡¿?#()áéíóúÁÉÍÓÚüÜ;.,:$]*$/",$data)) {
            $validStatus = "Recuerda que sólo aceptamos letras, números, espacios y los siguientes caracteres _-'\"!¡¿?#();.$,:";
        }
        if (strlen($data) > $length) {
            return "El contenido es demasiado largo";
        }
        return $validStatus;
    }

    function validPhone($data){
        $validStatus = NULL;
        if (!preg_match("/^[0-9]{10}$/",$data)) {
            $validStatus = "El número de teléfono sólo puede ser 10 dígitos";
        }
        return $validStatus;
    }

    function validEmail($data){
        $validStatus = NULL;
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $validStatus = "El formato del email es inválido";
        }
        if (strlen($data) > 256){
            $validStatus = "El email es demasiado largo";
        }
        return $validStatus;
    }
?>