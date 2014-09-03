#### wp-plugin-mu-pdo-database-class.php

> A PDO database extraction layer as a mu-plugin for WP

##### Why?

sometimes in a WordPress theme (custom page template) you might want to access other database tables to do something non-wordpressy.

##### How?

This uses the default define in your `wp-config.php` to connect, it's then jsut a matter of using the class like the example below to do your work.

##### Example usage to get one row of data, with bind variable

    $database = new Database();
    $database->query('SELECT name, dob FROM `users` WHERE F_ID = :id');
    $database->bind(':id', $id);
    $row 	= $database->single();
    $name = $row[name];
    $dob  = $row[dob];
