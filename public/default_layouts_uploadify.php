<img id="<?php echo @$data->id;?>_image" src="<?php if(@$data->value) { echo createThumb(@$data->value, 80, 80);}?>" height="80px" width="auto"/>
<input id="<?php echo @$data->id;?>" name="<?php echo @$data->name;?>" value="<?php echo @$data->value;?>" type="hidden" />
<input id="<?php echo @$data->id;?>_uploadify" type="file" />