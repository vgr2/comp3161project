<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include './ProcessVCrud.php';

include './setup.php';

$process = new ProcessVCrud($_POST, $db);

$process->action();

?>
