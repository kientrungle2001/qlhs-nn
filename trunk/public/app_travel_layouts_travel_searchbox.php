<?php
$departures = pzk_data('departures');
$destinations = pzk_data('destinations');
$durations = pzk_data('durations');
?>
<div class="search-box my-box">
	<form role="form">
	  <div class="form-group">
		<label for="inbound">Trong nước</label>
		<input type="radio" name="bound" id="inbound" value="inbound" />
		<label for="outbound">Nước ngoài</label>
		<input type="radio" name="bound" id="outbound" value="outbound" />
	  </div>
	  <div class="form-group">
		<select class="form-control" name="departure" onchange="showDestinations(this.value)">
			<option value="">Nơi khởi hành</option>
			<?php foreach ( $departures as $departure ) : ?>
			<option value="<?php echo @$departure['id'];?>"><?php echo @$departure['title'];?></option>
			<?php endforeach; ?>
		</select>
	  </div>
	  <div class="form-group">
		<select class="form-control" name="destination">
			<option value="">Nơi đến</option>
			<?php foreach ( $destinations as $destination ) : ?>
			<option value="<?php echo @$destination['id'];?>" class="destination destination<?php echo @$destination['departureId'];?>"><?php echo @$destination['title'];?></option>
			<?php endforeach; ?>
		</select>
	  </div>
	  <div class="form-group">
		<select class="form-control" name="duration">
			<option value="">Thời gian</option>
			<?php foreach ( $durations as $duration ) : ?>
			<option value="<?php echo @$duration['id'];?>"><?php echo @$duration['title'];?></option>
			<?php endforeach; ?>
		</select>
	  </div>
	  <button type="submit" class="btn btn-default">Tìm kiếm</button>
	</form>
</div>
<script type="text/javascript">
function showDestinations(departureId) {
	$('option.destination').hide();
	if(departureId)
		$('option.destination'+departureId).show();
}
showDestinations('');
</script>