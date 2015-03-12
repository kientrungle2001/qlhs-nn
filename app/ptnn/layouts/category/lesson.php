<form action="/category/question/<?php echo $data->getParentCategoryId(); ?>" method="post">
    <?php
    $cateEp = $data->getEpcate();
    $curentCateId = $data->getParentCategoryId();
    $topics = $data->getTopicByCategoryId($curentCateId);
    ?>
    <input type="hidden" name="id_category" value="<?php  echo $curentCateId; ?>"/>
    <div class="col-md-6">
        <label for="">Chọn dạng</label>
        {each $cateEp as $val}
        <a <?php if($curentCateId == $val['id']) { echo "class='active_type'"; } ?> href="<?php echo pzk_request()->build($val['router'].'/'.$val['id']); ?>">{val[name]}</a>
        {/each}
    </div>
    <?php if($topics){ ?>
    <div class="col-md-6">
        <label for="">Chủ đề</label>
        <select name="subject" id="">
            <option value="">Chọn chủ đề ...</option>
            {each $topics as $topic}
            <option value="{topic[id]}"><?php echo $topic['name']; ?></option>
            {/each}
        </select>
    </div>
    <?php } ?>


    <br>
    <table class="tb_lesson" border="1px" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>Số câu</th>
            <th>Thời gian</th>
            <th>Mức độ</th>
            <th rowspan="2"><input type="submit" name="submit" value="Bắt đầu làm bài"></th>

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
                <select name="level">
                    <option value="1">Dễ</option>
                    <option value="2">Bình thường</option>
                    <option value="3">Khó</option>
                </select>
            </th>
        </tr>
        </thead>
    </table>
</form>
<style>
    .active_type{
        color: orangered;
        font-weight: bold;
    }
    .tb_lesson tr th{
        text-align: center;
    }
</style>