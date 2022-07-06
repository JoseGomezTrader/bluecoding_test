PHP Version: PHP 7.2
Database Engine: MySQL

COMMAND TO CREATE TABLE REQUIRED TO WORK: 
CREATE TABLE url (
    id MEDIUMINT NOT NULL AUTO_INCREMENT, 
    title VARCHAR(255), 
    redirecto VARCHAR(255) NOT NULL, 
    code VARCHAR(255) NOT NULL, 
    counter INT DEFAULT 0, 
    timecreated INT, 
    timemodified INT,
    PRIMARY KEY (id)
    );

CONFIGURING THE DATABASE
- Go to the file classes/Database.php 
- Setting every constant defined in the top of the file

ENDPOINTs:
- To redirect: url.php?code=<CODE TO REDIRECT>
- To create a short url: shorter.php?url=<URL TO SHORT>
- To list 100 most frecuently: top.php
- Script to populate the title field in url table: queue.php