<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{

    /** 
     * Return the page of all posts
     * 
     * @return void
     */
    public function index()
    {
        $posts = (new Post($this->getDB()))->all();

        return $this->view('admin.post.index', compact('posts'));
    }

    /** 
     * Return the form to create a new post by the admin
     * 
     * @return void
     */
    public function create()
    {
        $this->isAdmin();
        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('tags'));
    }

    /** 
     * Create the new post
     * 
     * @return void
     */
    public function createPost()
    {
        $this->isAdmin();
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);
        $result = $post->create($_POST, $tags);

        if($result) {
            $_SESSION['success'] = 'L\'article a été créé avec succès.';
            $url = $this->url.'admin/posts';
            $this->redirect($url);
        }
    }

    /** 
     * Return the form to edit a post
     * 
     * @return void
     */
    public function edit(int $id) 
    {
        $this->isAdmin();
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('post', 'tags'));
    }
    
    /** 
     * Edit a post 
     * 
     * @return void
     */
    public function update(int $id) 
    {
        $this->isAdmin();
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);
        $result = $post->update($id, $_POST, $tags);

        if($result) {
            $_SESSION['success'] = 'L\'article a été modifié avec succès.';
            $url = $this->url.'admin/posts';
            $this->redirect($url);
        }
    }

    /**
     * Delete a post
     * 
     * @return void
     */
    public function delete(int $id)
    {
        $this->isAdmin();
        $post = new Post($this->getDB());

        $result = $post->destroy($id);

        if($result) {
            $_SESSION['success'] = 'L\'article a été supprimé avec succès.';
            $url = $this->url.'admin/posts';
            $this->redirect($url);
        }
    }
}

?>