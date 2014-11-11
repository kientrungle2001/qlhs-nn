<table border="1" width="100%" cellspacing="0">
	<tr>
		<td>
		<?php $data->displayRegions('menu'); ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php $data->displayRegions('banner'); ?>
		</td>
	</tr>
	<tr>
		<td><?php $data->displayRegions('feature'); ?>
		<table width="100%" border="1" cellspacing="0">
			<tr>
				<td>
					<?php $data->displayRegions('feature1'); ?>
				</td>
				<td>
					<?php $data->displayRegions('feature2'); ?>
				</td>
				<td>
					<?php $data->displayRegions('feature3'); ?>
				</td>
				<td>
					<?php $data->displayRegions('feature4'); ?>
				</td>
			</tr>
		</table>
		</td>
		
	</tr>
	<tr>
		<td>
		<?php $data->displayRegions('marketing'); ?>
		<table border="1" width="100%" cellspacing="0">
			<tr>
				<td>
					<?php $data->displayRegions('marketingleft'); ?>
				</td>
				<td>
					<?php $data->displayRegions('marketingmiddle'); ?>
				</td>
				<td>
					<?php $data->displayRegions('marketingright'); ?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php $data->displayRegions('footer'); ?>
			<table border="1" width="100%" cellspacing="0">
			<tr>
				<td width="75%">
					<?php $data->displayRegions('footerleft'); ?>
				</td>
				<td width="25%">
					<?php $data->displayRegions('footerright'); ?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>