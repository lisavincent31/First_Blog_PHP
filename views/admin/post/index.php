<div class="container">
    <?php if(isset($_SESSION['success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <div class="d-flex align-items-center">
                <p><?= $_SESSION['success'] ?></p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    
    <h1 class="text-center my-4">Gestion des articles</h1>
    <div class="row">
        <div class="col-10 m-auto">
            <a href="<?= URL.'admin/posts/create' ?>" class="btn btn-success my-3">Ajouter un article</a>
        </div>
    </div>
    <div class="row">
        <div class="col-10 m-auto bg-white p-2 border">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">titre</th>
                        <th scope="col">édité le</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($params['posts'] as $post): ?>
                        <tr>
                            <th scope="row"><?= $post->id ?></th>
                            <td><?= $post->title ?></td>
                            <td><?= $post->getUpdatedAt() ?></td>
                            <td class="d-flex">
                                <a href="<?= URL.'posts/'.$post->id ?>">
                                    <button type="button" class="btn btn-primary btn-action m-2">
                                        <i class="bi bi-eye text-white"></i>
                                    </button>
                                </a>
                                <a href="<?= URL.'admin/posts/edit/'.$post->id ?>">
                                    <button type="button" class="btn btn-warning btn-action m-2">
                                        <i class="bi bi-pencil text-white"></i>
                                    </button>
                                </a>
                                <form action="<?= URL.'admin/posts/delete/'.$post->id ?>" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-danger btn-action m-2">
                                        <i class="bi bi-trash text-white"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>