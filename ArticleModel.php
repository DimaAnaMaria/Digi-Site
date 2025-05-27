<?php
require_once 'Database.php';

class ArticleModel {
    private $conn;
    private $table = 'Articles';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Creează un articol nou
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (title, description, content, author_id, status, published_at) 
                VALUES (:title, :description, :content, :author_id, :status, :published_at)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Obține unul sau toate articolele
    public function get($id = null) {
        if ($id) {
            $sql = "SELECT a.*, u.name as author_name
                    FROM {$this->table} a
                    LEFT JOIN Users u ON a.author_id = u.id
                    WHERE a.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT a.*, u.name as author_name
                    FROM {$this->table} a
                    LEFT JOIN Users u ON a.author_id = u.id
                    ORDER BY a.created_at DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Actualizează un articol
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} 
                SET title = :title, description = :description, content = :content, 
                    author_id = :author_id, status = :status, published_at = :published_at 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Șterge un articol
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Atribuie categorii unui articol
    public function setCategories($articleId, $categoryIds) {
        $this->conn->prepare("DELETE FROM articlecategories WHERE article_id = :article_id")
            ->execute(['article_id' => $articleId]);

        $sql = "INSERT INTO articlecategories (article_id, category_id) VALUES (:article_id, :category_id)";
        $stmt = $this->conn->prepare($sql);
        foreach ($categoryIds as $catId) {
            $stmt->execute(['article_id' => $articleId, 'category_id' => $catId]);
        }
    }

    // Atribuie taguri unui articol
    public function setTags($articleId, $tagIds) {
        $this->conn->prepare("DELETE FROM articletags WHERE article_id = :article_id")
            ->execute(['article_id' => $articleId]);

        $sql = "INSERT INTO articletags (article_id, tag_id) VALUES (:article_id, :tag_id)";
        $stmt = $this->conn->prepare($sql);
        foreach ($tagIds as $tagId) {
            $stmt->execute(['article_id' => $articleId, 'tag_id' => $tagId]);
        }
    }
}
?>