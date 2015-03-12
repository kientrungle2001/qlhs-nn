<?php
pzk_loader()->importObject('core/db/List');
/**
 *
 */
class PzkCategoryQuestion extends PzkCoreDbList
{
    public $parentCategoryId;
    public function listQuestion()
    {
        $listQuestion = _db()->select('*')->from($this->table)->result();
        return $listQuestion;
    }
    public function listAnswer()
    {
        $listAnswer = _db()->select('*')->from('answers')->result();
        return $listAnswer;
    }
    public function getQuestionByIds($ids, $topic_id, $level,$limit=5) {
    $data = _db()->useCB()->select('*')->from($this->table)
        ->orderby('rand()')
        ->limit($limit, 0);
        if($topic_id){
            $data->where(array('and', array('like', 'categoryIds', '%'.$ids.'%'), array('topic_id', $topic_id), array('level', $level)) );
        }else {
            $data->where(array('and', array('like', 'categoryIds', '%'.$ids.'%'), array('level', $level)) );
        }
    return $data->result();
}

}
?>