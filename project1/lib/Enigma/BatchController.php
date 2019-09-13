<?php

namespace Enigma;


class BatchController
{
    function __construct(System $system, array $post){
        $this->redirect = '../batch.php#enigma';

        if(isset($post['encode'])){
            if(isset($post['from'])){
                $system->encode($post['from']);
            }
        }elseif (isset($post['decode'])){
            if(isset($post['to'])){
                $system->decode($post['to']);
            }
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