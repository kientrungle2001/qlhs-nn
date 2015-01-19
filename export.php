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

    $type = $_POST['type'];

    require_once __DIR__ . '/3rdparty/phpexcel/PHPExcel.php';
    $objPHPExcel = new PHPExcel();
    $currenttime = date("m-d-Y");
    //connect database
    $dbc = mysqli_connect('localhost', 'root','','ptnn');
    if(!$dbc) {
        trigger_error("Could not connect to DB: " . mysqli_connect_error());
    } else {
        mysqli_set_charset($dbc, 'utf-8');
    }

    $fields = $_POST['exportFields'];
    $headings = explode(',', $fields);
    $arrJoin = array();
    foreach($headings as $field) {
        $tam = explode('.', $field);
        if($tam[1]) {
            $arrJoin[] = $tam[1];
        }
    }
    if(!empty($arrJoin)) {
        $headings = $arrJoin;
    }
    //query
    $q = substr(base64_decode($_POST['q']),0,-6);
    /*$result = mysqli_query($dbc,$q);
    $finfo = mysqli_fetch_fields($result);
    $arrtitle = array();
    foreach($finfo as $val) {
        $arrtitle[] = $val->name;
    }
    echo '<pre>'; var_dump($arrtitle);
    die();*/
    $result = mysqli_query($dbc,$q);

    if($result){
        die();
    }

    if($type == 'pdf') {
        //require library 3rdparty(dmopdf, mpdf, tcpdf)
        $rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
        $rendererLibrary = 'dompdf';
        $rendererLibraryPath = dirname(__FILE__).'/3rdparty/' . $rendererLibrary;
        if (!PHPExcel_Settings::setPdfRenderer(
            $rendererName,
            $rendererLibraryPath
        )) {
            die(
                'not work'
            );
        }

        if ( $result = mysqli_query($dbc,$q) or die(mysql_error())) {
            // Create a new PHPExcel object
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle('Data');

            $rowNumber = 1;
            $col = 'A';
            foreach($headings as $heading) {
                //set value col in file excel
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
        }

        //http headers, redirect output to client browers
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="table.pdf"');
        header('Cache-Control: max-age=0');
        // writer data excel to pdf
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
        $objWriter->save('php://output');
            exit();
    }
    elseif($type == 'csv' ) {
        $result = mysqli_query($dbc, $q);

        if ($result = mysqli_query($dbc, $q) or die(mysql_error())) {
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle('CYImport'.$currenttime.'');

            $rowNumber = 1;

            $objPHPExcel->getActiveSheet()->fromArray(array($headings),NULL,'A'.$rowNumber);
            $rowNumber++;
            while ($row = mysqli_fetch_row($result)) {
                $col = 'A';
                foreach($row as $cell) {
                    $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell);
                    $col++;
                }
                $rowNumber++;
            }


            $objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
            $objWriter->setDelimiter(',');
            $objWriter->setEnclosure('');
            $objWriter->setLineEnding("\r\n");
            $objWriter->setSheetIndex(0);



            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Import'.$currenttime.'".csv"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');
            exit();
    }elseif($type == 'excel') {

            $result = mysqli_query($dbc, $q);

            if ($result or die(mysql_error())) {
                // Create a new PHPExcel object
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->getActiveSheet()->setTitle('List of Users');

                $rowNumber = 1;
                $col = 'A';
                foreach($headings as $heading) {
                    //set value col in file excel
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
        }

        }
    }

}
?>