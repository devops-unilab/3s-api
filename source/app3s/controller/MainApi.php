<?php

namespace app3s\controller;


class MainApi
{

    public function main()
    {
        $controller = new MensagemForumApiRestController();
        $controller->main();
    }
}
