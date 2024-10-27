<?php
    include("menu.php");
    include("style.php");
    
?>


CREATE TABLE client (
    clientnumber VARCHAR(20) PRIMARY KEY,
    clientfirstname VARCHAR(50) NOT NULL,
    clientmiddlename VARCHAR(50),
    clientlastname VARCHAR(50) NOT NULL,
    clientaddress VARCHAR(100) NOT NULL
);
