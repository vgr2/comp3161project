<?php

      $dbHostname = "localhost";
      $dbUsername = "root";
      $dbPassword = "crunch";
      $dbName     = "socialdb";      
       
      //  Make connection to database 
      //  If no connection made, display error Message          
      $dblink = MYSQL_CONNECT($dbHostname, $dbUsername, $dbPassword) OR DIE("Error !! Unable to connect to database");       

      // Select the database name to be used or else print error message if unsuccessful*/
      @mysql_select_db($dbName) or die( "Unable to select database ".$dbName); 

?>