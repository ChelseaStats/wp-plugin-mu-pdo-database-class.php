#### wp-plugin-mu-pdo-database-class.php

> A PDO database extraction layer as a mu-plugin for WP

##### Why?

sometimes in a WordPress theme (custom page template) you might want to access other database tables to do something non-wordpressy.

##### How?

This uses the default define in your `wp-config.php` to connect, it's then just a matter of using the class like the example below to do your work in your custom template or child themes etc.

##### Example usage to get one row of data, with bind variable

    $database = new pdodb();
    $database->query('SELECT name, dob FROM `users` WHERE F_ID = :id');
    $database->bind(':id', $id);
    $row 	= $database->row();
    $name = $row['name'];
    $dob  = $row['dob'];
    
##### Example usage to get all rows of data

    $database = new pdodb();
    $database->query('SELECT name FROM `users`');
    $rows 	= $database->rows();
    foreach($rows as $row) {
        print $row['name'] .'<br/>';
    }
