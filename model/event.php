<?php

class Event
{
    private $conn;
    private $table = 'event';
    public $id;
    public $name;
    public $category;
    public $detail;
    public $date;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY date DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
            SET
            name=:name,
            category=:category,
            detail=:detail,
            date=:date';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->date = htmlspecialchars(strip_tags($this->date));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':date', $this->date);

        if ($stmt->execute()) {
            return true;
        };

        printf('Error: %s.\n', $stmt->error);
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return false;
    }
    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
            SET
            name=:name,
            category=:category,
            detail=:detail,
            date=:date
            WHERE
            id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        };

        printf('Error: %s.\n', $stmt->error);
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return false;
    }
    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        };

        printf('Error: %s.\n', $stmt->error);
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return false;
    }
}
