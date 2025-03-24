<?php
class DangKyModel {
    private $conn;
    private $table_name = "dangky";

    public $MaDK;
    public $NgayDK;
    public $MaSV;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create DangKy
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (MaDK, NgayDK, MaSV) 
                  VALUES (:MaDK, :NgayDK, :MaSV)";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->MaDK = htmlspecialchars(strip_tags($this->MaDK));
        $this->NgayDK = htmlspecialchars(strip_tags($this->NgayDK));
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));

        // Bind parameters
        $stmt->bindParam(":MaDK", $this->MaDK);
        $stmt->bindParam(":NgayDK", $this->NgayDK);
        $stmt->bindParam(":MaSV", $this->MaSV);

        return $stmt->execute();
    }

    // Read all DangKy
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one DangKy
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaDK = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->NgayDK = $row['NgayDK'];
            $this->MaSV = $row['MaSV'];
            return true;
        }
        return false;
    }

    // Update DangKy
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET NgayDK = :NgayDK, MaSV = :MaSV
                  WHERE MaDK = :MaDK";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->NgayDK = htmlspecialchars(strip_tags($this->NgayDK));
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));
        $this->MaDK = htmlspecialchars(strip_tags($this->MaDK));

        // Bind parameters
        $stmt->bindParam(":NgayDK", $this->NgayDK);
        $stmt->bindParam(":MaSV", $this->MaSV);
        $stmt->bindParam(":MaDK", $this->MaDK);

        return $stmt->execute();
    }

    // Delete DangKy
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaDK = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->MaDK = htmlspecialchars(strip_tags($this->MaDK));
        
        $stmt->bindParam(1, $this->MaDK);
        
        return $stmt->execute();
    }
}
?>
