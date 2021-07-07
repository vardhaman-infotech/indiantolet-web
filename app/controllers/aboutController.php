<?php

class aboutController extends APController {

    public $template = 'about';
    public $templateFolder = 'pages';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
    public function indexAction() {   
        $obj_pagemanager = new page_managerModel();
        $GetAboutus = $obj_pagemanager->selectByPk(1);
        $this->view = new viewModel($this->template, $this->templateFolder);
        $this->view->assign(array('about' => $GetAboutus));
    }

    public function aboutusAction() { //echo 'hi';die;
        
        $this->template = 'app_aboutus';
        $this->view = new viewModel($this->template, $this->templateFolder);
     //   $this->view->assign(array('about' => $GetAbout));
    }

}
