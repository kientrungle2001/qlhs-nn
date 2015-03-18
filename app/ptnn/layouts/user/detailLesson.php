<?php
$user_id = pzk_session('userId');
if(isset($user_id)) {
$lesson_id = pzk_request()->getSegment(3);
$lesson = _db()->useCB()->select('*')->from('lessons')->where(array('and', array('user_id', $user_id), array('id', $lesson_id)))->result_one();
$lessonvalue = unserialize($lesson['answer_value']);
?>

<form action="" method="post">
    <div class="col-md-6">
        <label for="">Dạng</label>
        <?php
        echo $data->getNameById($lesson['category_id'], 'categories', 'name');
        ?>
    </div>
    <?php if(!empty($lesson['subject'])) { ?>
        <div class="col-md-6">
            <label for="">Chủ đề</label>
            <?php
            echo $data->getNameById($lesson['subject'], 'categories', 'name');
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
        </tr>
        <tr>
            <th>
                <?php echo $lesson['number']; ?>
            </th>
            <th>

            </th>
            <th>
                <?php
                switch ($lesson['level']) {
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


        {each $lessonvalue as $key=>$item}

        <tr>
            <td><?php echo 'Câu '.$i.':'; ?></td>
            <td>
                <?php
                echo $data->getNameById($key, 'questions', 'name');
                ?>
            </td>
        </tr>
        <?php
        $typeQuestion = $data->getTypeByquestionId($key);
        if($typeQuestion == 'Q2') {
        ?>
        {each $item as $val}
        <tr>
            <td>
                <input style="height: 15px; width: 15px;" disabled   <?php if(isset($lessonvalue[$item]) && $lessonvalue[$item] == $val['id']){ echo 'checked'; }  ?> type="radio" />

            </td>
            <td <?php if($val['status'] == 1) { echo "class='highlinght'";} ?> >{val[content]}</td>
        </tr>
        {/each}
        <?php } ?>
        <?php $i++; ?>
        {/each}


    </table>



</form>
<style>
    .tb_question tr th{
        text-align: center;
    }
    .highlinght{
        background-color: #a8cae6;
    }
</style>
<?php
}
?>
