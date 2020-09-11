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

    //single post method
    public function read_single(){
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
                WHERE
                    p.id = ?
                LIMIT 0,1';
         //prepare qurey
         $stmt = $this->conn->prepare($query);

         //BIND ID
         $stmt->bindParam(1, $this->id);
         //execute query
         $stmt->execute();
        
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->title = $row['title'];
         $this->id = $row['id'];
         $this->category_name = $row['category_name'];
         $this->category_id = $row['category_id'];
         $this->body = $row['body'];
         $this->author = $row['author'];
         $this->created_at = $row['created_at'];
    }
}