<?php

class farmerController extends APController {

    public $template = 'index';
    public $templateFolder = 'home';
    public $view;

    /**
     * This is the default function that will be called by router.php
     *
     * @param array $getVars the GET variables posted to index.php
     */
    /*
      public function indexAction() { //echo 'hi';die;
      $obj_astrologer = new astrologerModel();
      $obj_language = new languageModel();
      $obj_product = new productModel();
      $obj_product = new productModel();
      //$GetAstrologer =  $obj_astrologer->select('is_active="1"');//For get astrologer
      $GetAstrologer =  $obj_astrologer->selectLimit('8','','*','id desc','is_active="1"');//For get astrologer
      $Getlanguage =  $obj_language->select('is_active="1"');//For get astrologer
      $Getproduct =  $obj_product->select('is_active="1"');//For get product
      $this->view = new viewModel($this->template, $this->templateFolder);
      $this->view->assign(array('astrologer'=>$GetAstrologer,'language'=>$Getlanguage,'product'=>$Getproduct));

      } */
    public function forgotpasswordAction($id = '') {
        $obj_farmer = new farmerModel();
        $u = highlydecrpt($id);
        $maintoken = highlydecrpt($id); //echo $maintoken;
        //  $maintoken = strpos($maintoken, '*');

        if (strpos($maintoken, '*') > 0) {
            $farmerid = explode("*", $maintoken);
            $farmerid = end($farmerid);
            $this->template = 'farmer_forgotpassword';
            /* For genereate otp */
            $otp = mt_rand(100000, 999999); //generate otp
            $OtpArray = array('otp' => $otp);
            $obj_farmer->update($OtpArray, 'id=' . $farmerid);
            $this->view = new viewModel($this->template, $this->templateFolder);
            $this->view->assign(array('farmer_id' => $farmerid, 'otp' => $otp));
        } else {
            $this->errorpage();
        }
    }

    public function resetpasswordAction() {
        $obj_farmer = new farmerModel();
        if (isset($_POST['otp']) && $_POST['otp'] != '') {
            /* For match otp */
            $farmerId = $_POST['farmerID'];
            $otp = $_POST['otp'];
            $CheckOtp = $obj_farmer->selectByPk($farmerId, '', 'otp');
            if ($CheckOtp->otp == $otp) { //For match otp
                if (isset($_POST) && $_POST['new_pass'] != '' && $_POST['con_password'] != '') {

                    if ($_POST['new_pass'] == $_POST['con_password'] && !empty($_POST['farmerID'])) { //echo'1';die;
                      //  $obj_farmer = new farmerModel();
                        $_POST = $obj_farmer->cleanArray($_POST);
                        $farmerId = $_POST['farmerID'];
                        $dataArr = array('password' => hash('sha512', $obj_farmer->clean($_POST['con_password'])));
                        $obj_farmer->update($dataArr, 'id=' . $farmerId);
                        $_SESSION['passwordMsg'] = "Your Password Change Successfully";
                        header('Location:' . DEFAULT_URL . '/farmer/thankyou');
                    } else { //echo'2';die;
                        $this->errorpage();
                    }
                } else {

                    $this->errorpage();
                }
            } else {
                $_SESSION['passwordMsg'] = "Your OTP does not match";
                header('Location:' . DEFAULT_URL . '/farmer/thankyou');
            }
        } else {
             $_SESSION['passwordMsg'] = "Please enter your OTP";
                header('Location:' . DEFAULT_URL . '/farmer/thankyou');
        }
    }

    public function thankyouAction() {
        $this->template = 'thankyou';
        $this->view = new viewModel($this->template, $this->templateFolder);
    }

}
