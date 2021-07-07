<?php

class termsController extends APController {

    public $template = 'terms';
    public $templateFolder = 'pages';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
   

    public function indexAction() { //echo 'hi';die;
        
        $this->template = 'terms';
        $this->view = new viewModel($this->template, $this->templateFolder);
     //   $this->view->assign(array('about' => $GetAbout));
    }

}
