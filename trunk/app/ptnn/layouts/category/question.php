<link rel="stylesheet" href="/default/skin/ptnn/css/question/fill.css">
<?php
    $parent_id = pzk_request()->getSegment(3);
if(pzk_request()->is('POST') && is_numeric($parent_id)) {
    $request = pzk_request()->query;
    $ids = $request['id_category'];
    if(isset($request['subject'])) {
        $topic = $request['subject'];
    } else {
        $topic = false;
    }
    $items = $data->getQuestionByIds($ids, $topic, $request['level'], $request['number']);
?>
    <div class="item">
<?php if(count($items) > 0) { ?>
    <form id="dm"  action="/category/answer" method="post">
        <div class="col-md-6">
            <label for="">Chọn dạng</label>
            <?php
            echo $data->getNameById($parent_id, 'categories', 'name');
            ?>
            <input type="hidden" name="parent_id" value="<?Php echo $parent_id; ?>"/>
        </div>
        <?php if(!empty($request['subject'])) { ?>
        <div class="col-md-6">
            <label for="">Chủ đề</label>
            <?php
            echo $data->getNameById($request['subject'], 'topics', 'name');
            ?>
            <input type="hidden" name="subject" value="<?php echo $topic; ?>"/>
        </div>
        <?php } ?>

        <br>

        <table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Số câu</th>
                <th>Thời gian làm bài</th>
                <th>Mức độ</th>
                <th>Thời gian bắt đầu làm</th>

            </tr>
            <tr>
                <th>
                    <?php echo $request['number']; ?>
                    <input type="hidden" name="number" value="<?php echo $request['number']; ?>"/>
                </th>
                <th>
                     <div class="ms_timer"></div>
                     <div class="stop_timer"></div>

                </th>
                <th>
                    <?php
                    switch ($request['level']) {
                        case 1:
                            echo "Dễ";
                            break;
                        case 2:
                            echo "Bình thường";
                            break;
                        case 3:
                            echo "Khó";
                            break;
                    }
                    ?>
                    <input type="hidden" name="level" value="<?php echo $request['level']; ?>"/>
                </th>
                <th>

                    <?php echo date('H:i:s', time()); ?>
                    <input type="hidden" name="start_time" value="<?php echo date('H:i:s', time()); ?>"/>
                </th>
            </tr>
            </thead>
        </table>
        <?php
        //dang dung tu linh hoat
        if($items[0]['type'] == 'Q0'){  ?>
        <table class="table">
            <?php $i = 1; ?>
            {each $items as $item}
            <?php

                $answers = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['id']))->result();
                ?>
                <tr>
                    <td><?php echo 'Câu '.$i.':'; ?></td>
                    <td>{item[name]}
                    </td>
                </tr>
                {each $answers as $val}
                <tr>
                        <td><input style="width: 15px; height: 15px;" name="answers[<?=$item['id'];?>][]" value="{val[id]}" type="radio" /></td>
                    <td>{val[content]}</td>
                </tr>
                {/each}


            <?php $i++; ?>
            {/each}


        </table>

        <div class="item center">
            <input  id="answer" type="submit" name="done" value="Hoàn thành">
        </div>
        <input id="mi" name="mi" type="hidden" value=""/>
        <input id="se" name="se" type="hidden" value=""/>

        <!--dang phat trien chu diem-->
        <?php } elseif($items[0]['type'] == 'Q2') { ?>

        <div  id="ctg_question_fill">
        <?php $i = 1; ?>
            {each $items as $item}
            <?php $answers = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['id']))->result();
            ?>

            <div class="step">
                <span><strong>Yêu Cầu:</strong> {item[request]}</span>

            </div>
            <div class="step">
                <span><strong> Câu {i}:</strong> {item[name]}</span>
            </div>
            <div class="step" >
                <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                <div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
                    <div class="input-group" >
                        <input type="text" name="answers[<?=$item['id'];?>][]" class="form-control content_value"/>
                    </div>
                    <div class="remove-input" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
                </div>
                <div class="add_row_answer">
                    <div class="itemAnswer_<?=$item['id'];?>"  ></div>
                </div>
                <div class="btt_add_answer"><button type="button" class="btn btn-primary add-sub-input-test" onclick="addInputRow(<?=$item['id'];?>)" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Thêm đáp án</button></div>
            </div>

        <?php $i++; ?>
            {/each}
            <script>
                function addInputRow(key){

                    var div = document.createElement('div');

                    div.className = 'col-xs-3 margin-top-10 element-input';

                    div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answers['+key+'][]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

                    $('.itemAnswer_'+key).append(div);
                }

                $("#ctg_question_fill").on("click", '.remove-input', function(e){
                    $(this).parent().remove();
                });
            </script>
        </div>
            <div class="item center">
                <input onclick="hoanthanh();" id="answer" type="button" name="done" value="Hoàn thành">
            </div>
        <?php } ?>
    </form>

        <script>

            function hoanthanh() {
                var time = $(".ms_timer").text();
                $('.stop_timer').text(time);
               $('.ms_timer').remove();
                $('input[type=text]').prop( "disabled", true );

                $('.remove-input').hide();
                $('.btt_add_answer').hide();
                var formdata = $('#dm').serializeForm();
                //console.log(formdata['answers']);
                for(var key in formdata['answers']) {
                    var value = formdata['answers'][key];
                    for(var key2 in value) {
                        var value2 = value[key2];
                        console.log(value2);
                    }
                }
                $.ajax( {
                    type: "POST",
                    url: '/category/ajax',
                    data: formdata,
                    success: function( response ) {
                        $('input[type=radio]').prop( "disabled", true );

                    }
                } );

            }

            function submitform() {
                $('#dm').submit();
            }
            $(function(){
                $('.ms_timer').countdowntimer({
                    minutes :<?php echo $request['time']; ?>,
                    seconds : 0,
                    size : "lg",
                    timeUp : timeisUp
                });
                function timeisUp() {
                    clearInterval(intervalId);
                    $('#se').val('00');
                    submitform();

                }
                intervalId = setInterval(function(){
                    var time = $('.ms_timer').html();
                    arrtime = time.split(":");
                    minutes = arrtime[0];
                    seconds = arrtime[1];
                    $('#mi').val(minutes);
                    $('#se').val(seconds);
                }, 100);
            });

        </script>

    <?php } else { ?>
        Chưa có câu hỏi
    <?php } ?>
<?php } ?>
    </div>