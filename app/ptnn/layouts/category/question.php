<?php
    $parent_id = pzk_request()->getSegment(3);
if(pzk_request()->is('POST') && is_numeric($parent_id)) {
    $request = pzk_request()->query;
    $ids = ','.$request['id_category'].','.$request['subject'];
    $items = $data->getQuestionByIds($ids, $request['level'], $request['number']);
?>

<form action="" method="post">
    <div class="col-md-6">
        <label for="">Chọn dạng</label>
        <?php
        $name = $data->getNameById($parent_id, 'categories');
        echo $name['name'];
        ?>
    </div>
    <?php if(!empty($request['subject'])) { ?>
    <div class="col-md-6">
        <label for="">Chủ đề</label>
        <?php
        $name = $data->getNameById($request['subject'], 'categories');
        echo $name['name'];
        ?>
    </div>
    <?php } ?>

    <br>

    <table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>Số câu</th>
            <th>Thời gian</th>
            <th>Mức độ</th>
            <th rowspan="2"><input type="submit" name="submit" value="Hoàn thành"></th>
            <th rowspan="2" id="countdown"></th>
        </tr>
        <tr>
            <th>
                <?php echo $request['number']; ?>
            </th>
            <th>
                <?php echo $request['time']; ?> phút
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
            </th>
        </tr>
        </thead>
    </table>

    <table class="table">
        <?php $i = 1; ?>
        {each $items as $item}
        <?php
        $answers = _db()->useCB()->select('*')->from('answers')->where(array('questionId', $item['id']))->result();
        ?>
        <tr>
            <td><?php echo 'Câu '.$i.':'; ?></td>
            <td>{item[name]}</td>
        </tr>
        {each $answers as $val}
        <tr>
            <td><input name="value_<?php echo $item['id']; ?>" type="radio" /></td>
            <td>{val[value]}</td>
        </tr>
        {/each}
        <?php $i++; ?>
        {/each}


    </table>

</form>
    <style>
        .tb_question tr th{
            text-align: center;
        }
    </style>
<?php } ?>