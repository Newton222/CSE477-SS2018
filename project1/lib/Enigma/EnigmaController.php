<?php

namespace Enigma;


class EnigmaController
{
    function __construct(System $system, array $post){
        $enigma = $system->getEnigma();
        $this->redirect = '../enigma.php#enigma';

        if(isset($post['key'])){
            $system->press($post['key']);
        }

        if(isset($post['reset'])){
            $system->in_reset();
        }
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;
}