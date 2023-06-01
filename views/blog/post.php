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
        <div class="col-10 m-auto">
            <div class="mt-4">
                <h3>Commentaires :</h3>
                <?php if(count($params['post']->getComments()) == 0): ?>
                    <p>Il n'y a pas encore de commentaires pour cet article.</p>
                <?php endif ?>
                <table class="table">
                    <tbody>
                        <?php foreach($params['post']->getComments() as $comment) : ?>
                            <tr class="row">
                                <td class="card-text col-7"><?= $comment->content ?></td>
                                <td class="card-text col-2">
                                    <span class="float-end">_ <?= $comment->getCommentAuthor((int) $comment->id) ?></span>
                                </td>
                                <td class="col-3">
                                    <span class="text-muted float-end">
                                        <?= $comment->getCommentUpdate((int) $comment->id) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] == 0) : ?>
                <form action="<?= URL.'posts/'.$params['post']->id.'/comment/create/' ?>" class="d-flex justify-content-between" method="POST">
                    <div class="form-floating col-10">
                        <input type="text" name="content" class="form-control" placeholder="Laisser un commentaire">
                        <label for="comment">Laissez un commentaire :</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-small">Valider</button>
                </form>
            <?php endif ?>
        </div>
    </div>
       
    <div class="row">
        <a href="<?= URL . 'posts/' ?>" class="btn btn-outline-primary float-end my-3 col-3 float-end">Revenir au blog</a>
    </div>
</div>