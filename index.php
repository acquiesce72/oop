<?php
//including the database connection file
include_once("classes/PersonController.php");

$person_object = new PersonController();

$people = $person_object->read();
//echo '<pre>'; print_r($result); exit;

?>

<html>

<head>
    <title>Homepage</title>
</head>

<body>
    <a href="create.php">Add New Data</a><br /><br />

    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td>Name</td>
            <td>Age</td>
            <td>Email</td>
            <td>Update</td>
        </tr>
        <?php
        foreach ($people as $person) {
            //while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>" . $person['name'] . "</td>";
            echo "<td>" . $person['age'] . "</td>";
            echo "<td>" . $person['email'] . "</td>";
            echo "<td><a href=\"update.php?id=$person[id]\">Edit</a> | <a href=\"delete.php?id=$person[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
        ?>
    </table>
</body>

</html>