<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        $text = $this->getRequest()->getParam('val');
        $searchList = new Application_Model_DbTable_Crud();
        $this->view->results = $searchList->getSearchList($text); 
    }


}

