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
    <main class="login-layout">
        <section class="login-layout__showcase">
            <div class="login-showcase__overlay"></div>
            <div class="login-showcase__content">
                <span class="login-showcase__tag">Doodle Poultry</span>
                <h1 class="login-showcase__headline">Manage your poultry operations with confidence</h1>
                <p class="login-showcase__description">Track bird health, monitor feed, and stay aligned with production goals in one secure dashboard.</p>
                <ul class="login-showcase__features">
                    <li><span aria-hidden="true">&#10003;</span><span>Daily flock and mortality updates</span></li>
                    <li><span aria-hidden="true">&#10003;</span><span>Automated feed consumption monitoring</span></li>
                    <li><span aria-hidden="true">&#10003;</span><span>Sales insights for smarter decisions</span></li>
                </ul>
            </div>
        </section>

        <section class="login-layout__form">
            <div class="login-panel">
                <header class="login-panel__header">
                    <span class="login-panel__logo" aria-hidden="true">DP</span>
                    <div class="login-panel__heading-group">
                        <h2 class="login-panel__title">Sign in to Doodle Poultry</h2>
                        <p class="login-panel__subtitle">Enter your administrator credentials to continue</p>
                    </div>
                </header>
                <?php if(!empty($message)) { ?>
                    <div class="login-panel__alert" role="alert"><?php echo $message; ?></div>
                <?php } ?>
                <form class="login-panel__form" action="" method="post" novalidate>
                    <div class="login-field">
                        <label class="login-field__label" for="Username">Username</label>
                        <input class="login-field__input" id="Username" type="text" name="Username" placeholder="Enter username" autocomplete="username">
                    </div>
                    <div class="login-field">
                        <label class="login-field__label" for="Password">Password</label>
                        <input class="login-field__input" id="Password" type="password" name="Password" placeholder="Enter password" autocomplete="current-password">
                    </div>
                    <button class="login-panel__button" type="submit" name="login">Sign in</button>
                </form>
                <footer class="login-panel__footer">
                    <p>Need access? Please contact your system administrator.</p>
                </footer>
            </div>
        </section>
    </main>
</body>
</html>
