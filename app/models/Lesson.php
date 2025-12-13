<?php
class Lesson {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getByCourse($course_id) {
        $stmt = $this->db->prepare("SELECT * FROM lessons WHERE course_id = ? ORDER BY `order` ASC, id ASC");
        $stmt->execute([$course_id]);
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM lessons WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO lessons (course_id, title, content, video_url, `order`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['course_id'], $data['title'], $data['content'], $data['video_url'], $data['order']]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE lessons SET title=?, content=?, video_url=?, `order`=? WHERE id=? AND course_id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['title'], $data['content'], $data['video_url'], $data['order'], $id, $data['course_id']]);
    }

    public function delete($id, $course_id) {
        $stmt = $this->db->prepare("DELETE FROM lessons WHERE id = ? AND course_id = ?");
        return $stmt->execute([$id, $course_id]);
    }
}
?>