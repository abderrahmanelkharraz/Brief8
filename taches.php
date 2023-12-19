<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de taches</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body> 

<div class=" m-4 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-blue-800 dark:text-blue-100">
        <thead class="text-xs text-white uppercase bg-blue-800 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    titre
                </th>
                <th scope="col" class="px-6 py-3">
                    description
                </th>
                <th scope="col" class="px-6 py-3">
                    date_echeance
                </th>
                <th scope="col" class="px-6 py-3">
                    complet
                </th>
                <th scope="col" class="px-6 py-3">
                    action
                </th>
            </tr>
        </thead>
        <tbody>
        <?php

include 'connection.php';

class Task
{
    public $id;
    public $titre;
    public $description;
    public $date_echeance;
    public $complet;

    public function __construct($id, $titre, $description, $date_echeance, $complet)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_echeance = $date_echeance;
        $this->complet = $complet;
    }

    public function getCompletionStatus()
    {
        return ($this->complet == 1) ? 'Complete' : 'Incomplete';
    }
}

class TaskManager
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function getAllTasks()
    {
        $tasks = [];

        $sql = "SELECT * FROM taches";
        $result = mysqli_query($this->con, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $task = new Task(
                    $row['id'],
                    $row['titre'],
                    $row['description'],
                    $row['date_echeance'],
                    $row['complet']
                );

                $tasks[] = $task;
            }
        }

        return $tasks;
    }
}

// Create an instance of TaskManager
$taskManager = new TaskManager($con);

// Get all tasks
$tasks = $taskManager->getAllTasks();

// Display tasks
foreach ($tasks as $task) {
    echo '<tr>
            <th scope="row">' . $task->id . '</th>
            <td>' . $task->titre . '</td>
            <td>' . $task->description . '</td>
            <td>' . $task->date_echeance . '</td>
            <td>' . $task->getCompletionStatus() . '</td>
            <td class="px-6 py-4">
                <a href="update.php?updateid=' . $task->id . '" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
                <a href="delete.php?deleteid=' . $task->id . '" class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
            </td>
          </tr>';
}

?>

        </tbody>
    </table>
</div>
<a href="insertion.php" class="m-4 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-900 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
    Inserer une tache </a>
</body>
</html> 