<nav>
    <ul>
    <li><a href="<?php ROOT ?>/">Home</a></li>
    <?php
            if( isset($_SESSION["user_id"]) ){           
    ?>
            <li><a href="<?= ROOT ?>/logout/">Logout</a></li>
    <?php
            }
            else{
    ?>
            <li><a href="<?= ROOT ?>/login/">Login</a></li>
            <li><a href="<?= ROOT ?>/register/">Registre-se</a></li>
    <?php
            }
    ?>
    </ul>
</nav>