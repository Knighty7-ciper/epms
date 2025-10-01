<?php
    include 'includes/database.php';
    include 'includes/loginServer.php';
    session_start();
    // instantiating LoginServer class to access its functions/methods
    $data = new LoginServer();
    // variable to store message
    $message = "";
    // check if login was clicked
    if(isset($_POST["login"])){
        $field = array(
            "Username" => $_POST["Username"],
            "Password" => $_POST["Password"]
        );
        if($data->loginValidation($field)){
            if($data->canLogin("User", $field)){
                $_SESSION["Username"] = $_POST["Username"];
                header("location: dashboard.php");
            }else{
                $message = $data->error;
            }
        }else{
            // if input fields are blank, execute else statement: if both input fields are blank
            $message = $data->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./loginStyles.css" />
    <title>Doodle Poultry Login</title>
</head>
<body>
    <main class="auth__page">
        <section class="auth__card">
            <header class="auth__header">
                <h1 class="auth__title">Doodle Poultry</h1>
                <p class="auth__subtitle">Admin sign in</p>
            </header>
            <?php
                if(isset($message)){
                    echo '<div class="auth__alert">' . $message . '</div>';
                }
            ?>
            <form class="auth__form" action="" method="post" novalidate>
                <div class="form__group">
                    <label for="Username">Username</label>
                    <input id="Username" type="text" name="Username" placeholder="Enter username" autocomplete="username">
                </div>
                <div class="form__group">
                    <label for="Password">Password</label>
                    <input id="Password" type="password" name="Password" placeholder="Enter password" autocomplete="current-password">
                </div>
                <button class="button button--primary" type="submit" name="login">Login</button>
            </form>
        </section>
    </main>
</body>
</html>
