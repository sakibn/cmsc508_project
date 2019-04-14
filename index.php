<html>
<head>
<style>
    table, th, td {
        border: 1px solid black;
        text-align: center;
    }
    
    ul{
        list=style-type: none;
        margin: 0;
        padding: 0;
        border: 1px solid #555;
    }
    li{
        text-align: center;
        border-bottom: 1px solid #555;
    }
    li:last-child{
        border-bottom: none;
    }
    li a{
        display: black;
        width: 60px;
    }
    li a:hover{
        background-color: #555;
        color: white;
    }
    .active{
        background-color: #4CAF50;
        color: white;
    }
</style>
</head>
<body>

<?php
require "header.php";
?>
<section id="c3" class="main-container">
    <div class="main-wrapper">
        <h2 style="color: red">Home</h2>
        
        <?php if(isset($_SESSION['username'])): ?>
            <ul>
                <li><a href="database.php">Database/excel</a></li>
                <li><a href="users.php">User access</a></li>
                <li><a href="inventory.php">Available Inventory</a></li>
                <li><a href="reservation.php">Reservation Form</a></li>
            </ul>
        <?php endif; ?>
        
    </div>
</section>
</body>
</html>