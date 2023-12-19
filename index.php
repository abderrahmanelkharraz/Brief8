
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->


</head>
<body> 
<section class="bg-blue-500 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-16">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Sign in to your account
                </h1>
                <form class="space-y-4 md:space-y-6 " action="taches.php">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <a href="taches.php" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Login to your account </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

  </section>
</body>
</html> 

<?php

include 'connection.php';

class UserAuthenticator
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function authenticateUser($email, $password)
    {
        $select = "SELECT * FROM utilisateurs WHERE email = ? AND password = ?";
        
        // Using prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($this->conn, $select);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_num_rows($result);

            if ($row > 0) {
                $fetch = mysqli_fetch_array($result);

                if ($fetch["utilisateur"] == "utilisateur") {
                    header("Location: taches.php");
                    exit();
                }
            } else {
                $erreur = "L'adresse e-mail ou le mot de passe que vous avez saisi(e) n’est pas associé(e) à un compte.";
            }
        } else {
            $erreur = "Erreur de requête SQL: " . mysqli_error($this->conn);
        }
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create an instance of UserAuthenticator
    $userAuthenticator = new UserAuthenticator($conn);

    // Authenticate the user
    $userAuthenticator->authenticateUser($email, $password);
}

?>

