<?php
include_once 'DbConfig.php';

class PersonController extends DbConfig
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function create($name, $age, $email)
    {
        $query = "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')";

        $result = $this->connection->query($query);

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return true;
        }
    }

    public function read()
    {
        $data = [];

        $query = "SELECT * FROM users ORDER BY id DESC";

        $result = $this->connection->query($query);

        if ($result == false) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function update($id, $name, $age, $email)
    {

        $query = "UPDATE users SET name='$name',age='$age',email='$email' WHERE id=$id";

        $result = $this->connection->query($query);

        if ($result == false) {
            echo 'Error: cannot update user ' . $name . ' from table users';
            return false;
        } else {
            return true;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = $id";

        $result = $this->connection->query($query);

        if ($result == false) {
            echo 'Error: cannot delete id ' . $id . ' from table users';
            return false;
        } else {
            return true;
        }
    }

    public function details($id)
    {

        $query = "SELECT * FROM users WHERE id= $id";

        $result = $this->connection->query($query);

        if ($result == false) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }

        return $data;
    }

    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }
}
