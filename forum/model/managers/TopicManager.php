<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }
        
        public function findTopicsByCategory($id){

            $sql = "SELECT *
                    FROM ".$this->tableName."
                    WHERE category_id = :id
                    ORDER BY creationDate ASC
                    ";
    
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

    }