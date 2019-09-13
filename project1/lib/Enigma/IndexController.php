<?php

namespace Enigma;

class IndexController
{
    public function __construct(System $system, array $post){
        $this->system = $system;
        $this->redirect = '../index.php';

        if(isset($post['name'])){
            $username = strip_tags($post['name']);

            if($username === ""){
                $this->redirect = '../index.php';
                $this->system->setError(true);
            }else{
                $this->redirect = '../enigma.php';
                $this->system->setUsername($username);
            }
        }else{
            $this->system->setError(true);
        }
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $system;
    private $redirect;
}