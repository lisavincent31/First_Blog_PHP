<?php 

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller 
{
    /**
     * Return the view of all the comments
     *
     * @return void
     */
    public function index() 
    {
        $this->isAdmin();
        $comments = (new Comment($this->getDB()))->all();

        return $this->view('admin.comment.index', compact('comments'));
    }

    /**
     * Create a new comment for a post
     *
     * @param $id
     * @return void
     */
    public function commentPost(int $id)
    {
        $this->isUser();

        $comment = new Comment($this->getDB());
        $post = [$id];

        $result = $comment->create($_POST, $post);

        if($result) {
            $_SESSION['success'] = 'Votre commentaire a bien été créé. Il faudra attendre sa validation par l\'administrateur.';
            return header('Location: ' . URL . '/posts/'.$id.'/?success');
        }
    }

    /**
     * Update the status comment in accepted by the admin
     *
     * @param $id
     * @return void
     */
    public function accept(int $id)
    {
        $this->isAdmin();
        $comment = new Comment($this->getDB());

        $result = $comment->accept($id);

        if($result) {
            $_SESSION['success'] = 'Le status du commentaire est passé en accepté avec succès.';
            return header('Location: '. URL .'/admin/comments?success');
        }
    }

    // update the status comment in deleted by the admin
    public function delete(int $id)
    {
        $this->isAdmin();
        $comment = new Comment($this->getDB());

        $result = $comment->delete($id);

        if($result) {
            $_SESSION['success'] = 'Le status du commentaire est passé en supprimé avec succès.';
            return header('Location: '. URL .'/admin/comments');
        }
    }
}

?>