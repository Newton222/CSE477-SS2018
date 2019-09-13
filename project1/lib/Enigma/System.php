<?php

namespace Enigma;


class System
{
    const ALPHA = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
        'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    const NUM = array('1'=>'EINZ', '2'=>'ZWO', '3'=>'DREI', '4'=>'VIER', '5'=>'FUNF', '6'=>'SEQS',
        '7'=>'SIEBEN', '8'=>'AOT', '9'=>'NEUN', '0'=>'NULL');

    public function __construct($e){
        $this->enigma = new Enigma();
        $this->error = false;
        $this->rotor1 = 1;
        $this->rotor1setting = 'A';
        $this->rotor2 = 2;
        $this->rotor2setting = 'A';
        $this->rotor3 = 3;
        $this->rotor3setting = 'A';
    }

    public function setUsername($username){
        $this->username = $username;
        $this->error = false;
    }

    public function reset(){
        $this->username = '';
        $this->enigma->clear();
        $this->result = '';
        $this->pressed = '';
        $this->from = '';
        $this->to = '';
        $this->settings_error = '';
        $this->rotor1 = 1;
        $this->rotor1setting = 'A';
        $this->rotor2 = 2;
        $this->rotor2setting = 'A';
        $this->rotor3 = 3;
        $this->rotor3setting = 'A';
    }

    public function in_reset(){
        $this->enigma->clear();
        $this->result = '';
        $this->pressed = '';
        $this->restoreRotorSettings();
    }

    public function press($key){
        $this->pressed = $key;
        $this->result = $this->enigma->pressed($key);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEnigma()
    {
        return $this->enigma;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function setRoot($root)
    {
        $this->root = $root;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getPressed()
    {
        return $this->pressed;
    }

    public function resetSettingsError(){
        $this->settings_error = '';
    }

    public function getSettingsError()
    {
        return $this->settings_error;
    }

    public function setSettingsError($settings_error)
    {
        $this->settings_error = $settings_error;
    }

    public function setRotorSetting($rotor, $setting){
        try{
            $this->enigma->setRotorSetting($rotor, strtoupper($setting));
            $this->storeRotorSettings();
        }catch(EnigmaException $e){
            $this->settings_error = "Invalid setting for rotor $rotor";
        }

    }

    public function setRotor($rotor, $setting){
        try{
            $this->enigma->setRotor($rotor, $setting);
            $this->storeRotorSettings();
        }catch (EnigmaException $e){
            $this->settings_error = "e2";
        }
    }

    public function storeRotorSettings(){
        $this->rotor1setting = $this->enigma->getRotorSetting(1);
        $this->rotor2setting = $this->enigma->getRotorSetting(2);
        $this->rotor3setting = $this->enigma->getRotorSetting(3);
        $this->rotor1 = $this->enigma->getRotor(1);
        $this->rotor2 = $this->enigma->getRotor(2);
        $this->rotor3 = $this->enigma->getRotor(3);
    }

    public function restoreRotorSettings(){
        $this->enigma->setRotor(1, $this->rotor1);
        $this->enigma->setRotorSetting(1, $this->rotor1setting);
        $this->enigma->setRotor(2, $this->rotor2);
        $this->enigma->setRotorSetting(2, $this->rotor2setting);
        $this->enigma->setRotor(3, $this->rotor3);
        $this->enigma->setRotorSetting(3, $this->rotor3setting);
    }

    public function encode($str){
        $this->restoreRotorSettings();
        $new_str = '';
        for($i=0; $i<strlen($str); $i++) {
            $character = substr($str, $i, 1);
            if($character === ' '){

            }elseif ($character === '.'){
                $new_str .= 'X';
            }elseif (array_key_exists($character, self::NUM)){
                $new_str .= self::NUM[$character];
            }elseif (in_array(strtoupper($character), self::ALPHA)){
                $new_str .= strtoupper($character);
            }
        }
        $this->from = $str;

        $result = '';
        for($i=0; $i<strlen($new_str); $i++) {
            $result .= $this->enigma->pressed(substr($new_str, $i, 1));
            if($i%5 == 4){
                $result .= ' ';
            }
        }
        $this->to = $result;
    }

    public function decode($str){
        $this->restoreRotorSettings();
        $new_str = '';
        for($i=0; $i<strlen($str); $i++) {
            $character = substr($str, $i, 1);
            if (in_array(strtoupper($character), self::ALPHA)){
                $new_str .=strtoupper($character);
            }
        }
        $this->to = $str;
        $result = '';
        for($i=0; $i<strlen($new_str); $i++) {
            $result .= $this->enigma->pressed(substr($new_str, $i, 1));
            if($i%5 == 4){
                $result .= ' ';
            }
        }
        $this->from = $result;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    private $username = '';
    private $enigma = null;
    private $result = '';
    private $pressed = '';
    private $error = false;
    private $root = '';
    private $settings_error = '';
    private $from = '';
    private $to = '';
    private $rotor1;
    private $rotor1setting;
    private $rotor2;
    private $rotor2setting;
    private $rotor3;
    private $rotor3setting;
}