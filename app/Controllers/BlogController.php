<?php
    namespace App\Controllers;
    use App\Models\Post;
    use App\Models\Tag;

    class BlogController extends Controller{


        public function home()
        {
            
            return $this->views("blog.home");
        }
        public function index()
        {
            
            $post = new Post($this->getDB());
            $posts = $post->all();

            return $this->views("blog.index", compact("posts")); 
            // echo "<h1 style='text-align:center; color:white; background-color: brown;'>Je suis la homepage</h1>";
        }

        public function show(int $id)
        {
            // var_dump($db->getPDO());
            $post = new Post($this->getDB());
            $post = $post->findById($id);

           
            // var_dump($post);
            return $this->views("blog.show", compact('post'));
            // echo "Je suis le post ".$id;
        }

        public function tag(int $id)
        {
            $tag =(new Tag($this->getDB()))->findById($id);
            return $this->views("blog.tag", compact("tag"));
            
        }
    }