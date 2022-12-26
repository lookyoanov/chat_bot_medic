<?php
function include_template($name/*, $data*/) {
    $name = 'php/' . $name;
    $result = '';
 
    if (!file_exists($name)) {
        return $result;
    }
 
    ob_start();
    /*extract($data);*/
    require($name);
 
    $result = ob_get_clean();
 
    return $result;
}
function include_template2($name/*, $data*/) {
    $name = '../php/' . $name;
    $result = '';
 
    if (!file_exists($name)) {
        return $result;
    }
 
    ob_start();
    /*extract($data);*/
    require($name);
 
    $result = ob_get_clean();
 
    return $result;
}

?>