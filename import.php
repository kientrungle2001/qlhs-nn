<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
require_once 'config.php';
require_once 'include.php';

$sys = pzk_parse('system/full');

$app = $sys->getApp();

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
$username = pzk_session('adminUser');
if(isset($username)) {
    $username = pzk_session('adminUser');
}else {
    die();
}



if ($token == md5( $time . $username . 'onghuu' ) ) {

    if(isset($_FILES[$filename])) {
        if(!empty($_FILES[$filename]['name'])){
            // Kiem tra xem file upload co nam trong dinh dang cho phep
            if(in_array(strtolower($_FILES[$filename]['type']), $allowed)) {
                // Neu co trong dinh dang cho phep, tach lay phan mo rong
                $ext = end(explode('.', $_FILES[$filename]['name']));
                $renamed = md5(rand(0,200000)).'.'."$ext";

                move_uploaded_file($_FILES[$filename]['tmp_name'], $dir.$renamed);

            } else {
                // FIle upload khong thuoc dinh dang cho phep
                $errors = "File upload không thuộc định dạng cho phép!";
                $this->redirect('index');
            }
        }

    }

    // Xoa file da duoc upload va ton tai trong thu muc tam
    if(isset($_FILES[$filename]['tmp_name']) && is_file($_FILES[$filename]['tmp_name']) && file_exists($_FILES[$filename]['tmp_name'])) {
        unlink($_FILES[$filename]['tmp_name']);
    }
    //$path = __DIR__."/tmp/test.xls";
    if(!file_exists($path)) {
        die();
    }

    require_once __DIR__ . '/3rdparty/phpexcel/PHPExcel.php';

    $host = _db()->host;
    $user = _db()->user;
    $password = _db()->password;
    $db = _db()->dbName;
    //connect database
    $dbc = mysqli_connect($host, $user,$password,$db);

    if(!$dbc) {
        trigger_error("Could not connect to DB: " . mysqli_connect_error());
    } else {
        mysqli_set_charset($dbc, 'utf-8');
    }

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