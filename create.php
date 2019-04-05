<html>

<head>
    <title>Add Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form action="create.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="age"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
</body>

</html>

<?php
 //including the database connection file
include_once("classes/PersonController.php");
include_once("classes/Validation.php");

$person_object = new PersonController();
$validation_object = new Validation();

if (isset($_POST['Submit'])) {
    $name = $person_object->escape_string($_POST['name']);
    $age = $person_object->escape_string($_POST['age']);
    $email = $person_object->escape_string($_POST['email']);

    $msg = $validation_object->check_empty($_POST, array('name', 'age', 'email'));
    $check_age = $validation_object->is_age_valid($_POST['age']);
    $check_email = $validation_object->is_email_valid($_POST['email']);

    // checking empty fields
    if ($msg != null) {
        echo $msg;
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } elseif (!$check_age) {
        echo 'Please provide proper age.';
    } elseif (!$check_email) {
        echo 'Please provide proper email.';
    } else {
        // if all the fields are filled (not empty) 

        //insert data to database    
        $result = $person_object->create($name, $age, $email);

        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}
