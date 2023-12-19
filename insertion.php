

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title> Insertion des taches</title>
</head>
<body>  

<form method="post" action="#">

    <div class=" gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="titre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre de la tâche</label>
            <input type="text" name="titre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
        </div>
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de la tâche</label>
            <input type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
        </div>
        <div>
            <label for="date_echeance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date d'échéance</label>
            <input type="date" name="date_echeance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>  

    <button type="submit" class="m-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit">Submit</button>
</form>


</body>
</html> 
<?php

include 'connection.php';

class TaskCreator
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function createTask($titre, $description, $date_echeance, )
    {
        $sql = "INSERT INTO taches (titre, description, date_echeance, complet,) 
            VALUES ('$titre', '$description', '$date_echeance', 0, )";

        $result = mysqli_query($this->con, $sql);

        if ($result) {
            header('location:taches.php');
        } else {
            die(mysqli_error($this->con));
        }
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_echeance = $_POST['date_echeance'];

    // Create an instance of TaskCreator
    $taskCreator = new TaskCreator($con);

    // Create the task
    $taskCreator->createTask($titre, $description, $date_echeance, );
}

?>
