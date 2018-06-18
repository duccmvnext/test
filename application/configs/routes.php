<?php

$router->addRoute('user', new Zend_Controller_Router_Route(
    'user', array(
        'controller' => 'index',
        'action' => 'index'
    )
));