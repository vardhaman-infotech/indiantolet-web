<?php

class userController extends APController {

    public $template = 'index';
    public $templateFolder = 'home';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
    
    /*  public function indexAction() { echo 'hi';die; 
      
      }*/  
    public function forgotpasswordAction($id = '') {
        $obj_user = new userModel();
        $u = highlydecrpt($id);
        $maintoken = highlydecrpt($id); //echo $maintoken;
        //  $maintoken = strpos($maintoken, '*');

        if (strpos($maintoken, '*') > 0) {
            $userId = explode("*", $maintoken);
            $userId = end($userId);
            $this->template = 'user_forgotpassword';
            /* For genereate otp */
            $otp = mt_rand(100000, 999999); //generate otp
            $OtpArray = array('otp' => $otp);
            $obj_user->update($OtpArray, 'id=' . $userId);
            $this->view = new viewModel($this->template, $this->templateFolder);
            $this->view->assign(array('user_id' => $userId, 'otp' => $otp));
        } else {
            $this->errorpage();
        }
    }

 public function ownerforgotpasswordAction($id = '') { echo 'fdfdfd';die;
        $obj_user = new userModel();
        $u = highlydecrpt($id);
        $maintoken = highlydecrpt($id); //echo $maintoken;
        //  $maintoken = strpos($maintoken, '*');

        if (strpos($maintoken, '*') > 0) {
            $userId = explode("*", $maintoken);
            $userId = end($userId);  
            $this->template='owner_recovery_password';
            $this->templateFolder='pages';
            $this->view = new viewModel($this->template, $this->templateFolder);
            $this->view->assign(array('user_id' => $userId));
        } else {
            $this->errorpage();
        }
    }
    public function resetpasswordAction() {
        $obj_user = new userModel();
        if (isset($_POST['otp']) && $_POST['otp'] != '') {
            /* For match otp */
            $userId = $_POST['userID'];
            $otp = $_POST['otp'];
            $CheckOtp = $obj_user->selectByPk($userId, '', 'otp');
            if ($CheckOtp->otp == $otp) { //For match otp
                if (isset($_POST) && $_POST['new_pass'] != '' && $_POST['con_password'] != '') {

                    if ($_POST['new_pass'] == $_POST['con_password'] && !empty($_POST['userID'])) { //echo'1';die;
                      //  $obj_farmer = new farmerModel();
                        $_POST = $obj_user->cleanArray($_POST);
                        $userId = $_POST['userID'];
                        $dataArr = array('password' => hash('sha512', $obj_user->clean($_POST['con_password'])));
                        $obj_user->update($dataArr, 'id=' . $userId);
                        $_SESSION['passwordMsg'] = "Your Password Change Successfully";
                        header('Location:' . DEFAULT_URL . '/user/thankyou');
                    } else { //echo'2';die;
                        $this->errorpage();
                    }
                } else {

                    $this->errorpage();
                }
            } else {
                $_SESSION['passwordMsg'] = "Your OTP does not match";
                header('Location:' . DEFAULT_URL . '/user/thankyou');
            }
        } else {
             $_SESSION['passwordMsg'] = "Please enter your OTP";
                header('Location:' . DEFAULT_URL . '/user/thankyou');
        }
    }

    public function thankyouAction() {
        $this->template = 'thankyou';
        $this->view = new viewModel($this->template, $this->templateFolder);
    }

}
