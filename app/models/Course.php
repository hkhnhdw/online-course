<?php
class Course {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getByInstructor($instructor_id) {
        $stmt = $this->db->prepare("
            SELECT c.*, cat.name as category_name 
            FROM courses c 
            JOIN categories cat ON c.category_id = cat.id 
            WHERE c.instructor_id = ? 
            ORDER BY c.created_at DESC
        ");
        $stmt->execute([$instructor_id]);
        return $stmt->fetchAll();
    }

    public function find($id, $instructor_id) {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = ? AND instructor_id = ?");
        $stmt->execute([$id, $instructor_id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO courses (title, description, instructor_id, category_id, price, image) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['instructor_id'],
            $data['category_id'],
            $data['price'],
            $data['image']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE courses SET title=?, description=?, category_id=?, price=?, image=? WHERE id=? AND instructor_id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['title'], $data['description'], $data['category_id'],
            $data['price'], $data['image'], $id, $data['instructor_id']
        ]);
    }

    public function delete($id, $instructor_id) {
        $stmt = $this->db->prepare("DELETE FROM courses WHERE id = ? AND instructor_id = ?");
        return $stmt->execute([$id, $instructor_id]);
    }

    public function getAllCategories() {
        $stmt = $this->db->query("SELECT id, name FROM categories ORDER BY name");
        return $stmt->fetchAll();
    }
}
?>