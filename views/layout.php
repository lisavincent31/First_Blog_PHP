<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon premier blog en PHP</title>
        
        <!-- Styles CSS and Bootstrap -->
        <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'bootstrap.min.css' ?>">
    </head>
    <body>
        <?php if(!str_contains($_SERVER['QUERY_STRING'], QUERY.'auth')) : ?>
        <!-- Navbar -->
        <div class="bs-component mb-4">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand w-50" href="<?= URL ?>">Lisa VINCENT</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse w-50" id="navbarColor03">
                        <ul class="navbar-nav me-auto w-100 justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link <?php if($_SERVER['QUERY_STRING'] === QUERY) :  ?> active <?php endif ?>" href="<?= URL ?>">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(str_contains($_SERVER['QUERY_STRING'], QUERY.'posts/')) :  ?> active <?php endif ?>" href="<?= URL . 'posts/' ?>">Blog</a>
                            </li>
                            <!-- L'utilisateur est connecté -->
                            <?php if(isset($_SESSION['auth'])) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bienvenu <?= $_SESSION['user']['firstname'] ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
                                    <?php if($_SESSION['auth'] == 1) : ?>
                                    <li><a class="dropdown-item" href="<?= URL.'admin/dashboard/' ?>">Tableau de bord</a></li>
                                    <?php elseif($_SESSION['auth'] == 0) : ?>
                                    <li><a class="dropdown-item" href="<?= URL.'user/dashboard/' ?>">Tableau de bord</a></li>
                                    <?php endif ?>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= URL.'logout/' ?>">Se déconnecter</a></li>
                                </ul>
                            </li>
                            <?php endif ?>
                            <?php if(!isset($_SESSION['auth'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(str_contains($_SERVER['QUERY_STRING'], QUERY.'auth/login')) :  ?> active <?php endif ?>" href="<?= URL . 'auth/login' ?>">Se connecter</a>
                            </li>
                            <?php endif ?>  
                        </ul>
                    </div>
                </div>
            </nav>
        </div><!-- End Navbar -->
        <?php endif ?>
        <!-- Content -->
        <div class="container">
            <!-- Session Errors -->
            <div class="row mt-3 p-0">
                <?php if(isset($_SESSION['errors'])) : ?>
                    <div class="col-md-10 m-auto"></div>
                        <div class="alert alert-danger d-flex justify-content-between align-items-center">
                            <div>
                                <?php foreach($_SESSION['errors'] as $errorsArray) : ?>
                                    <?php foreach($errorsArray as $error) : ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <?= $content ?>
        </div><!-- End Content -->
        <!-- Scripts Javascript and Bootstrap -->
        <script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'app.js' ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>