<table border="1" width="100%" cellspacing="0">
	<tr>
		<td>
		<?php $data->displayRegions('menu'); ?>
		</td>
	</tr>
	<tr>
		<td>
		<table border="1" width="100%" cellspacing="0">
			<tr>
				<td width="25%"><?php $data->displayRegions('right'); ?></td>
				<td width="75%"><?php $data->displayRegions('content'); ?></td>
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
				<td>
					<?php $data->displayRegions('footerleft'); ?>
				</td>
				<td>
					<?php $data->displayRegions('footerright'); ?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>