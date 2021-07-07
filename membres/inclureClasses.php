<?php

function inclureClasses($className){
    if(file_exists($ficher = __DIR__.'/'.$className.'.php')){
        require $ficher;
    }

}
spl_autoload_register('inclureClasses');