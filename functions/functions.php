<?php
const USERNAME = 'adatb'; const PASSWORD = 'adatb'; const CONNECTION_STRING = 'localhost/XE';
/**
 * Csatlakozásért felelős függvény
 */
function connection($username, $password, $connection_string) {
    $conn = oci_connect($username, $password, $connection_string);
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    return $conn;
}

/**
 * Lekérdezésért felelős függvény:
 */
function select($conn, $select) {
    $stid = oci_parse($conn, $select);
    if (!$stid) {
        $e = oci_error($conn);
        $e = trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $r = oci_execute($stid);
    if (!$r) {
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    return $stid;
}

/**
 * Csatlakozás és lekérdezés végrehajtásáért felelős függvény:
 */
function lekerdez($select){
    $conn = connection(USERNAME, PASSWORD, CONNECTION_STRING);
    $stid = select($conn, $select);
    return [$stid, $conn]; //a kapcsolat lezárása miatt vissza kell adni a $conn változót is
}


/**
 * Csatlakozás és adatmódostásért végrehajtásáért felelős függvény:
 */
function excecute($mod){
    $conn = connection(USERNAME, PASSWORD, CONNECTION_STRING);
    $stid = oci_parse($conn, $mod);


    oci_execute($stid);
    oci_commit($conn);

    oci_free_statement($stid);
    oci_close($conn);
}

/**
 * Kapcsolat lezárása
 */
function close ($stid, $conn){
    oci_free_statement($stid);
    oci_close($conn);
}

/**
 * Számokat napokká varáuzsolja
*/
function getday($nap) {
    switch ($nap) {
        case 1: return "hétfő";
        case 2: return "kedd";
        case 3: return "szerda";
        case 4: return "csütörtök";
        case 5: return "péntek";
        default: return "hétvége";
    }
}

/**
 * Csúnya dátumokból szép dátumok
*/

function sajat_date($date){
    $return_date = '';
    $month = array(
        "DEC" => "December", "JAN" => "Január", "FEB" => "Február",
        "MAR" => "Március", "APR" => "Április", "MAY" => "Május",
        "JUN" => "Június", "JUL" => "Július", "AUG" => "Augusztus",
        "SEP" => "Szeptember", "OCT" => "Október", "NOV" => "November",
    );
    $pieces = explode('-',$date); // $pieces[0] == day, $pieces[1] == month, pieces[2] == year
    $return_date .= '20'.$pieces[2];
    foreach ($month as $m_key => $m_value ){
        if( $m_key == $pieces[1] ){
            $return_date .='. '.$m_value;
        }
    }
    $return_date .=' '.$pieces[0].'.';

    return $return_date;
}




