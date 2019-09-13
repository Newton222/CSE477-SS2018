<?php

namespace Enigma;


class EnigmaView
{
    function __construct(System $system){
        $this->enigma = $system->getEnigma();
        $this->system = $system;
    }

    public function presentHeader(){
        $html =<<<HTML
<header>
  <figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure>
  <nav>
    <ul>
      <li class="selected"><a href="enigma.php">Enigma</a></li>
      <li><a href="settings.php">Settings</a></li>
      <li><a href="batch.php">Batch</a></li>
      <li><a href="./">Ausloggen</a></li>
    </ul>
  </nav>
</header>
HTML;
        $name = $this->system->getUsername();
        $html .= '<h1 class="center">Greetings,' . $name . ', and welcome to The Endless Enigma!</h1>';
        return $html;
    }

    public function presentBody(){
        $html =<<<HTML
<div class="body">
  <form method="post" action="post/enigma-post.php">

    <div class="enigma" id="enigma">
      <figure class="enigma"><img src="images/enigma.png" alt="Enigma Simulation"></figure>
HTML;
        $html .= '<p class="wheel wheel-1">';
        $html .= $this->enigma->getRotorSetting(1);
        $html .= '</p>';
        $html .= '<p class="wheel wheel-2">';
        $html .= $this->enigma->getRotorSetting(2);
        $html .= '</p>';
        $html .= '<p class="wheel wheel-3">';
        $html .= $this->enigma->getRotorSetting(3);
        $html .= '</p>';

        foreach (System::ALPHA as $key){
            $lower_key = strtolower($key);

            if($this->system->getPressed() === $key){
                $html .= "<div class=\"key key-$lower_key pressed\">";
            }else{
                $html .= "<div class=\"key key-$lower_key\">";
            }
            $html .=<<<HTML
<img src="images/key.png" alt="$key Key">
<button name="key" value="$key">
<span>$key</span>
</button>
</div>
HTML;
            if($this->system->getResult() === $key){
                $html .= "<div class=\"light light-$lower_key light-on\">$key</div>";
            }else {
                $html .= "<div class=\"light light-$lower_key\">$key</div>";
            }
        }

        $html .=<<<HTML
</div>
</form>
<form class="dialog" method="post" action="post/enigma-post.php">
<p><input type="submit" name="reset" value="Reset"></p>
</form>

HTML;

        return $html;
    }

    public function presentFooter(){
        $html =<<<HTML
<footer>
<p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
</footer>
HTML;

        return $html;
    }

    public function present(){
        return $this->presentHeader() .
            $this->presentBody() .
            $this->presentFooter();
    }

    private $system;
    private $enigma;
}