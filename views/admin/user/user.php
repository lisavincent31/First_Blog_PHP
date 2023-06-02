<div class="container text-center p-4 mb-4 shadow">
    <h1><?= $params['user']->firstname. ' ' .$params['user']->lastname ?></h1>
    <p class="lead">Inscrit depuis le : <?= $params['user']->getCreatedAt() ?></p>
</div>
<div class="mt-4">
    <h3>Nombre de commentaires : <?= count($params['comments']) ?></h3>
    <div class="col-12 my-4 m-auto p-3">
        <div class="d-flex justify-content-start align-items-center">
            <span class="lead px-2">Filtres </span>
            <button class=" btn btn-primary btn-status mx-2" data-filter="all">Tous</button>
            <button class=" btn btn-outline-success btn-status mx-2" data-filter="accepted">Accepté</button>
            <button class=" btn btn-outline-info btn-status mx-2" data-filter="pending">En attente</button>
            <button class=" btn btn-outline-danger btn-status mx-2" data-filter="deleted">Supprimé</button>
        </div>
    </div>
    <div class="col-12 m-auto bg-white p-2">
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">commentaire</th>
                <th scope="col">édité le</th>
                <th scope="col">status</th>
                <th scope="col">actions</th>
            </thead>
            <tbody>
                <?php foreach($params['comments'] as $comment) : ?>
                    <tr class="comment <?= $comment->status ?>">
                        <th scope="row"><?= $comment->id ?></th>
                        <td><?= $comment->content ?></td>
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