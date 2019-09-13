<?php

namespace Enigma;


class SettingsController
{
    function __construct(System $system, array $post){

        $this->redirect = '../settings.php';

        if(isset($post['set'])){
            $system->resetSettingsError();

            if($post['rotor-1'] === $post['rotor-2'] ||
                $post['rotor-1'] === $post['rotor-3'] ||
                $post['rotor-2'] === $post['rotor-3']){
                $system->setSettingsError("You are not allowed to use the same rotor more than once.");
            }else{
                $system->setRotor(1, (int)$post['rotor-1']);
                $system->setRotor(2, (int)$post['rotor-2']);
                $system->setRotor(3, (int)$post['rotor-3']);
            }

            $system->setRotorSetting(1, strtoupper($post['initial-1']));
            $system->setRotorSetting(2, strtoupper($post['initial-2']));
            $system->setRotorSetting(3, strtoupper($post['initial-3']));
        }
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;
}