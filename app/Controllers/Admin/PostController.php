<?php
namespace App\Controllers\Admin;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Question;
use App\Controllers\Controller;

class PostController extends Controller{

    public function index()
    {
        $this->isAdmin();
        $posts = (new Post($this->getDB()))->all();

        return $this->views('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $this->isAdmin();
        $tags = (new Tag($this->getDB()))->all();
        return $this->views("admin.post.create", compact('tags'));
    }
    
    public function createPost()
    {
        $this->isAdmin();
        $post = new Post($this->getDB());
        $tags = array_pop($_POST);

        $result = $post->create($_POST, $tags);
        if($result){
            return header("Location: /admin/posts");
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        
        return $this->views('admin.post.edit', compact('post', 'tags'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $post = new Post($this->getDB());
        $tags = array_pop($_POST);

        $result = $post->update($id, $_POST, $tags);
        if($result){
            return header("Location: /admin/posts");
        }
    } 

    public function destroy(int $id)
    {
        $this->isAdmin();
        $user = new User($this->getDB());
        $result = $user->destroy($id);
        if($result){
            return header("Location: /admin/posts");
        }
    }

    public function destroyQuestion(int $id)
    {
        $this->isAdmin();
        $user = new Question($this->getDB());
        $result = $user->destroy($id);
        if($result){
            return header("Location: /admin/posts");
        }
    }

    //Administration

    public function indexAdmin()
    {
        $this->isAdmin();
        return $this->views("admin.post.index");
    }

    public function user()
    {
        $this->isAdmin();
        $users = (new User($this->getDB()))->getAllUsers();
        return $this->views("admin.post.user", compact('users'));
    }

    public function questions()
    {
        $questions = (new Question($this->getDB()))->afficheQuestions();
        return $this->views("admin.post.question", compact('questions'));
    }
}