<div class="container p-4">
    <h1 class="text-center mb-4">Les derniers articles</h1>
    <div class="row mb-2 align-items-stretch">
        <?php foreach($params['posts'] as $post): ?>
            <div class="col-md-6 mb-2">
                <div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-350 position-relative post-card">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0"><?= $post->title ?></h3>
                        <div class="mb-1 text-muted">Modifié le : <?= $post->getUpdatedAt() ?></div>
                        <p class="card-text mb-auto post-chapo"><?= $post->chapo ?></p>
                        <?= $post->getButton(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>