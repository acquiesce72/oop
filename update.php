<?php
// including the database connection file
include_once("classes/PersonController.php");
include_once("classes/Validation.php");

$person_object = new PersonController();

//getting id from url
$id = $person_object->escape_string($_GET['id']);

//selecting data associated with this particular id
$person = $person_object->details($id);

?>

<?php

$person_object = new PersonController();
$validation_object = new Validation();

if (isset($_POST['update'])) {
    $id = $person_object->escape_string($_POST['id']);
    $name = $person_object->escape_string($_POST['name']);
    $age = $person_object->escape_string($_POST['age']);
    $email = $person_object->escape_string($_POST['email']);

    $msg = $validation_object->check_empty($_POST, array('name', 'age', 'email'));
    $check_age = $validation_object->is_age_valid($_POST['age']);
    $check_email = $validation_object->is_email_valid($_POST['email']);

    // checking empty fields
    if ($msg) {
        echo $msg;
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } elseif (!$check_age) {
        echo 'Please provide proper age.';
    } elseif (!$check_email) {
        echo 'Please provide proper email.';
    } else {
        //updating the table
        $result = $person_object->update($id, $name, $age, $email);

        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    }
}

?>

<html>

</html>

<head>
    <title>Edit Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="form1" method="post" action="update.php">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $person['name']; ?>"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="age" value="<?php echo $person['age']; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $person['email']; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>