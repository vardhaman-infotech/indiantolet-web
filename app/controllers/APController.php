<?php

class APController {

    public $template;
    public $templateFolder;
    public $view;

     public function checkSession() {
        if (!isset($_SESSION['user_id'])) {
            header("Location:" . DEFAULT_URL . "/home?msg=Please login First");
        } else {
            $objUser = new userModel();
            //$_SESSION = $objUser->cleanArray($_SESSION);
            $getUser = $objUser->selectByPk($_SESSION['user_id']);
            if (count($getUser) == 0) {
                @session_start();
                unset($_SESSION['LoggedIn']);
                unset($_SESSION['name']);
                unset($_SESSION['user_id']);
                unset($_SESSION['welcome']);
                unset($_SESSION['email_id']);
                unset($_SESSION['password']);
                header("Location:" . DEFAULT_URL . "/home?msg=Please login First");
            }
        }
    }
//////// check session for lab
     public function checkSessionLab() {
        if (!isset($_SESSION['labuser_id'])) {
            header("Location:" . DEFAULT_URL . "/home?msg=Please login First");
        } else {
           $obj_labuser = new labuserModel();
            //$_SESSION = $objUser->cleanArray($_SESSION);
            $getlabUser = $obj_labuser->selectByPk($_SESSION['labuser_id']);
            if (count($getlabUser) == 0) {
                @session_start();
                unset($_SESSION['LoggedIn']);
                unset($_SESSION['name']);
                unset($_SESSION['labuser_id']);
                unset($_SESSION['welcome']);
                unset($_SESSION['email_id']);
                unset($_SESSION['password']);
                header("Location:" . DEFAULT_URL . "/home?msg=Please login First");
            }
        }
    }
    /////////////
      public function checkSessionPage() {
        if (isset($_SESSION) && isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            header('Location:' . DEFAULT_URL . '/user/dashboard/');
        }
    }
    public function assign($templateFolder, $template, $array) {
        $this->view = new viewModel($template, $templateFolder);
        $this->view->assign($array);
    }

    public function errorpage() {
        $this->template = 'index';
        $this->templateFolder = 'error';
        $this->view = new viewModel($this->template, $this->templateFolder);
    }

    function paginationListing($start, $totalItem, $perpage, $other = '') {
        $objPages = new paginatorModel();
        $listing = $objPages->paginate_ajax($start, $totalItem, $perpage, $other);
        return $listing;
    }

    //function for checking that any field is set or not empty
    function arraySet($dataArr, $setArr) {
        foreach ($setArr as $key => $value) {
            if (!isset($dataArr[$value])) {
                $this->errorpage();
                exit();
            }

            if (empty($dataArr[$value])) {
                $this->errorpage();
                exit();
            }
        }
        return true;
    }

}