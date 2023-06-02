<div class="container">
    <?php if(isset($_SESSION['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <div class="d-flex align-items-center">
                <p><?= $_SESSION['success'] ?></p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <h1 class="text-center my-4">Gestion des commentaires</h1>

    <div class="row">
        <div class="col-12 mb-4 m-auto p-3">
            <div class="d-flex justify-content-start align-items-center">
                <span class="lead px-2">Filtres </span>
                <button class=" btn btn-primary btn-status mx-2" data-filter="all">Tous</button>
                <button class=" btn btn-outline-success btn-status mx-2" data-filter="accepted">Accepté</button>
                <button class=" btn btn-outline-info btn-status mx-2" data-filter="pending">En attente</button>
                <button class=" btn btn-outline-danger btn-status mx-2" data-filter="deleted">Supprimé</button>
            </div>
        </div>
        <div class="col-12 m-auto bg-white p-2 border">
            <table class="table">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Edité le</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody>
                    <?php foreach($params['comments'] as $comment) : ?>
                        <tr class="comment <?= $comment->status ?>">
                            <th scope="row"><?= $comment->id ?></th>
                            <td><?= $comment->content ?></td>
                            <td><?= $comment->getAuthor() ?></td>
                            <td><?= $comment->getCreatedAt() ?></td>
                            <?php switch($comment->status) {
                                case 'accepted':
                                    echo "<td class='text-success'>Accepté</td>";
                                    break;
                                case 'pending':
                                    echo "<td class='text-info'>En attente</td>";
                                    break;
                                case 'ignored':
                                    echo "<td class='text-warning'>Ignoré</td>";
                                    break;
                                case 'deleted':
                                    echo "<td class='text-danger'>Supprimé</td>";
                                    break;
                            } ?>
                            <td>
                                <div class="d-flex">
                                    <?php if($comment->status !== 'accepted') : ?>
                                        <a href="<?= URL.'admin/comments/'.$comment->id ?>">
                                            <button type="button" class="btn btn-success m-2">
                                                <i class="bi bi-check text-white"></i>
                                            </button>
                                        </a>
                                    <?php endif ?>
                                    <?php if($comment->status !== 'deleted') : ?>
                                        <a href="<?= URL.'admin/comments/delete/'.$comment->id ?>">
                                            <button type="button" class="btn btn-danger m-2">
                                                <i class="bi bi-trash text-white"></i>
                                            </button>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>