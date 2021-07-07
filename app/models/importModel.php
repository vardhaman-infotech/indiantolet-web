<?php

class importModel extends dbModel {

    public $attributeLabel = array(
        'import_id' => 'import_id',
        'importreport' => 'importreport',
        'created_date' => 'Created Date',
        'modification_date' => 'Modification Date',
    );

    function tableName() {
        return $this->tableName = "tbl_import";
    }
}
?>



