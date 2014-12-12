<form action="/home/question" method="post">
    <?php
    $category = $data->listCate();
    $cateParent = buildArr($category,'parent',0);
    $subject = buildArr($category,'parent',2);
    $cateEp = $data->getEpcate();

    ?>
    <div class="col-md-6">
        <label for="">Chọn dạng</label>
        {each $cateEp as $val}
        <a href="<?php echo pzk_request()->build($val['router'].'/'.$val['id']); ?>">{val[name]}</a>
        {/each}
    </div>
    <div class="col-md-6">
        <label for="">Chủ đề</label>
        <select name="subject" id="">
            <option value="">Chọn chủ đề ...</option>
            {each $subject as $valueSub}
            <?php
            $tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
            if($valueSub['lever'] == 1){
                $subject = $tab.$valueSub['name'];
            } else {
                for ($i= 2; $i <= $valueSub['lever'] ; $i++) {
                    $tab = $tab.$tab;
                }
                $subject = $tab.$valueSub['name'];
            }
            ?>
            <option value="{valueSub[id]}"><?php echo($subject) ?></option>
            {/each}
        </select>
    </div>



    <br>
    <table border="1px" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>Số câu</th>
            <th>Thời gian</th>
            <th>Mức độ</th>
            <th rowspan="2"><input type="submit" name="submit" value="Bắt đầu làm bài"></th>
            <th rowspan="2" id="">15:00</th>
        </tr>
        <tr>
            <th>
                <select name="number" id="">
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </th>
            <th>
                <select name="time" id="">
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select> phút
            </th>
            <th>
                <select name="lever">
                    <option value="1">Dễ</option>
                    <option value="2">Bình thường</option>
                    <option value="3">Khó</option>
                </select>
            </th>
        </tr>
        </thead>
    </table>
</form>