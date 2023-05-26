<div class="row container-anim">
    <div class="anim-card" id="auth">
        <div class="front face" id="login">
            <h1>Connexion</h1>
            <div class="col-10 m-auto">
                <form action="" class="form my-5" id="loginForm">
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
            </div>
            <div class="col-10 m-auto">
                <button class="btn btn-outline-primary livedemo float-end">Inscription</button>
            </div>
        </div>
        <div class="back face" id="signup">
            <h1>Inscription</h1>
            <div class="col-10 m-auto mb-4">
                <form action="" class="form my-5" id="signupForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom" required>
                        <label for="firstname">Prénom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom de famille" required>
                        <label for="lastname">Nom de famille</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="S-email" id="S-email" placeholder="Email" required>
                        <label for="S-email">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="S-password" id="S-password" placeholder="Mot de passe" required>
                        <label for="S-password">Mot de passe</label>
                    </div>
                    <button class="btn btn-primary float-start mt-5" type="submit">S'inscrire</button>
                </form>
            </div>
            <div class="col-10 m-auto">
                <button class="btn btn-outline-primary livedemo float-end">Connexion</button>
            </div>
        </div>
    </div>
</div>