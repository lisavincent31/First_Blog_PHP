<?php if(isset($_GET['success'])) : ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <div class="d-flex align-items-center">
            <?php if(isset($_SESSION['message'])) : ?>
                <p><?= $_SESSION['message'] ?></p>
            <?php endif ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<!-- Header -->
<header class="py-5 bg-image-full" style="background-image:url('<?= SCRIPTS.'/images/bg/bg-2.jpg' ?>')">
    <div class="text-center my-5">
        <div class="container d-flex justify-content-center align-items-center mb-3">
            <img class="img-fluid rounded-circle mx-4" src="<?= SCRIPTS.'images/avatar/admin.jpg' ?>" alt="..." width="50px">
            <h1 class="text-white fs-3 fw-bolder">Lisa VINCENT</h1>
        </div>
        <h2 class="text-white">Développeuse d'applications web</h2>
    </div>
</header>
<!-- Content section-->
<section class="py-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h4 class="mb-0">Explorez le monde passionnant de la création d'applications web.</h4>
                <p class="lead">Envie d'un site web pour développer votre activité ?</p>
                <p class="mb-0">Remplissez le formulaire de contact ci-dessous, je vous répondrais dans les plus bref délais.</p>
            </div>
        </div>
    </div>
</section>
<!-- <div class="py-5 bg-image-full" style="background-image:url('')"> -->
<div class="py-5 border-top border-bottom shadow">
    <div class="container">
        <div class="row py-auto networks">
            <div class="col-md-6 text-center">
                <h3 class="mb-5">Téléchargez mon CV</h3>
                <a href="<?= SCRIPTS.'/pdf/cv-lisavincent.pdf' ?>" download>
                    <i class="bi bi-file-earmark-arrow-down"></i>
                </a>
            </div>
            <div class="col-md-6 text-center">
                <h3 class="mb-5">Mes réseaux</h3>
                <ul class="nav justify-content-evenly list-unstyled d-flex">
                    <li class="ms-3">
                        <a href="https://github.com/lisavincent31" target="_blank">
                            <i class="bi bi-github"></i>
                        </a>
                    </li>
                    <li class="ms-3">
                        <a href="https://www.linkedin.com/in/lisa-vincent-dev/?originalSubdomain=fr" target="_blank">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Content section-->
<section class="py-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h3>Formulaire de contact</h3>
                <form action="<?= URL. 'contact' ?>" method="post">
                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom">
                        <label for="name">Votre nom</label>
                    </div>
                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Votre email">
                        <label for="email">Votre email</label>
                    </div>
                    <div class="form-group form-floating mb-3">
                        <textarea type="text" class="form-control" name="message" id="message" col="6" row="6" placeholder="Votre message"></textarea>
                        <label for="message">Votre message</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
        