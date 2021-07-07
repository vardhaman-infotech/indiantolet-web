<?php

class homeController extends APController {

    public $template = 'aboutus';
    public $templateFolder = 'pages';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
    public function indexAction() { //echo 'hi';die;
      
        $this->view = new viewModel($this->template, $this->templateFolder);

    }
     public function aboutusAction() { 
        
        $this->template = 'aboutus';
        $this->view = new viewModel($this->template, $this->templateFolder);
     //   $this->view->assign(array('about' => $GetAbout));
    }



}
