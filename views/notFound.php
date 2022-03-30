<?php

class NotFoundView extends View
{
    protected function GetContent($Data)
    {
        echo "Niestety nie znaleziono takiej strony :/";
    }
}