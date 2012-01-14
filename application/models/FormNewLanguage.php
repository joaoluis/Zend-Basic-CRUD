<?php

class Application_Model_FormNewLanguage extends Zend_Form
{
    public function __construct($options = null) {
    
        parent::__construct($options);
        $this->setName('newLanguage');
        $this->setMethod('post');
        $this->setAction('/crud/new-lang');
        $this->setAttrib('class','nice');
        
        $name = new Zend_Form_Element_Text('language_name');
        $name->removeDecorator('label')->removeDecorator('htmlTag');
        $name->setAttrib('class','large');
        $name->setRequired(true);
        $name->addValidator('NotEmpty');
        $name->addErrorMessage('This field must not be empty (and it must be unique)');
        $name->addValidator( new Zend_Validate_Db_NoRecordExists('proglang', 'language_name'));
        
        $description = new Zend_Form_Element_Textarea('language_description');
        $description->removeDecorator('label')->removeDecorator('htmlTag');
        $description->setAttrib('rows','15');
        $description->setAttrib('class','large');
        $description->setRequired(true);
        $description->addValidator('NotEmpty');
        $description->addErrorMessage('This field must not be empty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save');
        $submit->setAttrib('class','button nice');
        $submit->removeDecorator('DtDdWrapper');
    
        $this->addElements(array($name, $description, $submit));
    }
}

