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
        echo "<br>The worksheet ".$worksheetTitle." has ";
        echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
        echo ' and ' . $highestRow . ' row.';
        echo '<br>Data: <table border="1"><tr>';
        for ($row = 1; $row <= $highestRow; ++ $row) {
            echo '<tr>';
            for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    for ($row = 2; $row <= $highestRow; ++ $row) {
        $val=array();
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val[] = $cell->getValue();
        }

        $sql="INSERT INTO admin(name, age, home)
        VALUES ('".$val[1] . "','" . $val[2] . "','" . $val[3]. "')";
        echo $sql."\n";
        mysql_query($sql);
    }
}
?>