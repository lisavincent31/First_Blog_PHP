<?php if(isset($_SESSION['errors'])) : ?>
    <?php foreach($_SESSION['errors'] as $errorsArray) : ?>
        <?php foreach($errorsArray as $error) : ?>
            <div class="alert alert-danger">
                <li><?= $error ?></li>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endif ?>
<?php session_destroy() ?>
<div class="row container-anim">
    <div class="col-md-10 col-lg-8 m-auto border shadow my-5 p-3">
        <h1 class="text-center">Inscription</h1>
        <form action="<?= URL.'auth/signup' ?>" class="form my-5" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom" required>
                <label for="firstname">Prénom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom de famille" required>
                <label for="lastname">Nom de famille</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
                <label for="password">Mot de passe</label>
            </div>
            <button class="btn btn-primary float-start mt-5" type="submit">S'inscrire</button>
        </form>
        <a href="<?= URL.'auth/login' ?>" class="btn btn-outline-primary float-end">Connexion</a>
    </div>
</div>