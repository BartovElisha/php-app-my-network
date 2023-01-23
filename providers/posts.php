<?php

class Post
{
    protected
    $id, $title, $last_update, $author;

    function __construct($id, $title, $last_update, $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->last_update = $last_update;
        $this->author = $author;
    }

    public function set($property, $value)
    {
        $this->$property = $value;
    }

    public function get($property)
    {
        return $this->$property;
    }

    public function formatDate()
    {
        $time = strtotime($this->last_update);
        $date = date('Y-m-d H:i:s', $time);
        return $date;
    }
}

class TextPost extends Post
{
    protected $post_body;

    function __construct($id, $title, $last_update, $author, $post_body)
    {
        parent::__construct($id, $title, $last_update, $author);
        $this->post_body = $post_body;
    }
}

class ImagePost extends Post
{
    protected $image_url, $image_alt;

    function __construct($id, $title, $last_update, $author, $image_url, $image_alt)
    {
        parent::__construct($id, $title, $last_update, $author);
        $this->image_url = $image_url;
        $this->image_alt = $image_alt;
    }
}