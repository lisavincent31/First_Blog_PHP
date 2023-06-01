<div class="container">
    <h1 class="text-center my-4">Tous les utilisateurs</h1>
    <div class="row">
        <div class="col-10 m-auto bg-white p-2 border">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Admis le</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($params['users'] as $user): ?>
                        <tr>
                            <td><?= $user->getFullName() ?></td>
                            <td><?= $user->getCreatedAt() ?></td>
                            <?php switch($user->isAdmin) {
                                case 1:
                                    echo "<td class='text-danger'>Administrateur</td>";
                                    break;
                                case 0:
                                    echo "<td class='text-success'>Utilisateur</td>";
                                    break;
                            } ?>
                            <td>
                                <a href="<?= URL.'admin/users/'.$user->id ?>">
                                    <button type="button" class="btn btn-primary btn-action m-2">
                                        <i class="bi bi-eye text-white"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>