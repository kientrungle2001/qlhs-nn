<?php
/**
 *
 */
class PzkCategoryController extends PzkController
{
    public $masterPage = 'index';
    public $masterPosition = 'left';
    public function layout()
    {
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

    public function questionAction()
    {

        $this->initPage();
        $this->append('category/question', 'left');

        $this->display();
    }
}
?>