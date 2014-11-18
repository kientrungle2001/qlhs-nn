<?php
require_once dirname(__FILE__) . '/Base.php';
class PzkOrderController extends PzkBaseController {
	public $grid = 'student_order';
	public function createAction() {
		$create_order = $this->getOperationStructure('create_order');
		$create_order->studentId = $_REQUEST['studentId'];
		$create_order->periodId = $_REQUEST['periodId'];
		if(isset($_REQUEST['multiple']) && $_REQUEST['multiple']) {
			$create_order->multiple = true;
			$create_order->classIds = $_REQUEST['classIds'];
			$create_order->amounts = $_REQUEST['amounts'];
			$create_order->discounts = $_REQUEST['discounts'];
			$create_order->musters = $_REQUEST['musters'];
			$create_order->prices = $_REQUEST['prices'];
			$create_order->discount_reasons = $_REQUEST['discount_reasons'];
		} else {
			$create_order->multiple = false;
			$create_order->classId = $_REQUEST['classId'];
			$create_order->amount = $_REQUEST['amount'];
		}
		$this->viewStructure($create_order);
	}
	
	public function detailAction() {
		$order_detail = $this->getOperationStructure('order_detail');
		$order_detail->orderId = $_REQUEST['id'];
		$xcssjs = '<html.js src="' . BASE_URL . '/xcss" />';
		$xcsscss = '<html.css src="' . BASE_URL . '/xcss/output/test.css" />';
		$order_detail->append(pzk_parse($xcssjs));
		$order_detail->append(pzk_parse($xcsscss));
		$order_detail->display();
	}
	
	public function billingdetailAction() {
		$order_detail = $this->getOperationStructure('bill_detail');
		$order_detail->orderId = $_REQUEST['id'];
		$xcssjs = '<html.js src="' . BASE_URL . '/xcss" />';
		$xcsscss = '<html.css src="' . BASE_URL . '/xcss/output/test.css" />';
		$order_detail->append(pzk_parse($xcssjs));
		$order_detail->append(pzk_parse($xcsscss));
		$order_detail->display();
	}
	
	public function postAction() {
		if($_REQUEST['bookNum'] && $_REQUEST['noNum']) {
			// do nothing
			$bookNum = $_REQUEST['bookNum'];
			$noNum = $_REQUEST['noNum'];
		} else {
			$bookNum = pzk_element('config')->get('bookNum', 1);
			$noNum = pzk_element('config')->get('noNum', 1);
		}
		$order = array(
			'orderType' => 'invoice',
			'type' => 'student',
			'amount' => $_REQUEST['amount'],
			'created' => date('Y-m-d', strtotime($_REQUEST['created'])),
			'createdTime' => time(),
			'bookNum' => $bookNum,
			'noNum' => $noNum,
			'debit' => $_REQUEST['debit'],
			'name' => $_REQUEST['name'],
			'phone' => $_REQUEST['phone'],
			'address' => $_REQUEST['address'],
			'reason' => $_REQUEST['reason'],
			'additional' => $_REQUEST['additional'],
			'invoiceNum' => $_REQUEST['invoiceNum']
		);
		$orderId = _db()->insert('general_order')
				->fields(implode(',', array_keys($order)))
				->values(array($order))->result();
		$classIds = explode(',', $_REQUEST['classIds']);
		$amounts = explode(',', $_REQUEST['amounts']);
		$discounts = explode(',', $_REQUEST['discounts']);
		$musters = explode(',', $_REQUEST['musters']);
		$prices = explode(',', $_REQUEST['prices']);
		$discount_reasons = explode(',', $_REQUEST['discount_reasons']);
		foreach($classIds as $index => $classId) {
		$student_order = array(
			'orderId' => $orderId,
			'classId' => $classId,
			'studentId' => $_REQUEST['studentId'],
			'payment_periodId' => $_REQUEST['payment_periodId'],
			'amount' => $amounts[$index],
			'discount' => $discounts[$index],
			'discount_reason' => $discount_reasons[$index],
			'muster' => $musters[$index],
			'price' => $prices[$index],
			'total_before_discount' => $musters[$index] * $prices[$index],
			'created' => date('Y-m-d', strtotime($_REQUEST['created'])),
			'createdTime' => time(),
			'bookNum' => $bookNum,
			'noNum' => $noNum,
			'debit' => $_REQUEST['debit'],
			'name' => $_REQUEST['name'],
			'address' => $_REQUEST['address'],
			'reason' => $_REQUEST['reason'],
			'additional' => $_REQUEST['additional'],
			'invoiceNum' => $_REQUEST['invoiceNum']
		);
		_db()->insert('student_order')->fields(implode(',',array_keys($student_order)))
			->values(array($student_order))->result();
		}
		if($_REQUEST['bookNum'] && $_REQUEST['noNum']) { 
			// do nothing
		} else {
			if($noNum >= 50) {
				pzk_element('config')->set('noNum', 1);
				pzk_element('config')->set('bookNum', $bookNum + 1);
			} else {
				pzk_element('config')->set('noNum', $noNum + 1);
				pzk_element('config')->set('bookNum', $bookNum);
			}
		}
		header('Location: '.BASE_URL.'/index.php/student/order');
	}
	
	public function billingAction() {
		$this->viewGrid('order_billing');
	}
	
	public function createbillAction() {
		$this->viewOperation('create_bill');
		//$create_order->display();
	}
	public function createbillpostAction() {
		$bookNum = $_REQUEST['bookNum'] = pzk_element('config')->get('bill_bookNum', 1);
		$noNum = $_REQUEST['noNum'] = pzk_element('config')->get('bill_noNum', 1);
		$order = array(
			'orderType' => 'billing',
			'type' => '',
			'amount' => $_REQUEST['total_amount'],
			'created' => date('Y-m-d', strtotime($_REQUEST['created'])),
			'createdTime' => time(),
			'bookNum' => $_REQUEST['bookNum'],
			'noNum' => $_REQUEST['noNum'],
			'debit' => $_REQUEST['debit'],
			'name' => $_REQUEST['order_name'],
			'address' => $_REQUEST['address'],
			'phone' => $_REQUEST['phone'],
			'reason' => $_REQUEST['reason'],
			'additional' => $_REQUEST['additional'],
			'invoiceNum' => $_REQUEST['invoiceNum']
		);
		$orderId = _db()->insert('billing_order')
				->fields(implode(',', array_keys($order)))
				->values(array($order))->result();
		$names = $_REQUEST['name'];
		$amounts = $_REQUEST['amount'];
		$total_before_discounts = $_REQUEST['total_before_discount'];
		$discounts = $_REQUEST['discount'];
		$prices = $_REQUEST['price'];
		$quantitys = $_REQUEST['quantity'];
		foreach($names as $index => $name) {
		$order_item = array(
			'orderId' => $orderId,
			'amount' => $amounts[$index],
			'discount' => $discounts[$index],
			'quantity' => $quantitys[$index],
			'price' => $prices[$index],
			'total_before_discount' => $total_before_discounts[$index],
			'created' => date('Y-m-d', strtotime($_REQUEST['created'])),
			'createdTime' => time(),
			'bookNum' => $_REQUEST['bookNum'],
			'noNum' => $_REQUEST['noNum'],
			'debit' => $_REQUEST['debit'],
			'name' => $names[$index],
			'address' => $_REQUEST['address'],
			'reason' => $_REQUEST['reason'],
			'additional' => $_REQUEST['additional'],
			'invoiceNum' => $_REQUEST['invoiceNum']
		);
		_db()->insert('billing_detail_order')->fields(implode(',',array_keys($order_item)))
			->values(array($order_item))->result();
		}
		if($noNum >= 50) {
			pzk_element('config')->set('bill_noNum', 1);
			pzk_element('config')->set('bill_bookNum', $bookNum + 1);
		} else {
			pzk_element('config')->set('bill_noNum', $noNum + 1);
			pzk_element('config')->set('bill_bookNum', $bookNum);
		}
		header('Location: '.BASE_URL.'/index.php/order/billing');
	}
	
	public function reportAction() {
		$page = pzk_parse($this->getApp()->getPageUri('demo'));
		pzk_store_element('left')->append(pzk_parse($this->getApp()->getPageUri('operation/order_report')));
		$page->display();
	}
	
	public function reportPostAction() {
		$reportType = 'order';
		$page = pzk_parse($this->getApp()->getPageUri('demo'));
		$left = pzk_store_element('left');
		$report = pzk_parse($this->getApp()->getPageUri('operation/order_report'));
		$left->append($report);
		$reportResult = pzk_parse($this->getApp()->getPageUri('report/' . $reportType));
		foreach(array('startDate', 'endDate') as $key) {
			$reportResult->$key = @$_REQUEST[$key];
			$elem = $report->findElement("[name=$key]");
			if($elem) {
				$elem->value = @$_REQUEST[$key];
			}
		}
		$left->append($reportResult);
		$page->display();
	}
}