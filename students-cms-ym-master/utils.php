<?php
require_once 'conf.php';

function get_file_paths($rep="bootstrap-5.0.1-dist"){
    /**
     * return an array containing all valide paths of $extension 
     * adapted to bootstrap-5.0.1-dist where there are 2 sub-folders
     */

    $BASE = get_base();

    // assert it's a folder
    assert(is_dir($BASE.$rep), true);

    // get the sub folders : css and js
    $subf = array_diff(scandir($BASE.$rep), array('.', '..')); 
    
    assert(array_count_values($subf) != 0);

    $css_paths = array_diff(scandir($BASE.$rep.'\\'.$subf[2]), array('.', '..'));
    $js_paths = array_diff(scandir($BASE.$rep.'\\'.$subf[3]), array('.', '..'));

    return array($css_paths, $js_paths);
}

    function verifier_date($day,$month,$year,$date){
    
    if(!checkdate($month, $day, $year)){
        echo ( $date.' nest pas une date validee!');
        $date= NULL;
    }}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

function afficher($t){
    echo "<pre>";
    print_r($t);
    echo "</pre>";
}



function ends_with( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}