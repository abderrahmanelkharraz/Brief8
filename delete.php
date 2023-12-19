<?php

include 'connection.php';

class TaskDeleter
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function deleteTask($id)
    {
        $sql = "DELETE FROM `taches` WHERE id = $id";

        $result = mysqli_query($this->con, $sql);

        if ($result) {
            header('location:taches.php');
        } else {
            die(mysqli_error($this->con));
        }
    }
}

// Check if 'deleteid' is set in the query string
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    // Create an instance of TaskDeleter
    $taskDeleter = new TaskDeleter($con);

    // Delete the task
    $taskDeleter->deleteTask($id);
}

?>

