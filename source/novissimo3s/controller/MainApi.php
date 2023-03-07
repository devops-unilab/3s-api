<?php 

namespace novissimo3s\controller;


class MainApi{

    public function main(){
        $controller = new MensagemForumApiRestController();
        $controller->main();
    }
}


?>