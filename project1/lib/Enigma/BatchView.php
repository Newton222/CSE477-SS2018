<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 6/6/2018
 * Time: 10:25 PM
 */

namespace Enigma;


class BatchView
{
    function __construct(System $system){
        $this->enigma = $system->getEnigma();
        $this->system = $system;
    }

    public function presentHeader(){
        return <<<HTML
<header>
  <figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure>
  <nav>
    <ul>
      <li><a href="enigma.php">Enigma</a></li>
      <li><a href="settings.php">Settings</a></li>
      <li class="selected"><a href="batch.php">Batch</a></li>
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
  <form class="dialog" method="post" action="post/batch-post.php">
    <div class="encoder">
      <p>
      <textarea name="from">
HTML;
        $html.=$this->system->getFrom();
        $html.=<<<HTML
</textarea> 
      <textarea name="to">
HTML;
        $html.=$this->system->getTo();
        $html.=<<<HTML
</textarea>
      </p>
      <p><input type="submit" name="encode" value="Encode ->">
        <input type="submit" name="decode" value="Decode <-"> <input type="submit" name="reset" value="Reset"></p>
    </div>
  </form>
</div>
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