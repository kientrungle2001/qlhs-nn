<?php
/**
 *
 */
class PzkCategoryController extends PzkFrontendController
{
    public $masterPage = 'index';
    public $masterPosition = 'left';
    public function layout(){
    	
        $this->page = pzk_parse($this->getApp()->getPageUri('index'));
    }
    public function indexAction()
    {
        $this->layout();
        $this->page->display();
    }
    public function categoryAction()
    {
        $this->layout();
        $category = pzk_parse('<home.category table="categories" layout="home/category"/>');
        $left = pzk_element('left');
        $left->append($category);
        $this->page->display();
    }
    public function sectionAction()
    {
        $parent_id = pzk_request()->getSegment(3);

        $this->initPage();
        $this->append('category/section', 'left');
        $category = pzk_element('parent_category');
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function subSectionAction()
    {
        $parent_id = pzk_request()->getSegment(3);

        $this->initPage();
        $this->append('category/section', 'left');
        $category = pzk_element('parent_category');
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function lessonAction()
    {
        $parent_id = pzk_request()->getSegment(3);

        $this->initPage();
        $this->append('category/lesson', 'left');
        $category = pzk_element('parent_category');
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function questionAction(){

        $this->initPage();
        $this->append('category/question', 'left');

        $this->display();
    }
    public function answerAction(){
    	
        $this->initPage();
        $this->append('category/answer', 'left');

        $this->display();
    }
    public function reviewAction(){

        $this->initPage();
        $this->append('category/review', 'left');

        $this->display();
    }
    public function successAction(){
    	
        if(pzk_request()->is('POST')) {
            $this->initPage();
            $this->append('category/success', 'left');
            $post = pzk_request()->query;
            if(!empty($post)) {
                if(isset($post['subject'])) {
                    $subject = $post['subject'];
                }else{
                    $subject = '';
                }
                $tamtime = strtotime($post['end_time']) - strtotime($post['start_time']) - 7*3600;
                //echo $tamtime;
                $addLesson=array('user_id'=>pzk_session('userId'),
                    'question_ids'=>$post['questionIds'],
                    'category_id'=>$post['parent_id'],
                    'subject'=>$subject,
                    'number'=>$post['number'],
                    'time'=>date('H:i:s', $tamtime),
                    'level'=>$post['level'],
                    'answer_value'=>serialize($post['value']),
                    'end_time'=>$post['end_time'],
                    'total'=>$post['total'],
                    'total_true'=>$post['total_true'],
                    'start_time'=>$post['start_time']
                );
                //debug($addLesson); die();
                $entity = _db()->useCb()->getEntity('table')->setTable('lessons');
                $entity->setData($addLesson);
                $entity->save();
                $this->redirect('');

            }
            $this->display();
        }
    }
}
?>