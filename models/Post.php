<?php
class Post{
    private $conn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //Constructor with DB
    public function __construct($db) {
        $this->conn =$db;
    }

    public function read(){
        //crate query
        $query = 'SELECT 
                    c.name as category_name,
                    p.id, 
                    p.category_id, 
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM 
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    p.created_at DESC';


        //prepare qurey
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
}