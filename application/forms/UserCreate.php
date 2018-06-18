<?php

class Application_Form_UserCreate extends Zend_Form{

    public function init(){
        //Method
        $this->setMethod('post');

        //Username
        $this->addElement('text', 'username', array(
            'label' => 'Tên tài khoản:',
            'required' => true,
            'filters' => array('StringTrim'),
        ));

        //Name
        $this->addElement('text','name',array(
            'label' => 'Tên hiển thị:',
            'required' => true,
            'filters' => array('StringTrim'),
        ));

        //Password
        $this->addElement('password','password',array(
            'label' => 'Mật khẩu:',
            'required' => true,
            'validator' => array(
                array(
                    'validator' => 'StringLength', 'option' => array(6,20)
                )
            )
        ));

        //Submit
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Tạo người dùng',
        ));

        //csrf
        $this->addElement('hash','csrf',array(
            'ignore' => true,
        ));
    }
}