<?php
class PzkAdminHistorypaymentController extends PzkGridAdminController {
	public $addFields = 'username, typepayment, amount, datepayment,transactionid,transactionstatus,optionpayment';
	public $editFields = 'username, typepayment, amount, datepayment,transactionid,transactionstatus,optionpayment';
	public $table='history_payment';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'datepayment asc' => 'Ngày thanh toán tăng',
		'datepayment desc' => 'Ngày thanh toán giảm'
	);
	public $searchFields = array('username');
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'optionpayment',
			'type' => 'text',
			'label' => 'Hình thức thanh toán'
		),
		array(
			'index' => 'typepayment',
			'type' => 'text',
			'label' => 'Loại thanh toán'
		),
		array(
			'index' => 'transactionid',
			'type' => 'text',
			'label' => 'Mã giao dịch'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Số tiền thanh toán'
		),
		array(
			'index' => 'datepayment',
			'type' => 'text',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'transactionstatus',
			'type' => 'text',
			'label' => 'Trạng thái',
			
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
		),
	);
	public $addLabel = 'Thêm giao dịch';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'typepayment',
			'type' => 'text',
			'label' => 'Loại thanh toán'
			
		),
		array(
			'index' => 'transactionid',
			'type' => 'text',
			'label' => 'Mã giao dịch'
			
		),
		array(
			'index' => 'optionpayment',
			'type' => 'text',
			'label' => 'Hình thức thanh toán'
			
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Số tiền'
		),
		array(
			'index' => 'transactionstatus',
			'type' => 'text',
			'label' => 'Trạng thái'
			
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'typepayment',
			'type' => 'text',
			'label' => 'Loại thanh toán'
			
		),
		array(
			'index' => 'transactionid',
			'type' => 'text',
			'label' => 'Mã giao dịch'
			
		),
		array(
			'index' => 'optionpayment',
			'type' => 'text',
			'label' => 'Hình thức thanh toán'
			
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Số tiền'
		),
		array(
			'index' => 'transactionstatus',
			'type' => 'text',
			'label' => 'Trạng thái'
			
		)
	);
	public $addValidator = array(
		'rules' => array(
			'optionpayment' => array(
				'required' => true
			),
			'username' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			),
			'amount' => array(
				'required' => true
				
			)
		),
		'messages' => array(
			'optionpayment' => array(
				'required' => 'Phải nhập thức thanh toán'
				
			),
			'username' => array(
				'required' => 'Tên đăng nhập không được để trống',
				'minlength' => 'Tên đăng nhập phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên đăng nhập chỉ dài tối đa 50 ký tự'
			),
			'amount' => array(
				'required' => 'Nhập số tiền thanh toán'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'optionpayment' => array(
				'required' => true
			),
			'username' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			),
			'amount' => array(
				'required' => true
				
			)
		),
		'messages' => array(
			'optionpayment' => array(
				'required' => 'Phải nhập thức thanh toán'
				
			),
			'username' => array(
				'required' => 'Tên đăng nhập không được để trống',
				'minlength' => 'Tên đăng nhập phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên đăng nhập chỉ dài tối đa 50 ký tự'
			),
			'amount' => array(
				'required' => 'Nhập số tiền thanh toán'
				
			)
		)
	);
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
           //	$row['userId']=pzk_request('userId');
        	//$row['serviceId']=pzk_request('serviceId');
            $row['userAdd']=pzk_session('adminId');
            $row['dateAdd']=date("Y-m-d H:i:s");
            $this->add($row);
            $wallets=_db()->getEntity('user.account.wallets');
            $wallets->loadWhere(array('username',$row['username']));
            if($wallets->getId()){
            	$price=$wallets->getAmount();
            	if($price==Null){
            		$price=0;
            	}
            	$price= $price+ (double)pzk_request('amount');

            	$wallets->update(array('amount'=>$price));
            }else{
            	$price= (double)pzk_request('amount');
            	$rowwallets=array('username'=>pzk_request('username'),'amount'=>pzk_request('amount'));
            	$wallets->setData($rowwallets);
            	$wallets->save();
            }
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

    public function editPostAction() {
    	$id= pzk_request('id');
    	$check=_db()->getEntity('payment.history_payment');
    	$check->loadWhere(array('id',$id));
    	$amountold= $check->getAmount();
        $row = $this->getEditData();
       	$amountnew= $row['amount'];
       	$username= $row['username'];
        if($this->validateEditData($row)) {
          	//cập nhật bảng wallets
          	$wallets= _db()->getEntity('user.account.wallets');
          	
          	$wallets->loadWhere(array('username',$username));
          	$walletsAmount= $wallets->getAmount();

          	$walletsAmount= $walletsAmount - $amountold + (double)$amountnew;
          	$wallets->update(array('amount'=>$walletsAmount));

            $row['userModified']=pzk_session('adminId');
            $row['dateModified']=date("Y-m-d H:i:s");
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
}