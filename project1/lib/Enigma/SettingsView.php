<?php

namespace Enigma;


class SettingsView
{
    function __construct(System $system){
        $this->system = $system;
        $this->enigma = $system->getEnigma();
    }

    public function present(){
        return $this->presentHeader() .
            $this->presentBody() .
            $this->presentFooter();
    }

    public function presentHeader(){
        return <<<HTML
<header>
  <figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure>
  <nav>
    <ul>
      <li><a href="enigma.php">Enigma</a></li>
      <li class="selected"><a href="settings.php">Settings</a></li>
      <li><a href="batch.php">Batch</a></li>
      <li><a href="./">Ausloggen</a></li>
    </ul>
  </nav>
</header>
HTML;

    }

    public function presentFooter(){
        return <<<HTML
<footer>
  <p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
</footer>
HTML;

    }

    public function presentRoter($roter){
        $html = '';

        $r = $this->enigma->getRotor($roter);
        if($r === 1){
            $html .=<<<HTML
        <option value="1" selected>I</option>
        <option value="2">II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
HTML;
        }else if($r === 2){
            $html .=<<<HTML
        <option value="1">I</option>
        <option value="2" selected>II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
HTML;
        }else if($r === 3){
            $html .=<<<HTML
        <option value="1">I</option>
        <option value="2">II</option>
        <option value="3" selected>III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
HTML;
        }else if($r === 4){
            $html .=<<<HTML
        <option value="1">I</option>
        <option value="2">II</option>
        <option value="3">III</option>
        <option value="4" selected>IV</option>
        <option value="5">V</option>
HTML;
        }else if($r === 5){
            $html .=<<<HTML
        <option value="1">I</option>
        <option value="2">II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5" selected>V</option>
HTML;
        }

        return $html;
    }

    public function presentBody(){
        $html =<<<HTML
<div class="body">
  <div class="enigma" id="enigma">
    <figure class="enigma"><img src="images/rotors.png" alt="Enigma Rotors" width="1024" height="580"></figure>
HTML;
        $html .= '<p class="wheel wheel-s wheel-1">';
        $html .= $this->enigma->getRotorSetting(1);
        $html .= '</p>';
        $html .= '<p class="wheel wheel-s wheel-2">';
        $html .= $this->enigma->getRotorSetting(2);
        $html .= '</p>';
        $html .= '<p class="wheel wheel-s wheel-3">';
        $html .= $this->enigma->getRotorSetting(3);
        $html .= '</p>';

        $html .=<<<HTML
  </div>
  <form class="dialog" method="post" action="post/settings-post.php">
    <p><label for="rotor-1">Rotor 1:</label>
      <select id="rotor-1" name="rotor-1">
HTML;

        $html .= $this->presentRoter(1);

        $html .=<<<HTML
      </select>&nbsp;&nbsp;
      <label for="initial-1">Setting:</label>
HTML;
        $r1_setting = $this->enigma->getRotorSetting(1);
        $html .="<input class=\"initial\" id=\"initial-1\" name=\"initial-1\" type=\"text\" value=\"$r1_setting\">";

        $html .=<<<HTML
    </p>
    <p><label for="rotor-2">Rotor 2:</label>
      <select id="rotor-2" name="rotor-2">
HTML;

        $html .= $this->presentRoter(2);

        $html .=<<<HTML
      </select>&nbsp;&nbsp;
      <label for="initial-2">Setting:</label>
HTML;
        $r2_setting = $this->enigma->getRotorSetting(2);
        $html .="<input class=\"initial\" id=\"initial-2\" name=\"initial-2\" type=\"text\" value=\"$r2_setting\">";

        $html .=<<<HTML
    </p>
    <p><label for="rotor-3">Rotor 3:</label>
      <select id="rotor-3" name="rotor-3">
HTML;

        $html .= $this->presentRoter(3);

        $html.=<<<HTML
      </select>&nbsp;&nbsp;
      <label for="initial-3">Setting:</label>
HTML;
        $r3_setting = $this->enigma->getRotorSetting(3);
        $html .="<input class=\"initial\" id=\"initial-3\" name=\"initial-3\" type=\"text\" value=\"$r3_setting\">";

        $html .=<<<HTML
    </p>
    <p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p>
HTML;
        if($this->system->getSettingsError() != ''){
            $error = $this->system->getSettingsError();
            $html .="<p class=\"message\">$error</p>";
        }
        $html .=<<<HTML
    </form>
</div>
HTML;

        return $html;
    }

    private $system;
    private $enigma;
}