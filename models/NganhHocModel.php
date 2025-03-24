<?php
class NganhHocModel {
    private $conn;
    private $table_name = "nganhhoc";

    public $MaNganh;
    public $TenNganh;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create NganhHoc
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (MaNganh, TenNganh) VALUES (:MaNganh, :TenNganh)";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));
        $this->TenNganh = htmlspecialchars(strip_tags($this->TenNganh));

        // Bind parameters
        $stmt->bindParam(":MaNganh", $this->MaNganh);
        $stmt->bindParam(":TenNganh", $this->TenNganh);

        return $stmt->execute();
    }

    // Read all NganhHoc
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read one NganhHoc
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaNganh = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaNganh);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->TenNganh = $row['TenNganh'];
            return true;
        }
        return false;
    }

    // Update NganhHoc
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET TenNganh = :TenNganh WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->TenNganh = htmlspecialchars(strip_tags($this->TenNganh));
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));

        // Bind parameters
        $stmt->bindParam(":TenNganh", $this->TenNganh);
        $stmt->bindParam(":MaNganh", $this->MaNganh);

        return $stmt->execute();
    }

    // Delete NganhHoc
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));
        
        $stmt->bindParam(1, $this->MaNganh);
        
        return $stmt->execute();
    }
}
?>