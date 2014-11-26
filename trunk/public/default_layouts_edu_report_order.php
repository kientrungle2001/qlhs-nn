<?php
$orders = $data->getOrders();
$total = 0;
?>
<table class="order-table" border="1" style="border-collapse: collapse;">
	<tr>
		<th>Order ID</th>
		<th>Người nộp</th>
		<th>Số điện thoại</th>
		<th>Lý do</th>
		<th>Số tiền</th>
		<th>Ngày tạo</th>
		<th>Quyển</th>
		<th>Số</th>
	</tr>
<?php $totalByDate = 0; $totalToDate = 0; $orderdate = false; ?>
<?php foreach ( $orders as $order ) : ?>
<?php 
	if($orderdate != $order['created']) { ?>
	<?php if($orderdate != false) { ?>
		<tr style="background: white;">
			<td colspan="4">Cộng dồn ngày hôm trước <?php echo date('d/m/Y', strtotime($orderdate)); ?></td>
			<td colspan="1"><?php echo product_price($totalToDate); ?></td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr style="background: white;">
			<td colspan="4">Ngày <?php echo date('d/m/Y', strtotime($orderdate)); ?></td>
			<td colspan="1"><?php echo product_price($totalByDate); ?></td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr style="background: white;">
			<td colspan="4">Tổng đến ngày <?php echo date('d/m/Y', strtotime($orderdate)); ?></td>
			<td colspan="1"><?php echo product_price($totalByDate + $totalToDate); ?></td>
			<td colspan="3">&nbsp;</td>
		</tr>
	<?php } ?>
	
	<?php
		$orderdate = $order['created'];
		$totalToDate += $totalByDate;
		$totalByDate = 0;
	}
	$totalByDate += $order['amount'];
?>
	<tr>
	<td>#<?php echo @$order['id'];?></td>
	<td><?php echo @$order['name'];?></td>
	<td><?php echo @$order['phone'];?></td>
	<td><?php echo @$order['reason'];?></td>
	<td><?php echo product_price($order['amount']); $total += $order['amount']; ?></td>
	<td><?php echo date('d/m/Y', strtotime($order['created'])); ?></td>
	<td><?php echo @$order['bookNum'];?></td>
	<td><?php echo @$order['noNum'];?></td>
	</tr>
<?php endforeach; ?>
	<tr style="background: white;">
		<td colspan="4">Cộng dồn ngày hôm trước <?php echo date('d/m/Y', strtotime($orderdate)); ?></td>
		<td colspan="1"><?php echo product_price($totalToDate); ?></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr style="background: white;">
		<td colspan="4">Ngày <?php echo date('d/m/Y', strtotime($orderdate)); ?></td>
		<td colspan="1"><?php echo product_price($totalByDate); ?></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr style="background: white;">
		<td colspan="4">Tổng đến ngày <?php echo date('d/m/Y', strtotime($orderdate)); ?></td>
		<td colspan="1"><?php echo product_price($totalByDate + $totalToDate); ?></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th style="text-align: right;">Tổng: </th>
		<th><?php echo product_price($total) ?></th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
</table>
<style type="text/css">
	.order-table td {
		padding: 5px;
	}
</style>