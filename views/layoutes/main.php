<?php

use app\core\Application;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title><?php echo $this->title ?? 'Page Name' ?> </title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">K-MVC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>

                <?php if (auth()->check()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (auth()->check()): ?>
                <b> Hello <?php echo app()->session->get('userName') ?></b>
            <?php endif; ?>

            <?php if (!auth()->check()): ?>
                <form class="d-flex">
                    <a class="nav-link active" aria-current="page" href="/login">Login</a>
                    <a class="nav-link active" aria-current="page" href="/register">Register</a>
                </form>
            <?php endif; ?>
            <?php if (auth()->check()): ?>
                <form class="d-flex">
                    <a class="nav-link active" aria-current="page" href="/logout">logout</a>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container p-3">
    <?php if (Application::$instance->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Application::$instance->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    {{content}}
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
