<?php
 //including the database connection file
include_once("classes/PersonController.php");

$person_object = new PersonController();

//getting id of the data from url
$id = $person_object->escape_string($_GET['id']);

//deleting the row from table
//$result = $crud->execute("DELETE FROM users WHERE id=$id");
$result = $person_object->delete($id);

if ($result) {
    //redirecting to the display page (index.php in our case)
    header("Location:index.php");
}
 