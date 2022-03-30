<?php

class Basket implements Controller
{
    public function Run()
    {
        require_once (VIEWS_SRC."basket.php");
        global $_DB;
        $BasketIds = implode(",", array_keys($_SESSION['BasketIds'] ?? [0]));
        $_DB->Query(
            "
            SELECT koszyk_id,potrawy_id,name, description, (price * amount) price, amount FROM koszyk 
            INNER JOIN potrawy p USING(potrawy_id)
            WHERE koszyk_id IN ($BasketIds)
        ");
        $BasketItems = $_DB->FetchAllResults(true);
        (new BasketView())->Render($BasketItems);
    }
}