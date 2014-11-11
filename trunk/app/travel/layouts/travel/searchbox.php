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
			{each $departures as $departure}
			<option value="{departure[id]}">{departure[title]}</option>
			{/each}
		</select>
	  </div>
	  <div class="form-group">
		<select class="form-control" name="destination">
			<option value="">Nơi đến</option>
			{each $destinations as $destination}
			<option value="{destination[id]}" class="destination destination{destination[departureId]}">{destination[title]}</option>
			{/each}
		</select>
	  </div>
	  <div class="form-group">
		<select class="form-control" name="duration">
			<option value="">Thời gian</option>
			{each $durations as $duration}
			<option value="{duration[id]}">{duration[title]}</option>
			{/each}
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