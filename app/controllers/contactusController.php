<?php

class contactusController extends APController {

    public $template = 'contactus';
    public $templateFolder = 'pages';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
    
/////////////AboutUs Page
    public function indexAction() {
        $obj_contact_us= new contactusModel();
        $get_about_us=$obj_contact_us->selectByPk('1');
        $this->view = new viewModel($this->template, $this->templateFolder);
        $this->view->assign(array('about_us'=>$get_about_us));
    }
    

}

