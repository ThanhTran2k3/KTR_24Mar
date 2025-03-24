<?php
class HocPhanModel {
    private $conn;
    private $table_name = "hocphan";

    public $MaHP;
    public $TenHP;
    public $SoTinChi;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create HocPhan
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (MaHP, TenHP, SoTinChi) VALUES (:MaHP, :TenHP, :SoTinChi)";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize inputs
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        $this->TenHP = htmlspecialchars(strip_tags($this->TenHP));
        $this->SoTinChi = htmlspecialchars(strip_tags($this->SoTinChi));
        
        // Bind parameters
        $stmt->bindParam(":MaHP", $this->MaHP);
        $stmt->bindParam(":TenHP", $this->TenHP);
        $stmt->bindParam(":SoTinChi", $this->SoTinChi);
        
        return $stmt->execute();
    }

    // Read all HocPhan
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one HocPhan
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->TenHP = $row['TenHP'];
            $this->SoTinChi = $row['SoTinChi'];
            return true;
        }
        return false;
    }

    // Update HocPhan
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET TenHP = :TenHP, SoTinChi = :SoTinChi WHERE MaHP = :MaHP";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize inputs
        $this->TenHP = htmlspecialchars(strip_tags($this->TenHP));
        $this->SoTinChi = htmlspecialchars(strip_tags($this->SoTinChi));
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        
        // Bind parameters
        $stmt->bindParam(":TenHP", $this->TenHP);
        $stmt->bindParam(":SoTinChi", $this->SoTinChi);
        $stmt->bindParam(":MaHP", $this->MaHP);
        
        return $stmt->execute();
    }

    // Delete HocPhan
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        
        $stmt->bindParam(1, $this->MaHP);
        
        return $stmt->execute();
    }
}
?>