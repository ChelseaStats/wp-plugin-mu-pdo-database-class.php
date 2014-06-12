###### wp-plugin-mu-pdo-database-class.php

> A PDO database extraction layer as a mu-plugin for WP


Example usage to get one row of data, with bind variable

    $database = new Database();
    $database->query('SELECT name, dob FROM `users` WHERE F_ID = :id');
    $database->bind(':id', $id);
    $row 	= $database->single();
    $name = $row[name];
    $dob  = $row[dob];


step 2
