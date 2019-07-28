<?php

function sha512_make($value) {
        for($i=0; $i<30; $i++){
            $rand = openssl_random_pseudo_bytes(16, $strong);
            if($strong){ break; }
        }
        $salt = substr(bin2hex($rand),0,16);
        return crypt($value, '$6$'.$salt);
    }

?>
