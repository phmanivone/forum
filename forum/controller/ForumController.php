<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;

    class ForumController extends AbstractController implements ControllerInterface
    {
        // affiche la liste des topics
        public function listTopics()
        {
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ]
            ];
        }
        // affiche la liste des catégories
        public function listCategories()
        {
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "category" => $categoryManager->findAll(["categoryName", "ASC"])
                ]
            ];
        }
        // affiche la liste des users
        public function listUsers()
        {
            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."forum/listUsers.php",
                "data" => [
                    "users" => $userManager->findAll(["signupDate", "DESC"])
                ]
            ];
        }
        // affiche le détail d'un user
        public function userDetails($id)
        {
            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."forum/userDetails.php",
                "data" => [
                    "users" => $userManager->findOneById($id)
                ]
            ];
        }
        // affiche le détail d'un topic et les posts sous un topic
        public function topicDetails($id)
        {
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/topicDetails.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->findPostsByTopic($id)
                ]
            ];
        }
        // affiche tous les topics d'une catégorie
        public function topicsByCategory($id)
        {
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/topicsByCategory.php",
                "data" => [
                    "category" => $categoryManager->findOneById($id),
                    "topic" => $topicManager->findTopicsByCategory($id)
                ]
            ];
        }
        // affiche la vue avec le formulaire d'ajout d'une catégorie
        public function formAddCategory()
        {
            return [
                "view" => VIEW_DIR."forum/addCategory.php"
            ];
        }
        // ajoute une catégorie
        public function addCategory()
        {
            if(!empty($_POST)) {
                $title = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if($title) {
                    $categoryManager = new CategoryManager();
                    $categoryManager->add([
                        "categoryName" => $title
                    ]);

                    header('location:index.php?ctrl=forum&action=listCategories');
                } 
            }
        }
        // affiche la vue avec le formulaire d'ajout d'un topic
        public function formAddTopic()
        {
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/addTopic.php",
                "data" => ["categories" => $categoryManager->findAll()]
            ];
        }
        // ajoute un topic
        public function addTopic()
        {
            if(!empty($_POST)) {
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $idCategory = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
                
                if($title) {
                    $topicManager = new TopicManager();

                    $topicManager->add([
                        "title" => $title,
                        "content" => $content,
                        "category_id" => $idCategory,
                        "user_id" => 0
                    ]);

                    header('location:index.php?ctrl=forum&action=listTopics');

                    Session::addFlash("success", "Topic ajouté");
                }
                else {
                    Session::addFlash("error","Erreur de saisie");
                }
            }
        }
        // ajoute un post sous un topic
        public function addPost()
        {
            if(!empty($_POST)) {
                $content = filter_input(INPUT_POST, "content", FILTER_UNSAFE_RAW);
                               
                if($content) {
                    $postManager = new PostManager();
                    $topicManager = new TopicManager();
                    $idTopic = $_GET['id'];

                    $postManager->add([
                        "content" => $content,
                        "topic_id" => $idTopic, 
                        "user_id" => 0
                    ]);
                    
                } header('location:index.php?ctrl=forum&action=listTopics');
            }
        }
        /************************************* ça marche pas là dessous ************************************/
        // supprime un post
        public function deletePost($id)
        {
            $postManager = new PostManager();

            $postManager->findOneById($id);

            $postManager->delete($id);
            Session::addFlash("success", "Le message a bien été supprimé");

            return [
                "view" => VIEW_DIR."forum/listTopics.php"
            ];
        }
        // renvoie la vue du formulaire pour update un post
        public function formUpdatePost()
        {
            return [
                "view" => VIEW_DIR."forum/updatePost.php"
            ];
        }
        // met à jour un post
        public function updatePost()
        {
            $postManager = new PostManager();

            if(!empty($_POST)) {
                $content = filter_input(INPUT_POST, "content", FILTER_UNSAFE_RAW);
                               
                if($content) {
                    $postManager = new PostManager();

                    $postManager->update([
                        "content" => $content
                    ]);
                    
                } header('location:index.php?ctrl=forum&action=listTopics');
            }
        }

    }
