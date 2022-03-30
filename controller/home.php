<?php

require_once (VIEWS_SRC."home.php");

class Home implements Controller
{
    public function Run()
    {
        $View = new HomeView();
        global $_DB;
        $_DB->Query("
            SELECT p.*, k.nazwa_kategorii FROM potrawy p
            INNER JOIN kategorie k USING(kategorie_id)
        ");
        $DishesInCategories = $_DB->FetchAllResults(true, "nazwa_kategorii");
        $View->Render($DishesInCategories);
    }
}