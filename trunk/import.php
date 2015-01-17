<?php
session_start();
if(isset($_GET['token'])){
    $token = $_GET['token'];
}else {
    die();
}
if(isset($_GET['time'])){
    $time = $_GET['time'];
}else{
    die();
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}else {
    $username = 'ongkien';
}



if (1 or $token == md5( $time . $username . 'onghuu' ) ) {
    require_once __DIR__ . '/3rdparty/phpexcel/PHPExcel.php';

    $dbc = mysqli_connect('localhost', 'root','','ptnn');
    if(!$dbc) {
        trigger_error("Could not connect to DB: " . mysqli_connect_error());
    } else {
        mysqli_set_charset($dbc, 'utf-8');
    }
    $path = __DIR__."/tmp/test.xls";


    $objPHPExcel = PHPExcel_IOFactory::load($path);
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
        $worksheetTitle     = $worksheet->getTitle();
        $highestRow         = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;

    }

    for ($row = 2; $row <= $highestRow; ++ $row) {
        $val=array();
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val[] = $cell->getValue();
        }
        $sql="INSERT INTO test(level, username)
        VALUES ('".$val[0] . "','" . $val[1] . "')";
        mysqli_query($dbc, $sql);
    }
}
?>