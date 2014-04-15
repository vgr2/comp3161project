<?php
/**
 * Processes CRUD action calls for the VCrud class
 *
 * @author Valdeck
 */
class ProcessVCrud {
    //put your code here
    var $vars;
    var $db;

    function ProcessVCrud($post,$db) {
        $this->vars = $post;
        $this->db = $db;
        // print_r($this->vars);die();
    }
    function action() {
        switch ($this->vars['submit']) {
            case 'Insert':
                $success = $this->insertRow($this->vars);
                break;

            case 'Update':
                $success = $this->updateRow($this->vars);
                break;

            case 'Delete':
                $success = $this->deleteRow($this->vars);
                break;

            default:
                break;
        }
//        print_r($success);
        if ($success){
            header("Location: ".$this->vars["return_url"]);
        }
    }
    function insertRow($vars) {
        $qry = $this->insertQuery($vars);
        return $this->db->query($qry);
    }
    function insertQuery($vars) {
        $metaKeys = array($vars["return_url"], $vars["table"], $vars["submit"]);
        // sepatate table values from meta values
        $tableValues = array_diff($vars, $metaKeys);
        foreach ($tableValues as $key => $value){
            if (!empty($value)){
                $cols = $cols.  $this->db->escape($key).',';
                $vals = $vals."'".$this->db->escape($value)."',";
            }
        }
        $cols = rtrim($cols, ',');
        $vals = rtrim($vals, ',');
        $qry = "insert into ".$vars['table']." (".$cols.") values (".$vals.")";
        return $qry;    
    }
    function updateRow($vars) {
        $qry = $this->updateQuery($vars);
        return $this->db->query($qry);
    }
    function updateQuery($vars) {
        $metaKeys = array($vars["return_url"], $vars["table"], $vars["submit"]);
        $tableValues = array_diff($vars, $metaKeys);
        foreach ($tableValues as $key => $value){
            if (!empty($value)){
                $setString = $setString.$key." = '".$value."', ";
            }
        }
        $setString = rtrim($setString, ', ');
        $whereCond = "where id = ".$vars["id"];
        $qry = "update ".$vars["table"]." set ".$setString." ".$whereCond;
        return $qry;    
    }
    
    function deleteRow($vars) {
        $qry =  $this->deleteQuery($vars);
        $success = $this->db->query($qry);
        return $success;
    }
    function deleteQuery($vars) {
        return $qry = "delete from ".$vars['table']." where id = '".$vars['id']."'";
    }

}

?>
