<?php 

function getNav() {
    $file = __DIR__.'/nav.json';
    $data = json_decode(file_get_contents($file),true);
    return $data;
}
function saveNav($menu) {
    //$json = json_encode($menu);

    $json = $menu;

    $file = __DIR__.'/nav.json';

    // read json source
    $handle = fopen($file, 'wb') or die('no fopen');

    //save data as json
    fwrite($handle, $json);
    fclose($handle);
    return 'saved';
}

 ?>         