<?php

require_once VIEWS_SRC."notFound.php";

class NotFound implements Controller
{
    public function Run()
    {
        (new NotFoundView())->Render(null);
    }
}