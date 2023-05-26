<div class="container p-4">
    <?php if(isset($_GET['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <div class="d-flex align-items-center">
                <p><?= $_SESSION['success'] ?></p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <div class="col-10 m-auto m-2 p-3 text-center">
        <h1><?= $params['post']->title ?></h1>
        <small><?= $params['post']->chapo ?></small>
    </div>
    <div class="row bg-white p-2">
        <div class="col-10 m-auto">
            <p class="lead mt-3 text-justify"><?= $params['post']->content ?></p>
            <div class="d-flex justify-content-between">
                <small class="d-flex align-items-center">
                    <img src="<?= SCRIPTS . '/images/avatar/admin.JPG' ?>" alt="Avatar de l'administrateur" class="rounded-circle" width="35px" height="35px">
                    <span class="mx-2"><?= $params['author']->getFullName() ?></span>
                </small>
                <small class="text-muted">Modifié le : <?= $params['post']->getUpdatedAt() ?></small>
            </div>
        </div>
        <div class="border-top mt-4"></div>
    </div>
    <div class="row">
        <a href="<?= URL . 'posts/' ?>" class="btn btn-outline-primary float-end my-3 col-3 float-end">Revenir au blog</a>
    </div>
</div>