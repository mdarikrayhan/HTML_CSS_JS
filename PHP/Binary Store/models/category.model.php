<?php

class Category{
    private $name;
    private $description;
    private $image_url;

    public function __construct($name = '', $description = '', $image_url = '')
    {
        $this->name = $name;
        $this->description = $description;
        $this->image_url = $image_url;
    }

    public function getCategoryData()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->image_url
        ];
    }

    public function save($name, $description, $image_url)
    {
        global $db; // Use the global database instance
        $query = "INSERT INTO categories (name, description, image_url, created_at) 
                  VALUES (:name, :description, :image_url, NOW())";
        $params = [
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $image_url
        ];
        return $db->query($query, $params);
    }
}