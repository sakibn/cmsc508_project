<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        V-haul
    </title>
    <link rel="stylesheet" href="../../css/login_registration.css">
</head>
<body>
<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li><a href="../../index.php">Home</a></li>
            </ul>
            <div class="nav-login">
                <?php
                if (isset($_SESSION['username'])) {
                    echo ' <h1  class="greetings"> Hello '.$_SESSION['username'].'</h1>
                <form action="../../includes/logout.inc.php" method="post">
                    <button style="position: relative;top: -11px;left: -11px;" type="submit" name="logout-submit" class="greetings">Logout</button>                 
                </form>';
                } else {
                    echo '<form action="../../includes/login.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>                   
                </form>';
//                <form action="registration.php">
//                    <button type="submit" name="registration">Signup</button>
//                </form>
                }
                ?>

            </div>
        </div>
    </nav>
</header>