<?php

namespace App\Models;

use DateTime;

class Post extends Model {

    protected $table = 'posts';

    // get the creation date for a post
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }
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

    // get all the tags links to a post
    public function getTags() 
    {
        return $this->query("
            SELECT t.* FROM tags t
            INNER JOIN post_tag pt ON pt.tag_id = t.id
            WHERE pt.post_id = ?
        ", [$this->id]);
    }
    
    // create a new post with the relation tag
    public function create(array $data, ?array $relations = null)
    {
        $data['author'] = 1;
        
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        foreach($relations as $tag_id) {
            $statement = $this->db->getPDO()->prepare('INSERT post_tag (post_id, tag_id) VALUES (?, ?)');
            $statement->execute([$id, $tag_id]);
        }

        return true;
    }

    // edit a post
    public function update(int $id, array $data, ?array $relations = null)
    {
        parent::update($id, $data);

        $statement = $this->db->getPDO()->prepare('DELETE FROM post_tag WHERE post_id = ?');
        $result = $statement->execute([$id]);

        foreach($relations as $tag_id) {
            $statement = $this->db->getPDO()->prepare('INSERT post_tag (post_id, tag_id) VALUES (?, ?)');
            $statement->execute([$id, $tag_id]);
        }

        if($result) {
            return true;
        }
    }

}