<?php
    namespace models;

    /**
     * @property int    $id         
     * @property string $title      
     * @property string $description 
     * @property string $imgs_refs   
     * @property int    $category_id 
     * @property string $created_at  
     * @property string $table       
     */

    class Threads extends \core\Model
    {
        // public $id;
        // public $title;
        // public $description;
        // public $imgs_refs;
        // public $category_id;
        // public $created_at;
        public static $tableName = 'threads';
    }
?>