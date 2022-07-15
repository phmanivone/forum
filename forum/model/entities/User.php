<?php

namespace Model\Entities;

use App\Entity;

class User extends Entity{
    private $id;
    private $pseudo;
    private $email;
    private $password;
    private $signupDate;
    private $status;
    private $roles;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of signupDate
     */ 
    public function getSignupDate()
    {
        $formattedDate = $this->signupDate->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    /**
     * Set the value of signupDate
     *
     * @return  self
     */ 
    public function setSignupDate($date)
    {
        $this->signupDate = new \DateTime($date);

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = json_decode($roles);
        if(empty($this->roles))
        { // si le role est vide on va lui attribuer automatiquement le role user
            $this->roles[] = "ROLE_USER";
        };
    }

    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    public function __toString()
    {
        return $this->pseudo;
    }
}

?>