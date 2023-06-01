<h1><?= isset($params['post']) ? 'Modifier '.$params['post']->title : 'Créer un nouvel article' ?></h1>

<form action="<?= isset($params['post']) ? URL .'admin/posts/edit/'. $params['post']->id : URL.'admin/posts/create' ?>" method="post" class="m-4">
    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control m-2" name="title" id="title" value="<?=$params['post']->title ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="chapo">Chapô :</label>
        <textarea class="form-control m-2" name="chapo" id="chapo"><?=$params['post']->chapo ?? '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="content">Contenu :</label>
        <textarea class="form-control m-2" name="content" id="content" rows="8"><?=$params['post']->content ?? '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags de l'article :</label>
        <select class="form-select" multiple id="tags" name="tags[]">
            <?php foreach($params['tags'] as $tag) : ?>
                <option value="<?= $tag->id ?>" 
                    <?php if(isset($params['post'])) : ?>
                        <?php foreach($params['post']->getTags() as $postTag) : ?>
                            <?= ($tag->id === $postTag->id) ? 'selected' : '' ?>
                        <?php endforeach ?>
                    <?php endif ?>
                ><?= $tag->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-4"><?= isset($params['post']) ? 'Enregistrer les modifications' : 'Sauvegarder l\'article' ?></button>
</form>