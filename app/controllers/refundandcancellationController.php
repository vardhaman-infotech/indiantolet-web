<?php

class refundandcancellationController extends APController {

    public $template = 'refundandcancellation';
    public $templateFolder = 'pages';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
   
    public function indexAction() { 
        
        $this->template = 'refundandcancellation';
        $this->view = new viewModel($this->template, $this->templateFolder);
     //   $this->view->assign(array('about' => $GetAbout));
    }

}
