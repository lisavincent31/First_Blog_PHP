<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 Error</title>

        <!-- CSS and Bootstrap -->
        <link href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    </head>
    <body>
        <section class="page_404">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="col-sm-10 col-sm-offset-1  text-center">
                            <div class="four_zero_four_bg">
                                <h1 class="text-center ">Erreur 404</h1>
                            </div>

                            <div class="contant_box_404">
                                <h3 class="h2">
                                    Vous avez l'air perdu
                                </h3>

                                <p>la page que vous recherchez n'est pas disponible !</p>

                                <a href="<?= URL ?>/" class="link_404 text-decoration-none">Go to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Script Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>