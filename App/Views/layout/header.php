<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php url("assets/css/todolist.css?t=" . time()) ?>>
    <link rel="stylesheet" href=<?php url("assets/css/bootstrap.min.css") ?>>
    <link rel="stylesheet" href=<?php url("assets/css/all.min.css") ?>>
    <title><?php echo ucwords($pageName) ?></title>
</head>

<body class="bg-dark text-light">
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?php url() ?>">MVC</a>

                <?php
                session_start();
                if (isset($_SESSION['username'])) :
                ?>

                    <ul class="navbar-nav ms-auto mb-lg-0">
                        <li class='nav-item dropdown-center'>
                            <button class=" bg-dark text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">

                                <?php echo $_SESSION['username'] ?>

                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="<?php url('users/profile') ?>">Profile</a></li>
                                <li><a class="dropdown-item" href="<?php url('users/logout') ?>">Log out</a></li>
                            </ul>
                        </li>
                    </ul>

                <?php else : ?>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav ms-auto mb-lg-0">

                            <?php foreach ($nav as $item) : ?>

                                <li class='nav-item'>
                                    <a class='nav-link text-light' href="<?php url('users/' . str_replace(' ', '', $item)) ?>"> <?php echo ucwords($item) ?> </a>
                                </li>

                        <?php
                            endforeach;
                        endif;
                        ?>

                        </ul>
                    </div>
            </div>
        </nav>
    </header>