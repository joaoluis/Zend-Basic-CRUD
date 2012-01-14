<?php

class Application_Model_FormUpdate extends Zend_Form
{
    public function __construct($options = null, $data = null) {
    
        parent::__construct($options);
        $this->setName('updateLanguage');
        $this->setMethod('post');
        $this->setAction('/crud/update');
        $this->setAttrib('class','nice');
        
        $edit_id = new Zend_Form_Element_Hidden('edit_id');
        $edit_id->setValue($data->id);
        $edit_id->removeDecorator('label')->removeDecorator('htmlTag');
        
        $name = new Zend_Form_Element_Text('language_name');
        $name->removeDecorator('label')->removeDecorator('htmlTag');
        $name->setAttrib('class','large');
        $name->setRequired(true);
        $name->setValue($data->language_name);
        $name->addValidator('NotEmpty');
        $name->addErrorMessage('This field must not be empty (and it must be unique)');
        $name->addValidator( new Zend_Validate_Db_NoRecordExists('proglang', 'language_name'));
        
        $description = new Zend_Form_Element_Textarea('language_description');
        $description->removeDecorator('label')->removeDecorator('htmlTag');
        $description->setAttrib('rows','15');
        $description->setAttrib('class','large');
        $description->setRequired(true);
        $description->setValue($data->language_description);
        $description->addValidator('NotEmpty');
        $description->addErrorMessage('This field must not be empty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save');
        $submit->setAttrib('class','button nice');
        $submit->removeDecorator('DtDdWrapper');
    
        $this->addElements(array($edit_id, $name, $description, $submit));
    }

}

