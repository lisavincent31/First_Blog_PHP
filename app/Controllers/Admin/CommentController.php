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
     * @param id
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
            $url = URL.'posts/'.$id.'/?success=true';
            $this->redirect($url);
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
            $url = URL.'admin/comments?success=true';
            $this->redirect($url);
        }
    }

    /**
     * Update the status comment in deleted by the admin
     *
     * @param $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->isAdmin();
        $comment = new Comment($this->getDB());

        $result = $comment->delete($id);

        if($result) {
            $_SESSION['success'] = 'Le status du commentaire est passé en supprimé avec succès.';
            $url = URL.'admin/comments';
            $this->redirect($url);
        }
    }
}

?>