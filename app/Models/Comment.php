<?php 

namespace App\Models;

use DateTime;
use App\Models\User;

class Comment extends Model {

    protected $table = 'comments';

    // get the post link to the comment
    public function getPost()
    {
        $post = $this->query("
        SELECT p.id, p.title FROM posts p
        INNER JOIN comment_post cp ON cp.post_id = p.id 
        WHERE cp.comment_id = ?
        ", [$this->id]);
        
        return $post[0];
    }

    // get the author of a comment
    public function getAuthor()
    {
        $author = $this->query("
        SELECT firstname, lastname FROM users
        INNER JOIN comments ON comments.author = users.id
        WHERE comments.id = ?
        ", [$this->id]);

        return $author[0]->firstname." ".$author[0]->lastname;
    }

    // get the creation date of a comment
    public function getCreatedAt()
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    // create a new comment
    public function create(array $data, ?array $relations = null)
    {
        $data['author'] = $_SESSION['user']['id'];
        $data['status'] = 'pending';
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        $date = date('Y-m-d H:i:s');

        foreach ($relations as $post_id) {
            $statement = $this->db->getPDO()->prepare('INSERT comment_post (comment_id, post_id, created_at, updated_at) VALUES (?, ?, ?, ?)');
            $statement->execute([$id, $post_id, $date, $date]);
        }

        return true;
    }

    // update the status comment in accepted
    public function accept(int $id)
    {
        $data['status'] = 'accepted';
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['id'] = $id;

        return $this->query("UPDATE {$this->table} SET status = :status, updated_at = :updated_at WHERE id = :id", $data);
    }

    // update the status comment in deleted
    public function delete(int $id)
    {
        $data['status'] = 'deleted';
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['id'] = $id;

        return $this->query("UPDATE {$this->table} SET status = :status, updated_at = :updated_at WHERE id = :id", $data);
    }
}

?>