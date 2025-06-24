<?php

class Category{
    private $name;
    private $description;
    private $image_url;
    private $users_id;
    
    public function __construct()
    {

    }

    public function getCategoryDataById($id)
    {
        global $db;
        $query = "SELECT * FROM categories WHERE id = :id";
        $params = [':id' => $id];
        return $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories()
    {
        global $db; // Use the global database instance
        $query = "SELECT * FROM categories";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCategory($name, $description, $image_url, $users_id)
    {
        global $db; // Use the global database instance
        $query = "INSERT INTO categories (name, description, image_url, users_id, created_at) 
                  VALUES (:name, :description, :image_url, :users_id, NOW())";
        $params = [
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $image_url,
            ':users_id' => $users_id
        ];
        return $db->query($query, $params);
    }
}