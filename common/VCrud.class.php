<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VCrud
 * class to generate crud code on demand for given table. 
 * Table Constraints
 * - each table should have only 1 parent table
 * - 
 * @author Valdeck
 */
class VCrud {
    var $baseURL;
    var $pageName;
    var $dbName;
    var $tableName;
    var $priKeyName;
    var $foreignKeyName;
    var $foreignKeyData;
    var $listColsWanted;
    var $dbProcessor;
    var $pageTitle;
    var $fields;
    var $db;
    var $data;
    var $childTable;
    var $childPriKeyName;
    var $childForeignKeyName;
    var $childParentKeyData;
    var $childListColsWanted;
    var $childPageTitle;
    var $post;
    var $get;
    var $mode;
    var $id;
    var $ownerid;

    function VCrud($baseURL,$pageName,$dbName,$tableName,$priKeyName,$listColsWanted,$pageTitle,$db,$post,$get,$foreignKeyName,$foreignKeyData,$ownerid/*,$childTable,$childPriKeyName,$childForeignKeyName,$childParentKeyData,*/) {
        $this->db = $db;
        $this->baseURL = $baseURL;
        $this->pageName = $pageName;
        $this->dbName = $dbName;
        $this->tableName = $tableName;
        $this->priKeyName = $priKeyName;
        $this->foreignKeyName = $foreignKeyName; //$this->getForiegnKeyFieldName($this->getFieldNames($this->tableName)); //*/
        $this->foreignKeyData = $foreignKeyData;
        $this->dbProcessor = "../common/process.php";
        $this->pageTitle = $pageTitle;
        $this->listColsWanted = $listColsWanted;//$this->colsWanted($this->tableName);
        $this->post = $post;
        if (array_key_exists($this->foreignKeyName, $this->post)){
            $this->foreignKeyData = $this->post[$this->foreignKeyName];
        }
        if (isset($this->post['mode'])) {
            $this->mode = $this->db->escape($this->post['mode']);
        }
        if (isset($this->post['id'])) {
            $this->id = $this->db->escape($this->post['id']);
        }
        $this->get = $get;
        $this->ownerid = $ownerid;
//        echo 'get: ';$this->db->vardump($this->get);
//        echo 'post: ';$this->db->vardump($this->post);
//        echo 'fkname';$this->db->vardump($this->foreignKeyName);
//        echo 'fkdata';$this->db->vardump($this->foreignKeyData);
        
//        print_r($this->getForiegnKeyFieldName($this->getFieldNames($this->tableName)));
//        $this->childTable = $childTable;
//        $this->childPriKeyName = $childPriKeyName;
//        $this->childForeignKeyName = $childForeignKeyName;
//        $this->childParentKeyData = $childParentKeyData;
    }
    function selectMode($mode=null,$id=null) {
        echo '<span class = "crud">';
                    

        if ($mode == 'add'){
            echo '<h2>Add</h2>';
            echo $this->generateAddForm($this->tableName,  $this->foreignKeyName, $this->foreignKeyData, $this->baseURL,  $this->pageName);
            echo '<br>';
            
            echo $this->centralPageLink($this->baseURL,  $this->pageName,  $this->pageTitle);
        }
        if ($mode == 'edit'){
            echo '<h2>Edit</h2>';
            echo $this->generateEditForm($this->tableName, $this->id,  $this->foreignKeyName,  $this->baseURL,  $this->pageName);
            echo '<br>';
            echo $this->centralPageLink($this->baseURL,  $this->pageName,  $this->pageTitle);
        }
        if ($mode == 'delete') {
//        $this->db->vardump($this->foreignKeyName);
//        $this->db->vardump($this->tableName);
            echo '<h2>Delete Confirmation</h2>';
            echo $this->viewRow($this->priKeyName, $this->foreignKeyName, $this->tableName);
            echo '<br>';
            echo $this->generateDeleteForm($this->id, $this->tableName, $this->baseURL, $this->pageName);
            echo '<br>';
            echo $this->centralPageLink($this->baseURL,  $this->pageName,  $this->pageTitle);
        }
        if ($mode == 'deleteconfirmed'){
            $success = $this->deleteRow($this->id, $this->tableName);
            if ($success){
                header("Location: ".$this->baseURL.$this->pageName.'?'.$this->foreignKeyName.'='.$this->foreignKeyData);
            }
        }
        if ($mode == 'view') {
            echo '<h2>Detail </h2>';
//            $data = $this->getRow($this->priKeyName, $this->foreignKeyName, $this->tableName);
            echo $this->viewRow($id, $this->foreignKeyName, $this->tableName);
            
//            echo $this->linkToChildList($this->baseURL, $this->pageName, $this->pageTitle, $this->priKeyName, $this->parentKeyData);
//            echo '<br>Parent table(s):';
//            $this->db->vardump($this->getParentTableNames($this->tableName));
//            echo 'Child table(s):';
//            $this->db->vardump($this->getChildTableNames($this->tableName));
            echo '<br>';
            
            echo $this->centralPageLink($this->baseURL,  $this->pageName,  $this->pageTitle);
        } else    
        if (isset ($this->post['submit']) && $this->post['submit'] == 'submitEnter'.$this->tableName.'Form'){
            echo $this->insertRow($this->post);
        } else 
        if (isset ($this->post['submit']) && $this->post['submit'] == 'submitUpdate'.$this->tableName.'Form'){                
            echo 'should update now';
            echo $this->updateRow($this->post);                
        } else
        if (!isset($mode) && !isset($id)) {
            echo $this->generateList($this->listColsWanted,  $this->tableName,  $this->foreignKeyName,  $this->baseURL,  $this->pageName, $this->get,  $this->foreignKeyData);    
        }
        echo '</span>';
    }
//    function getChildTable($tableName,$priKey,$foreignKeyName,$parentKeyData) {
//        $fields = $this->getFieldNames($tableName);
//        // get tables that have columns with table name and the id as a column
//        echo $this->generateList($colsWanted, $tableName, $foreignKeyName, $parentKeyData, $baseURL, $pageName)
//    }
    /*******************
     * Action Functions
     */
    /*****************************************************************
     * CRUD Functions - list, add, edit, deleteconfirm, delete, view *
     *****************************************************************/
    function colsWanted($tableName) {// returns string of columns wanted for list
        $fieldNames = $this->getFieldNames($tableName);
        $i = 0;
        if ($fieldNames){
            foreach ($fieldNames as $field) { // create the fields that are user editable
               $fieldComment = $this->getFieldComments($field,$tableName);
               $fType = explode(" ", $fieldComment);
               if (in_array("list_item", $fType)){
                   $cols .= $field.',';
               }
            }
            $cols = ltrim(rtrim($cols, ','), ',');
        } else {
            $cols = "";
        }
        return $cols;
    }
    /*
     * delete row
     */
    function deleteRow($id, $tableName) {
        $success = $this->db->query("delete from $tableName where $this->priKeyName = '".$id."'");
        return $success;
    }
    /*
     * return field names for a given table
     */
    
    function getTables($db) {
        $my_tables = $db->get_results("SHOW TABLES",ARRAY_N);
        
        foreach ( $my_tables as $table ){
            $t[] = $table[0];
        }
//        $db->vardump($t);
        return $t;
    }
    function getFieldNames($tableName) {
//        $res = $this->db->get_results("select * from $tableName limit 1");
//        $qry = "SELECT column_name FROM information_schema.COLUMNS WHERE table_name = '".$tableName."' AND TABLE_SCHEMA = '".$this->dbName."' ";
        $qry = "desc ".$tableName;
        $res1 = $this->db->get_results($qry);
//        $flds = $this->db->col_info;
//        $this->db->vardump($res1);
        if (isset($res1)){ //if (isset($flds)){
            foreach ($res1 as $fld) {
                $fields[] = $fld->Field;
            }
        }else{
            echo ('Error: getting field names.');
        }
        return $fields;
    }
    function getChildTableNames($tableName) {
        // get this table name
        // concat with prikeyname
        $childForeignKeyName = $tableName.  $this->priKeyName;
        //check for other tables have a field with resulting name
        $tables = $this->getTables($this->db);
        foreach ($tables as $tbl) {
            $fields = $this->getFieldNames($tbl);
            if (in_array($childForeignKeyName, $fields)) {
                // add to array
                $childTables[] = $tbl;
            }
        }
        return $childTables;
    }
    function getParentTableNames($tableName) {
        // get this table name
        // get foreign key field name
        $fields = $this->getFieldNames($tableName);
        $foreignKeyFieldName = $this->getForiegnKeyFieldName($fields);
        // split up to get parent table name
        foreach ($foreignKeyFieldName as $fkeyName) {
            $k = rtrim($fkeyName, $this->priKeyName);
            if (!empty($k)){
                $tbls[] = $k;
            }
        }
        return $tbls;
    }
    function getForiegnKeyFieldName($fields) { // returns the foreign key field name from list of fields
        if (isset($fields)){
            foreach ($fields as $value) {
                if (strstr($value, $this->priKeyName)){
                    $k = rtrim($value, $this->priKeyName);
                    if (!empty($k)){ // so it doesnt pick up the record id
                        $retVal = $value; 
                        break;
                    }
                }
            }
        }
        return $retVal;
    }
    function getFieldComments($field,$tableName) {
        $qry = "SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName' AND COLUMN_NAME = '$field'";
        $res = $this->db->get_var($qry);
        return $res;
    }
    
    /*
     * confirm deletion request
     */
    function generateDeleteForm($id,$tableName,$baseURL,$pageName) {
//        echo '<a href="'.$baseURL.$pageName.'?mode=deleteconfirmed&id='.$id.'">Delete this Record</a>';
        echo '
            <form method="POST" action="'.$this->dbProcessor.'">
                <h3>Are you sure?</h3>
                <input type="hidden" name="mode" value="deleteconfirmed" />
                <input type="hidden" name="return_url" size="20" value="'.$baseURL.$pageName.'?'.$this->foreignKeyName.'='.$this->foreignKeyData.'">
                <input type="hidden" name="id" value="'.$id.'" />
                <input type="hidden" name="table" size="20" value="'.$tableName.'">
                <input type="submit" name="submit" value="Delete">
                <input type="reset" value="Cancel" onclick="window.history.back()">
            </form>';
    }
    /*
     * generate the form to add a new record
     */
    function formTextArea($name = null,$value = null,$id=null,$class=null,$form=null){
        return '<textarea name="'.$name.'" id="'.$id.'" class="'.$class.'" form="'.$form.'">'.$value.'</textarea>';
    }
    function formTextField($type=null,$name = null,$value = null,$label=null, $id=null,$class=null,$form=null,$size=null){
        if (isset($label)){$var = '<label for="'.$id.'">'. ucfirst($value) .'</label> ';}
        $var .= '<input type="'.$type.'" name="'.$name.'" id="'.$id.'" class="'.$class.'" size="'.$size.'" form="'.$form.'" value="'.$value.'">';
        return $var;
    }
    function generateAddForm($tableName,$foreignKeyName,$parentKeyData,$baseURL,$pageName){
        $fieldNames = $this->getFieldNames($tableName);
//        $this->db->vardump($fieldNames);
        $formBody = '
            <form name="enter'.$tableName.'Form" method="POST" action="'.$this->dbProcessor.'">';
        $formBody .= '
            <table cellspacing="2" cellpadding="2" border="0">';
//        for ($i = 0;$i < count($fieldNames);$i++) {            
         foreach ($fieldNames as $field) { // create the fields that are user editable
            $fieldComment = $this->getFieldComments($field,$tableName); 
            $fType = explode(" ", $fieldComment);
//            if (empty($fType[0])){
//                $this->db->vardump($fType);
//            }
            if ($field != $foreignKeyName && $field != $this->priKeyName){
                $formFieldType = 'text';
                $formBody .= '
                    <tr>';
                $formBody .= '<td><strong>'.ucfirst($field).': </strong></td>';
                
                if (isset($fType) && $fType[0] == "radio"){
                    $formCell .= '
                        <td>';
                    for ($i = 1; $i < count($fType); $i++) {
                        $formCell .= $this->formTextField("radio", $field, $fType[$i], $fType[$i],$fType[$i]);
//                        .'input type="radio" name="'.$field.'" value="'.$fType[$i].'">'.$fType[$i];
                    }
                    $formCell .= '
                        </td>';
                    $formBody .= $formCell;
                }
                if (isset($fType) && $fType[0] == "textarea") {
                    $formBody .= '<td>'.$this->formTextArea($field).'</td>';
                } 
                if ($fType[0] == "date"){
                    $formBody .= '<td>'.$this->formTextField("date",$field,date("Y-m-d")).'</td>';
                }
                if ($fType[0] == "" || $fType[0] == "list_item"){
                    $formBody .= '<td><input type="'.$formFieldType.'" name="'.$field.'" size="30" value=""></td>';
                }
                $formBody .= '
                    </tr>';
            }
        }
        $formBody .= '
            </table>
            ';
//        $this->db->vardump($parentKeyData);
        $formBody .= '
            <input type="hidden" name="'.$foreignKeyName.'" size="20" value="'.$parentKeyData.'">
            <input type="hidden" name="return_url" size="20" value="'.$baseURL.$pageName.'?'.$this->foreignKeyName.'='.$this->foreignKeyData.'">
            <input type="hidden" name="table" size="20" value="'.$tableName.'">
            <input type="submit" name="submit" value="Insert">
            <input type="reset" name="resetForm" value="Clear Form">
            ';        
        $formBody .= '</form>';
        return $formBody;
    }    
    /*
     * generate the form to edit a given record
     */
    function generateEditForm($tableName,$prikey,$foreignKeyName,$baseURL,$pageName){
        $row = $this->db->get_row("select * from $tableName where $this->priKeyName='$prikey'");
        $fieldNames = $this->getFieldNames($tableName);   
//        $rowArray = get_object_vars($row);
//        $this->db->vardump($row);
        $formBody = '<form name="edit'.$tableName.'Form" method="POST" action="'.$this->dbProcessor.'">';
        $formBody .= '<table class="table">';
//        for ($i = 0;$i < count($fieldNames);$i++) {
        foreach ($row as $key => $value) {
            if ($key == $foreignKeyName || $key ==  $this->priKeyName){
                $formFieldType = 'hidden';
            } else {
                $formFieldType = 'text';
                $formBody .= "<tr>";
                $formBody .= "<td><strong>".ucfirst($key).": </strong></td>";
                $formBody .= '<td> <input type="'.$formFieldType.'" name="'.$key.'" size="30" value="'.$value.'">  </td> ';
                $formBody .= "</tr>";
            }
        }
        foreach ($row as $key => $value) {
            if ($key == $foreignKeyName || $key == $this->priKeyName){
                $formFieldType = 'hidden';
                $formBody .= "<tr>";
                $formBody .= "<td></td>";
                $formBody .= '<td> <input type="'.$formFieldType.'" name="'.$key.'" size="30" value="'.$value.'">  </td> ';
                $formBody .= "</tr>";
            }
        }
        $formBody .= '</table>';
        $formBody .= '
            <input type="hidden" name="return_url" size="20" value="'.$baseURL.$pageName.'?'.$this->foreignKeyName.'='.$this->foreignKeyData.'">
            <input type="hidden" name="table" size="20" value="'.$tableName.'">
            <input type="submit" name="submit" value="Update">
            <input type="reset" name="resetForm" value="Clear Form">
            ';        
        $formBody .= '</form>';
        return $formBody;
    }
    function getRow($priKey,$tableName){
        return $this->db->get_row("select * from $tableName $this->priKeyName='".$priKey."'");
    }
    function viewRow($priKey,$foreignKeyName,$tableName) {
        $data = $this->db->get_row("select * from $tableName where $this->priKeyName='".$priKey."'");
//        $data = $this->getRow($priKey, $tableName);
//        $this->db->vardump($data);
        // print_r($data);die();
        $row = '<table class="table">';
        // Output the name for each column type
        foreach ($this->db->get_col_info("name") as $name ) {
            if ($data->$name != "" && $data->$name != $priKey && $data->$name != $foreignKeyName){
                $row .= '<tr><td><b>'.ucfirst($name).": </b></td><td>".$data->$name."</td></tr>";
            }
        }
        $row .= '</table>';
        return $row;
    }
    function linkToChildList($baseURL,$pageName,$pageTitle,$foreignKeyName,$parentKeyData) {
        return '<a href="'.$baseURL.$pageName.'?'.$foreignKeyName.'='.$parentKeyData.'>'.$pageTitle.'</a>';
    }
    /* 
     * generate record list table
     */
    public function getData( $tableName, $foreignKeyName, $foreignKeyData = null) {
        $qry = "select * from ".$tableName." where ".  $foreignKeyName." = '".  $foreignKeyData."' "; //.$orderByQuery.$limitQuery;
        $data = $this->db->get_results($qry);
        return $data;
            
    }
    function ownerVerified($userid,$foreignKeyData) {
        //** does fkeydata connect to current user?
        // get fkeyname
        // get native table for fkeyname
        $parentTable = substr($this->foreignKeyName, 0, -2);
        // 
        // get record with fkeydata from parent table
        $row = $this->db->get_row("select * from $parentTable $this->priKeyName = '$foreignKeyData'");
        // if record's userid matches given userid
        if ($row->userid == $userid){
            // return true
            return "yes";
        } else {
            // return false
            return "no";
        }
    }
    function generateList($colsWanted, $tableName, $foreignKeyName, $baseURL, $pageName, $vars, $parentKeyData = null) {
//        $this->db->vardump($this->get);
        if (empty($parentKeyData)){
            echo 'No parent selected';
        } else if (isset ($colsWanted) ){ //&& $this->ownerVerified($this->ownerid, $parentKeyData) == "yes"){
            $initStartLimit = 0;
            if (!isset($limitPerPage)) {
                $limitPerPage = 10;
            }
            if (isset($vars['startLimit'])) {$startLimit = $vars['startLimit'];} else {$startLimit = null;}
            if (isset($vars['rows'])) { $numberOfRows = $vars['rows']; } else {$numberOfRows = null;}
            
            if (isset($vars['sortBy'])) { $sortBy = $vars['sortBy'];} else { $sortBy = "";}
            if (isset($vars['sortOrder'])) { $sortOrder = $vars['sortOrder'];} else { $sortOrder = "";}

            if (empty($startLimit)){
                $startLimit = $initStartLimit;
            }

            if (empty($numberOfRows)){
                $numberOfRows = $limitPerPage;
            }

            if (empty($sortOrder)){
                $sortOrder  = "DESC";
            }
            if ($sortOrder == "DESC") { $newSortOrder = "ASC"; } else { $newSortOrder = "DESC"; }
            $limitQuery = " LIMIT ".$startLimit.",".$numberOfRows;
            $nextStartLimit = $startLimit + $limitPerPage;
            $previousStartLimit = $startLimit - $limitPerPage;

            if (!empty($sortBy)){
                $orderByQuery = " ORDER BY ".$sortBy." ".$sortOrder;
            } else {
                $orderByQuery = "";
            }

            $qry = "select ".$this->priKeyName.", ".$colsWanted ." from ".$tableName." where ".$foreignKeyName." = '".$parentKeyData."' ".$orderByQuery.$limitQuery;
            $data = $this->db->get_results($qry);
            
            if ($data){
                $numberOfRows = count($data);
            } 
//            if ($numberOfRows < 1) {  
            if (!isset($data)) {  
                echo "Sorry. No records found !!";
            } else {
                echo $this->crudLinkBtn(NULL, "add");
                $i=0;
//                echo $this->baseURL;
//                echo $this->pageName;
//                $prevLink = '<a href="'.$this->baseURL.$this->pageName.'?startLimit='.$previousStartLimit.'&limitPerPage='.$limitPerPage.'&sortBy='.$sortBy.'sortOrder='.$sortOrder.'">Previous '.$limitPerPage.' Results</a>';
//                $nextLink = '<a href="'.$this->baseURL.$this->pageName.'?startLimit='.$nextStartLimit.'&limitPerPage='.$limitPerPage.'&sortBy='.$sortBy.'&sortOrder='.$sortOrder.'">Next '.$limitPerPage.' Results</a>';
                $prevLink = '<a href="'.$this->baseURL.$this->pageName.'?startLimit='.$previousStartLimit.'&limitPerPage='.$limitPerPage.'">Previous '.$limitPerPage.' Results</a>';
                $nextLink = '<a href="'.$this->baseURL.$this->pageName.'?startLimit='.$nextStartLimit.'&limitPerPage='.$limitPerPage.'">Next '.$limitPerPage.' Results</a>';
                
                if ($startLimit != "" && $startLimit > 0){
//                    echo " ... ";
                    echo $prevLink;
                }
                if ($numberOfRows >= $limitPerPage){
                    echo $nextLink;
//                    echo " ... ";
                }             
//            $this->db->vardump($data);
//            if (isset($data)){
                echo '<table>';
                echo $this->listHeaderRow($data);
                echo $this->listDataRows($data,$baseURL,$pageName);
                echo '</table>';        
                if ($startLimit != "" && $startLimit > 0){
                    echo $prevLink;
//                    echo " ... ";
                }
                if ($numberOfRows >= $limitPerPage){
                    echo $nextLink;
                } 
            } 
//            else {
//                echo '<p>No records found.</p>';
//            }
            echo $this->crudLinkBtn(NULL, "add"); //'[ <a href="'.$baseURL.$pageName.'?mode=add">Add +</a> ]';
        }
    }
    function listHeaderRow($data) {
        if (isset($data)){
            $row = "";
            foreach ($data as $val) {
                foreach ($val as $key => $value){
                    if ($key != $this->priKeyName){
                        $row = $row."<td><strong>".ucwords($key)."</strong></td>";
                    }
                }   
                break;
            }
            return '<tr>'.$row.'</tr>';
        } else {
            return NULL;
        }
        
    }
    function centralPageLink($baseURL,$pageName,$pageTitle){
        return '<p> Go to '.'<a href="'.$baseURL.$pageName.'?'.$this->foreignKeyName.'='.$this->foreignKeyData.'">'.$pageTitle.'</a> list</p>';
    }   
    function listDataRows($data,$baseURL,$pageName) {
        $i = 0;
//        $this->db->vardump($data);
        $row = "";
        if (isset($data)){
            foreach ($data as $val) {
                if (($i%2)==0) { $bgColor = "1"; } else { $bgColor = "2"; }
                $row .= '<tr>';
                foreach ($val as $key => $value){
                    if ($key != $this->priKeyName){
                        $row .= '<td class="content'.$bgColor.'">
                                    <a href="'.$baseURL.$pageName.'?mode=view&id='.$id.'">'.$value.'</a>
                                </td>';
                    }
                    if ($key == $this->priKeyName) {
                        $id = $value;
                    }
                }   
                $row .= '<td class="button'.$bgColor.'">'.$this->crudLinkBtn($id, "edit").'</td>';
                $row .= '<td class="button'.$bgColor.'">'.$this->crudLinkBtn($id, "delete").'</td>';
                $row .= "</tr>";
                $i++;
            }
            return $row;
        } else {
            return NULL;
        }
    }
//    function getRowItem($page,)
    function insertRow($vars) { // takes an array
        $qry = $this->insertQuery($vars, $vars["table"], $this->db);
        $r = $this->db->query($qry);
//        $this->db->vardump($r);
//        echo '<meta http-equiv="refresh" content="0;">';
        exit();
    }
    function insertQuery($vars,$table,$db) {
//        $this->db->vardump($vars);
        $j=1;
        $metaKeys = array($this->baseURL.$this->pageName,  $this->tableName,  $vars["submitEnter".$this->tableName."Form"]);
        $tableValues = array_diff($vars, $metaKeys);
        foreach ($tableValues as $key => $value){
            if (!empty($value)){
                $cols = $cols.  $this->db->escape($key).',';
                $vals = $vals."'".$this->db->escape($value)."',";
            }
        }
        $cols = rtrim($cols, ',');
        $vals = rtrim($vals, ',');
        $qry = "insert into ".$table." (".$cols.") values (".$vals.")";
        return $qry;    
    }
    function updateRow($vars) {
//        $this->db->vardump($this->post);
        $qry = $this->updateQuery($vars);
        $success = $this->db->query($qry);
        if ($success){
//            <meta http-equiv="refresh" content="30; ,URL=http://www.metatags.org/login">
//            echo '<meta http-equiv="refresh" content="0;">';
            wp_redirect($this->baseURL.$this->pageName.'?'.$this->foreignKeyName.'='.$this->foreignKeyData);
//            exit();
//            header('Location: '.$vars["return_url"]);
        }
    }
    function updateQuery($vars) {
        $j=0;
        $metaKeys = array($this->priKeyName,  $this->baseURL.$this->pageName,  $this->tableName,  $this->foreignKeyName, $vars["submitUpdate".$this->tableName."Form"]);
        $metaCount = count($metaKeys);
        $setString = "";
        foreach ($vars as $key => $value){
            if ($j <= $metaCount){
                if (!empty($value)){
                    $setString = $setString.$key." = '".$value."',";
                }
            }
            $j++;
        }
        $setString = rtrim($setString, ',');
        $whereCond = "$this->priKeyName = ".$vars["id"];
        $qry = "update ".$vars["table"]." set ".$setString." ".$whereCond;
        return $qry;    
    }
    /**
     * use to replace links with form buttons
     * @param string $baseURl, $pageName, $rowid
     */
    function crudLinkBtn($id,$modeValue) {
        return '      <form method="POST" action="'.  $this->baseURL.  $this->pageName.'">
                        <input type="hidden" name="mode" value="'.$modeValue.'" />
                        <input type="hidden" name="id" value="'.$id.'" />
                        <input type="hidden" name="'.$this->foreignKeyName.'" value="'.$this->foreignKeyData.'" />
                        <span class="crud"><input type="submit" name="submit" value="'.ucfirst($modeValue).'"></span>
                    </form>';
        
    }
    
    /**
     * returns number of rows
     * @param string $tableName,$foreignKeyName,$parentKeyData
     */
    function getNumRows($tableName,$foreignKeyName,$parentKeyData) {
        $qry = "select count(*) from ".$tableName." where ".$foreignKeyName." = '".$parentKeyData."' ";
        $numRows = $this->db->get_var($qry);
        return $numRows;
    }
}

?>