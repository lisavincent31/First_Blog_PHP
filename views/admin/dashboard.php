<div class="container">
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
    <div class="m-3 p-4">
        <h1 class="text-center">Bienvenue <?= $_SESSION['user']['firstname'] ?></h1>
        <h2 class="text-center">sur votre tableau de bord</h2>
    </div>
    <div class="col-12">
        <h5>Commentaires en attente</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col-1">#</th>
                    <th scope="col-1">Post</th>
                    <th scope="col-3">Commentaire</th>
                    <th scope="col-2">Auteur</th>
                    <th scope="col-2">Status</th>
                    <th scope="col-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($params['comments'] as $comment) : ?>
                    <?php if($comment->status == 'pending') : ?>
                        <tr>
                            <th scope="row"><?= $comment->id ?></th>
                            <td><?= $comment->getPost()->title ?></td>
                            <td><?= $comment->content ?></td>
                            <td><?= $comment->getAuthor(); ?></td>
                            <td class='text-info'>En attente</td>
                            <td>
                                <div class="d-flex">
                                    <a href="<?= URL."posts/{$comment->getPost()->id}" ?>">
                                        <button type="button" class="btn btn-primary m-2">
                                            <i class="bi bi-eye text-white"></i>
                                        </button>
                                    </a>
                                    <a href="<?= URL.'admin/comments/'.$comment->id ?>">
                                        <button type="button" class="btn btn-success m-2">
                                            <i class="bi bi-check text-white"></i>
                                        </button>
                                    </a>
                                    <a href="<?= URL.'admin/comments/delete/'.$comment->id ?>">
                                        <button type="button" class="btn btn-danger m-2">
                                            <i class="bi bi-trash text-white"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>