<?php
class PzkAdminModController extends PzkGridAdminController {
    public $table = 'admin';
    //joins to many table
    public $joins = array(
        array(
            'table' => 'admin_level',
            'condition' => 'admin.usertype_id = admin_level.id',
            'type' =>''
        )
    );
    //select table
    public $selectFields = 'admin.*, admin_level.level';
    //show fields on page index
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên User'
        ),
        array(
            'index' => 'level',
            'type' => 'text',
            'label' => 'Tên quyền'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    //search fields co type la text
    public $searchFields = array('name');
    public $Searchlabels = 'Tên';
    //filter cho cac truong co type la select
    public $filterFields = array(

        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

    //add table
    public $addFields = 'name, usertype_id, password, status';
    public $addLabel = 'Thêm user';

    //add theo dang binh thuong
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên người dùng'
        ),
        array(
            'index' => 'password',
            'type' => 'password',
            'label' => 'Password'
        ),
        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            ),
            'password' =>
                array(
                    'minlength' => 4,
                )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            'password' =>
                array(
                    'minlength' => 'Mật khẩu dài tối thiểu 4 ký tự',
                )

        )
    );

    //edit table
    public $editFields = 'name, usertype_id, password, status';

    //edit theo dang binh thuong
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên người dùng'
        ),
        array(
            'index' => 'password',
            'type' => 'password',
            'label' => 'Password'
        ),
        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );

    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            ),
            'password' =>
                array(
                    'minlength' => 4,
                )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            'password' =>
                array(
                    'minlength' => 'Mật khẩu dài tối thiểu 4 ký tự',
                )

        )
    );
    //add link menu
    //add menu links
    public $menuLinks = array(
        array(
            'name' => 'Import',
            'href' => '/admin_mod/import'
        ),

    );
    //export data
    public $exportFields = array('admin.id', 'admin.name', 'admin_level.level');
    public $exportTypes = array('pdf', 'excel', 'csv');
    //import
    public $importFields = array('level', 'username');
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
            $password = trim(pzk_request('password'));
            if($password) {
                $row['password'] = md5($password);
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            }
            else {
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $password = trim(pzk_request('password'));
            if($password) {
                $row['password'] = md5($password);

                $this->add($row);

                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            } else {
                pzk_validator()->setEditingData($row);
                $this->redirect('add');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }
	
	public function importPostAction() {
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

		$controller = pzk_controller();

		if ($token == md5( $time . $username . 'onghuu' ) ) {
			$importFields = $_POST['importFields'];

			$allowed = array('csv','xlsx','xls');
			$dir = BASE_DIR."/tmp/";

			if(!empty($_FILES['file']['name'])){
				$fileParts = pathinfo($_FILES['file']['name']);
				// Kiem tra xem file upload co nam trong dinh dang cho phep
				if(in_array($fileParts['extension'], $allowed)) {
					// Neu co trong dinh dang cho phep, tach lay phan mo rong
					$tam = explode('.', $_FILES['file']['name']);
					$ext = end($tam);
					$renamed = md5(rand(0,200000)).'.'."$ext";

					move_uploaded_file($_FILES['file']['tmp_name'], $dir.$renamed);
				} else {
					// FIle upload khong thuoc dinh dang cho phep
				   die("File upload không thuộc định dạng cho phép!");
				}
			}


			// Xoa file da duoc upload va ton tai trong thu muc tam
			//if(isset($_FILES[$filename]['tmp_name']) && is_file($_FILES[$filename]['tmp_name']) && file_exists($_FILES[$filename]['tmp_name'])) {
			   // unlink($_FILES[$filename]['tmp_name']);
			//}
			//$path = __DIR__."/tmp/test.xls";
			$path = $dir.$renamed;
			if(!file_exists($path)) {
				die('file not exist');
			}

			require_once BASE_DIR . '/3rdparty/phpexcel/PHPExcel.php';

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

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

		//  Loop through each row of the worksheet in turn
			for ($row = 1; $row <= $highestRow; $row++){
				//  Read a row of data into an array
				$rowData = $sheet->toArray('A' . $row . ':' . $highestColumn . $row,
					NULL,
					TRUE,
					FALSE);

			}
			$bang = mysqli_real_escape_string($dbc, $_POST['table']);
			$cols = mysqli_real_escape_string($dbc, $importFields);
			$list = '';
			unset($rowData[0]);
			if(!empty($rowData)) {
				foreach($rowData as $item) {
					for($i=0; $i < count($item); $i++) {
						$list .= ','."'".mysqli_real_escape_string($dbc,$item[$i])."'";
					}
					$list = substr($list,1);
					$sql = "INSERT INTO test($cols)  VALUES ($list)";
					mysqli_query($dbc, $sql);
					$list ='';
				}
			}


			if(file_exists($path)) {
				unlink($path);
			}
			$url ="/admin_".$_POST['module']."/index";
			pzk_notifier_add_message('Import thành công!', 'success');
			header("location: $url");
			exit;
		}
	}
}