<?php
    $parent_id = pzk_request()->getSegment(3);
if(pzk_request()->is('POST') && is_numeric($parent_id)) {
    $request = pzk_request()->query;
    $ids = ','.$request['id_category'].','.$request['subject'];
    $items = $data->getQuestionByIds($ids, $request['level'], $request['number']);
?>

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
        echo $data->getNameById($request['subject'], 'categories', 'name');
        ?>
        <input type="hidden" name="subject" value="<?php echo $request['subject']; ?>"/>
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

    <table class="table">
        <?php $i = 1; ?>

        <?php
            $arIdQ = array();
            foreach($items as $value) {
                $arIdQ[] = $value['id'];
            }
        ?>
        <input type="hidden" name="questionIds" value="<?php echo implode(',', $arIdQ); ?>"/>

        {each $items as $item}
        <?php
        $answers = _db()->useCB()->select('*')->from('answers')->where(array('questionId', $item['id']))->result();
        ?>
        <tr>
            <td><?php echo 'Câu '.$i.':'; ?></td>
            <td>{item[name]}
            </td>
        </tr>
        {each $answers as $val}
        <tr>
            <td><input name="value_<?php echo $item['id']; ?>" value="{val[id]}" type="radio" /></td>
            <td>{val[value]}</td>
        </tr>
        {/each}
        <?php $i++; ?>
        {/each}


    </table>
<script>
    $(function(){
        $(function(){
            $('.ms_timer').countdowntimer({
                minutes :<?php echo $request['time']; ?>,
                seconds : 0,
                size : "lg",
                timeUp : timeisUp
            });
            function timeisUp() {
                clearInterval(intervalId);
                $('#dm').submit();

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

    });
</script>
    <div class="item center">
        <input id="answer" type="submit" name="done" value="Hoàn thành">
    </div>
    <input id="mi" name="mi" type="hidden" value=""/>
    <input id="se" name="se" type="hidden" value=""/>
</form>
    <style>
        .tb_question tr th{
            text-align: center;
        }
    </style>
<?php } ?>