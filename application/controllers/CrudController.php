<?php

class CrudController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->layout();
        $layout->setLayout('layout');
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
    }

    public function indexAction()
    {
        $list = new Application_Model_DbTable_Crud();
        $this->view->crud = $list->getList(); 
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        if(!empty($id)) {
            $language = new Application_Model_DbTable_Crud();
            $data = $language->getLanguageDetails($id);
            $form = new Application_Model_FormUpdate(null,$data);
            $this->view->language_name = $data->language_name;
            $this->view->updateForm = $form;
        }
        else {
            $this->_helper->redirector('index','crud'); 
        }
    }

    public function insertAction()
    {
        $form = new Application_Model_FormNewLanguage();
        $this->view->form = $form;
    }

    public function newLangAction()
    {
        $form = new Application_Model_FormNewLanguage();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $name = $this->getRequest()->getParam('language_name');
                $description = $this->getRequest()->getParam('language_description');
                $crud = new Application_Model_DbTable_Crud();
                $crud->insertRecord($name,$description);  
                $this->_helper->redirector('index','crud'); 
            }
            else {
                $this->view->form = $form;
                $this->render('insert');
            }
        }
        else {
           $this->view->form = $form; 
           $this->render('insert');
        }
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        $crud = new Application_Model_DbTable_Crud();
        $crud->deleteRecord($id);
        $this->_helper->redirector('index','crud');
    }

    public function updateAction()
    {
        $id = $this->getRequest()->getParam('edit_id');
        $language = new Application_Model_DbTable_Crud();
        $data = $language->getLanguageDetails($id);
        $form = new Application_Model_FormUpdate(null,$data);
       
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $name = $this->getRequest()->getParam('language_name');
                $description = $this->getRequest()->getParam('language_description');
                $crud = new Application_Model_DbTable_Crud();
                $crud->updateRecord($name,$description,$id);
                $this->_helper->redirector('index','crud');
            }
            else {
                $this->view->language_name = $data->language_name;
                $this->view->updateForm = $form;
                $this->render('edit');
            }
        }
        else {
            $this->view->updateForm = $form;           
        }
    }


}















