<?php

define('ERROR', "Setting is not updated");
define('SETTING_ERROR_UPDATE_MESSAGE', "Setting not updated");
define('SETTING_SUCCESS_UPDATE_MASSAGE', "Setting updated successfully");


class settingModel extends dbModel {

    public $attributeLabel = array(
        'setting_id' => 'Setting Id',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'smtp_username' => 'smtp_username',
        'smtp_password' => 'smtp_password',
        'pinterest' => 'Pinterest',
        'menu_color' => 'Menu Color',
        'menu_hover_color' => 'Menu Hover Color',
        'menu_font_size' => 'Menu Font Size',
        'menu_line_height' => 'Menu Line Height',
        'menu_bg_color' => 'Menu Bg Color',
        'menu_font_weight' => 'Mene font weight',        
        'created_date' => 'Created Date',
        'modification_date' => 'Modification Date',
        
    );

    public function tableName() {
        return $this->tableName = "tbl_admin_setting";
    }

}
?>



