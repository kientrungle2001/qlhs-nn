<?php

if(pzk_request()->is('POST')) {
    $request = pzk_request()->query;
    $items = explode(',',$request['questionIds']);
    ?>

    <form action="/category/sucsses" method="post">
        <input type="hidden" name="questionIds" value="<?php echo $request['questionIds'];?>"/>
        <div class="col-md-6">
            <label for="">Chọn dạng</label>
            <?php
            //$name = $data->getNameById($parent_id, 'categories');
            //echo $name['name'];
            ?>
        </div>
        <?php if(!empty($request['subject'])) { ?>
            <div class="col-md-6">
                <label for="">Chủ đề</label>
                <?php
                // $name = $data->getNameById($request['subject'], 'categories');
                //echo $name['name'];
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
                <th rowspan="2"></th>

            </tr>
            <tr>
                <th>
                    <?php //echo $request['number']; ?>
                </th>
                <th>
                    <div id="ms_timer"></div>

                </th>
                <th>
                    <?php
                    /*switch ($request['level']) {
                        case 1:
                            echo "Dễ";
                            break;
                        case 2:
                            echo "Bình thường";
                            break;
                        case 3:
                            echo "Khó";
                            break;
                    }*/
                    ?>
                </th>
            </tr>
            </thead>
        </table>

        <table class="table">
            <?php $i = 1; ?>


            {each $items as $item}
            <?php
            $answers = _db()->useCB()->select('*')->from('answers')->where(array('questionId', $item))->result();
            ?>
            <tr>
                <td><?php echo 'Câu '.$i.':'; ?></td>
                <td>
                    <?php
                    echo $data->getNameById($item, 'questions', 'name');
                    ?>
                </td>
            </tr>
            {each $answers as $val}
            <tr>
                <?php $a = "value_".$item; ?>
                <td><input name="value_<?php echo $item; ?>" disabled="disabled"  value="{val[id]}" <?php if(isset($request[$a]) && $request[$a] == $val['id']){ echo 'checked'; }  ?> type="radio" /></td>
                <td <?php if($val['valueTrue'] == 1) { echo "class='highlinght'";} ?> >{val[value]}</td>
            </tr>
            {/each}
            <?php $i++; ?>
            {/each}


        </table>

        <div class="item center">
            <input id="answer" type="submit" name="done" value="Lưu vào vở bài tập">
        </div>
    </form>
    <style>
        .tb_question tr th{
            text-align: center;
        }
        .highlinght{
            background-color: #a8cae6;
        }
    </style>
<?php } ?>