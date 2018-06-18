<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        
    }

    public function indexAction()
    {   
        $form = new Application_Form_UserDelete();

        $users = new Application_Model_UserMapper();
        
        $this->view->users = $users->fetchAll();

        $this->view->form = $form;
        //var_dump($users->fetchAll());
        // $users = $users->fetchAll();
        // $list = [];
        // foreach ($users as $user){
        //     $list[] = [$user->id,$user->username,$user->name,$user->created];
        // }
        // var_dump($list);
        // $this->_helper->json($list);
    }

    public function listAction(){
        $form = new Application_Form_UserDelete();

        $users = new Application_Model_UserMapper();

        $users = $users->fetchAll();
        $list = [];
        foreach ($users as $user){
            array_unshift($list,["id"=>$user->id,
                        "username"=>$user->username,
                        "name"=>$user->name,
                        "created"=>$user->created
                    ]);
        }

        $this->_helper->json($list);
    }

    public function createAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_UserCreate();
        if ($this->getRequest()->isPost()) {
            // if ($form->isValid($request->getPost())) {
            //     $user = new Application_Model_User($form->getValues());
            //     $mapper  = new Application_Model_UserMapper();
            //     $mapper->save($user);
            //     return $this->_helper->redirector('index');
            // }
            $user = new Application_Model_User();
            $mapper  = new Application_Model_UserMapper();
            $user->name = $this->getRequest()->getParam('name');
            $user->username = $this->getRequest()->getParam('username');
            $user->password = $this->getRequest()->getParam('password');
            $mapper->save($user);

            return $this->_helper->redirector('index');
        }
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            // $url = $this->getRequest()->getPathInfo();
            // $user_id = (int) explode('/',$url)[3];
            $user_id = $this->getRequest()->getParam('id');
            
            //$user = new Application_Model_User();
            $mapper  = new Application_Model_UserMapper();
            
            if($mapper->delete($user_id)){
                return $this->_helper->redirector('index');
            }
        }
    }

    public function updateAction()
    {
        // Get User Infomation
        // $url = $this->getRequest()->getPathInfo();
        // $user_id = (int) explode('/',$url)[3];

        // $user = new Application_Model_User();
        // $mapper  = new Application_Model_UserMapper();

        // $mapper->find($user_id,$user);
        // Show Form
        if($this->getRequest()->isGet())
        {
            // Parse to Form
            $form = new Zend_Form;
            $form->setMethod('post')
                ->addElement('text','name',array(
                    'label' => 'Tên hiển thị:',
                    'required' => true,
                    'value' => $user->name,
                ))
                ->addElement('submit', 'submit', array(
                    'ignore'   => true,
                    'label'    => 'Sửa tên',
                ))->addElement('hash','csrf',array(
                    'ignore' => true,
                ))->setAction($url);
            $this->view->form = $form;
        }

        // Submit Form
        if($this->getRequest()->isPost()){
            $new_name = $this->getRequest()->getParam('name');
            $userid = $this->getRequest()->getParam('id');

            $user = new Application_Model_User();
            $mapper  = new Application_Model_UserMapper();

            $mapper->find($userid,$user);
            $user->name = $new_name;
            $mapper->save($user);

            return $this->_helper->redirector('index');
            
        }
    }


}

