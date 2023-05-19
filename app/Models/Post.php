<?php

namespace App\Models;

use DateTime;

class Post extends Model {

    protected $table = 'posts';

    // get the updated date for a post
    public function getUpdatedAt(): string
    {
        return (new DateTime($this->updated_at))->format('d F Y');
    }

    // create a specific button to return a post with his id
    public function getButton(): string
    {
        return <<<HTML
        <a href="/Vincent_Lisa_1_repository_git_042023/posts/$this->id" class="mt-2 position-relative bottom-0">Lire l'article</a>
HTML;
    }

}