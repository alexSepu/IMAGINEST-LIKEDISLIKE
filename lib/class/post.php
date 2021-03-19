<?php
    class Post {
        private $namePhoto;
        private $dislikes;
        private $likes;
        private $rating;
        private $datePost;
        private $description;
        function __construct($namePhoto, $dislikes, $likes, $rating, $datePost, $description){
            $this->namePhoto = $namePhoto;
            $this->dislikes = $dislikes;
            $this->likes = $likes;
            $this->rating = $rating;
            $this->datePost = $datePost;
            $this->description = $description;
        }
        public function getPhoto(){
            return $this->namePhoto;
        }
        public function getDescription(){
            return $this -> description;
        }
        public function getDate(){
            return $this -> datePost;
        }
    }