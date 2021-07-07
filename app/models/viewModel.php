<?php

/**
 * Handles the view functionality of our MVC framework
 */
class viewModel {

    /**
     * Holds variables assigned to template
     */
    private $data = array();

    /**
     * Holds render status of view.
     */
    private $render = FALSE;

    /**
     * Accept a template to load
     */
    public function __construct($template, $templateFolder = '') {
       
        //compose file name
        $this->data = new stdClass();
        if ($templateFolder != '') {

            //$file = SERVER_ROOT . '/views/' .strtolower($templateFolder).'/' . strtolower($template) . '.php';
            $file = SERVER_ROOT . '/views/' . ($templateFolder) . '/' . ($template) . '.php';
        } else {

            //$file = SERVER_ROOT . '/views/' . strtolower($template) . '.php';
            $file = SERVER_ROOT . '/views/' . $template . '.php';
        }
        //echo $file;
        if (file_exists($file)) {
            /**
             * trigger render to include file when this model is destroyed
             * if we render it now, we wouldn't be able to assign variables
             * to the view!
             */
            $this->render = $file;
        }
    }

    /**
     * Receives assignments from controller and stores in local data array
     * 
     * @param $variable
     * @param $value
     */
    public function assign($variable) {
        //print_r($variable);
        foreach ($variable AS $key => $value)
            $this->data->$key = $value;
    }

    public function __destruct() {
        //parse data variables into local variables, so that they render to the view
        $data = $this->data;
        //render view
        include($this->render);
    }

}
