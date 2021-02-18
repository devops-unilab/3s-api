<?php 

namespace novissimo3s\custom\controller;

use novissimo3s\controller\MensagemForumApiRestController;

class MainApi{

    public function main(){
        $controller = new MensagemForumApiRestController();
        $controller->main();
    }
}


?>