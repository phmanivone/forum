<?php

namespace Model\Entities;

use App\Entity;

class Post extends Entity{
    private $id;
    private $content;
    private $postDate;
    private $user;
    private $topic;

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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of postDate
     */ 
    public function getPostDate()
    {
        $formattedDate = $this->postDate->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    /**
     * Set the value of postDate
     *
     * @return  self
     */ 
    public function setPostDate($date)
    {
        $this->postDate = new \DateTime($date);

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of topic
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @return  self
     */ 
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }
    
    public function __toString()
    {
        return $this->content;
    }
}

?>