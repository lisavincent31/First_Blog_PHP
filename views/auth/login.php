<div class="row container-anim m-0">
    <div class="col-md-10 col-lg-8 m-auto border shadow my-5 p-3">
        <h1 class="text-center">Connexion</h1>
        <form action="<?= URL.'auth/login' ?>" class="form my-5" id="loginForm" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
                <label for="password">Mot de passe</label>
            </div>
            <button class="btn btn-primary float-start mt-5" type="submit">Se connecter</button>
        </form>
        <a href="<?= URL.'auth/signup/' ?>" class="btn btn-outline-primary float-end">Inscription</a>
    </div>
</div>