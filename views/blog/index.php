<div class="container p-4">
    <h1 class="text-center p-4 mb-4 shadow">Les derniers articles</h1>
    <div class="row mb-2 align-items-stretch">
        <div class="col-12 mb-4 m-auto p-3">
            <div class="d-flex justify-content-start align-items-center">
                <span class="lead px-2">Filtres </span>
                <button class=" btn btn-primary btn-tags mx-2" data-filter="all">Tous</button>
                <?php foreach($params['tags'] as $tag): ?>
                    <button class=" btn btn-outline-<?= $tag->badge ?> btn-tags mx-2" data-filter="<?= $tag->name ?>"><?= $tag->name ?></button>
                <?php endforeach ?>
            </div>
        </div>
        <?php foreach($params['posts'] as $post): ?>
            <div class="col-md-6 mb-2 card-post <?php foreach($post->getTags() as $tag): ?> <?= $tag->name ?> <?php endforeach ?>">
                <div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-350 position-relative post-card">
                    <div class="col p-4 d-flex flex-column position-static">
                        <div class="d-flex align-items-center">
                            <?php foreach($post->getTags() as $tag) : ?>
                                <strong class="badge bg-<?= $tag->badge ?> d-inline-block mb-2 mx-2">
                                    <span class="text-white" data-filter="<?= $tag->name ?>"><?= $tag->name ?></span>
                                </strong>
                            <?php endforeach ?>
                        </div>
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