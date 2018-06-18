<?php

class Application_Form_UserDelete extends Zend_Form
{
    public function init(){
        //Method
        $this->setMethod('post');

        //csrf
        $this->addElement('hash','csrf',array(
            'ignore' => true,
        ));

        //Submit
        $this->addElement('submit', 'submit', array(
                            'ignore'   => true,
                            'label'    => 'Xóa',
                        ));

        

        
    }
}