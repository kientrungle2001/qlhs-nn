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



if ($token == md5( $time . $username . 'onghuu' ) ) {
    require_once __DIR__ . '/3rdparty/phpexcel/PHPExcel.php';

    $dbc = mysqli_connect('localhost', 'root','','ptnn');
    if(!$dbc) {
        trigger_error("Could not connect to DB: " . mysqli_connect_error());
    } else {
        mysqli_set_charset($dbc, 'utf-8');
    }

    $q = "SELECT usertype_id,name FROM admin";


    $headings = array('usertype_id', 'Name');

    if ( $result = mysqli_query($dbc,$q) or die(mysql_error())) {
        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('List of Users');

        $rowNumber = 1;
        $col = 'A';
        foreach($headings as $heading) {
            $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading);
            $col++;
        }

        // Loop through the result set
        $rowNumber = 2;
        while ($row = mysqli_fetch_row($result)) {
            $col = 'A';
            foreach($row as $cell) {
                $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell);
                $col++;
            }
            $rowNumber++;
        }

        // Freeze pane so that the heading line won't scroll
        $objPHPExcel->getActiveSheet()->freezePane('A2');

        // Save as an Excel BIFF (xls) file
        //excel 2007
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);//Excel5,PDF
        //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment;filename="userList.xlsx"');
        //excel 2003
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel5,PDF
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="userList.xls"');
        header('Cache-Control: max-age=0');
        if($objWriter) {
            $objWriter->save('php://output');
        }
        exit();
    }else{
    die();
    }
}
?>