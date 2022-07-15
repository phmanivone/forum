<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostsByTopic($id){

            $sql = "SELECT *
                    FROM ".$this->tableName."
                    WHERE topic_id = :id
                    ORDER BY postDate ASC";
    
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function update()
        {
            $sql = "UPDATE ".$this->tableName."
                    SET content = :content
                    WHERE id_post = :id";
        }
    }