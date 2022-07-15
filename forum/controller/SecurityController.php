<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class HomeController extends AbstractController implements ControllerInterface
{
    // formulaire d'inscription
    public function registerForm()
    {
        // initialisation d'un token pour le formulaire d'inscription
        Session::setTokenCSRF(bin2hex(random_bytes(64)));

        return [
            "view" => VIEW_DIR."security/signup.php",
            "data" => null,
        ];
    }
    // inscription
    public function register()
    {
        if (!empty($_POST)) {
            // on filtre nos données du formulaire pour se prémunir des failles XSS: on transforme tous les caractères non autorisés en éléments HTML
            // pour se prémunir de failles XSS on utilise les filter_input ou la fonction htmlentities()
            $nickname = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);

            if ($nickname && $email) {
                if ($password) {
                    // si tous les éléments ont été filtrés correctement,
                    // on vérifie que les 2 mots de passes correspondent et que le mot de passe est >= 8
                    if (($password === $confirmPassword) and strlen($password) >= 8) {
                        
                        $manager = new UserManager(); // on crée une nouvelle instance de notre classe UserManager 
                        $user = $manager->findOneByPseudo($nickname); // on vérifie si un user portant ce pseudo existe en bdd

                        if (!$user) {
                            // si je n'ai pas de user avec ce pseudo, je hash le password en utilisant la fonction password_hash
                            // password_hash utilisera par défaut le meilleur algorithme de hash utilisé par PHP
                            // PHP utilise des algorithmes de hash forts comme bcrypt ou argon2i
                            // ces algorithmes vont rajouter au mdp hashé un salt.
                            // le salt est une chaîne de caractères hashées qu'on concatènera au mdp hashé
                            // l'utilisation d'un algo de hash fort est recommandé par owasp afin de se prémunir contre les attaques par forces brutes
                            // une attaque par force brute est souvent un bot qui va tester des milliers de combinaisons possibles pour accéder à un identifiant
                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            $manager->add([
                                "pseudo" => $nickname,
                                "email" => $email,
                                "password" => $hash,
                                "roles" => json_encode(['ROLE_USER'])
                            ]);
                            Session::addFlash("success", "Inscription réussie, connectez-vous !");
                            header('location:index.php?ctrl=security&action=login');

                            die;

                            // une session est une façon de stocker des données pour un utilisateur en utilisant un identifiant de session unique
                            // les identifiants de session sont la plupart du temps envoyés au navigateur via des cookies de session et vont être utiliser pour récupérer les données existantes de la session
                            // la session nous permet de conserver les informations pour un utilisateur lorsqu'il navigue de page en page
                            // la session n'est pas stockée sur l'ordinateur comme les cookies mais elle est stockée côté serveur
                            // une session démarre dès que la fonction start est appelée et elle se termine quand on ferme le navigateur
                        } else {
                            Session::addFlash("error", "Cet e-mail existe déjà.");
                        }
                    } else {
                        Session::addFlash("error", "Les deux mots de passe ne correspondent pas.");
                    }
                } else {
                    Session::addFlash("error", "Le mot de passe est invalide.");
                }
            } else {
                Session::addFlash("error", "Le pseudo ou l'e-mail sont vides.");
            }
        } else {
            header('location:index.php?ctrl=security&action=registerForm');
        }
    }

    // connexion
    public function login()
    {
        if (isset($_POST['submit'])) {
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);

            if ($password && $email) {
                $manager = new UserManager();

                $user = $manager->findOneByEmail($email);
                $hash = $user->getPassword();

                // password_verify permettra de comparer deux chaînes de caractères hashées
                // password_verify prendra l'algo utilisé par défaut lors du register pour comparer les deux empreintes numériques
                if (password_verify($password, $hash)) {
                    Session::setUser($user);

                    Session::addFlash("success", "vous êtes connecté");
                    header('location:index.php?ctrl=home&action=index');
                    die;
                }
            } else {
                Session::addFlash("error", "vous n'êtes pas connecté");
            }
        } else {
            return [
                "view" => VIEW_DIR."security/login.php"
            ];
        }
        return [
            "view" => VIEW_DIR."security/login.php"
        ];
    }
    // déconnexion
    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['tokenCSRF']);
        Session::addFlash("success", "Vous êtes déconnecté");
    }
}