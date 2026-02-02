<?php
    namespace App\Models;
    use DateTime;

    class Post extends Model{
        protected $table  =  "post";

        public function getCreatedAt(): string
        {
            return (new DateTime($this->created_at))->format('d/m/Y à H:i');
        }

        public function getCurtContent(): string
        {
            return substr($this->content, 0, 200).'...';
        }

        public function getButton()
        {
            return <<<HTML
            <a href="/posts/$this->id" class="btn btn-primary">Lire plus</a></button> 
        HTML;
        }

        public function getTag()
        {
            return $this->query("
            SELECT t.* FROM tags t
            INNER JOIN post_tag pt ON pt.tag_id = t.id
            WHERE pt.post_id = ?
            ", [$this->id]);
        }

        public function create(array $data, ?array $relations = null)
        {
            parent::create($data);

            $id = $this->db->getPDO()->lastInsertId();

            foreach($relations as $tagId){
                $stmt = $this->db->getPDO()->prepare("INSERT post_tag(post_id, tag_id) VALUES(?, ?)");
                $stmt->execute([$id, $tagId]);
            }
            
            return true;

        }

        public function update(int $id, array $data, ?array $relations = null)
        {
            parent::update($id, $data);
            $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
            $result = $stmt->execute([$id]);

            foreach($relations as $tagId){
                $stmt = $this->db->getPDO()->prepare("INSERT post_tag(post_id, tag_id) VALUES(?, ?)");
                $stmt->execute([$id, $tagId]);
            }

            if($result){
                return true;
            }
            
        }
    }