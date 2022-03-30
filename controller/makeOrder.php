<?php

require_once(VIEWS_SRC."makeOrder.php");

class MakeOrder implements Controller
{
    public function Run()
    {
        global $_DB;
        $View = new MakeOrderView();
        $Message = "";
        if(empty($_SESSION['client_id']) || empty($_SESSION['BasketIds'])) {
            $Message = "Brak id klienta lub koszyka, jeżeli przekierowano Ciebie ze strony koszyka, skontaktuj się z nami w tej sprawie.";
        } else {
            foreach (["clientName", "clientLastName", "clientEmail", "clientTelNumber", "clientAddress"] as $NeededData) {
                if (empty($_POST[$NeededData])) {
                    $Message = "Nie wszystkie wymagane pola zostały wypełnione!";
                } else {
                    $_SESSION[$NeededData] = $_POST[$NeededData];
                }
            }
        }
        if($Message) {
            $View->Render(["msg"=>$Message]);
            return;
        }
        $_DB->Query("UPDATE klienci 
                            SET address = {$_POST['clientAddress']}
                              , email = {$_POST['clientEmail']}
                              , name = {$_POST['clientName']}
                              , last_name = {$_POST['clientLastName']}
                              , telephone = {$_POST['clientTelNumber']}
                              , ordered = 1
                              WHERE klienci_id = {$_SESSION['client_id']}
                              "
        );
        $Values = "";
        $OrderId = implode("", array_keys($_SESSION["BasketIds"])).$_SESSION['client_id'];
        foreach(array_keys($_SESSION["BasketIds"]) as $BasketId) {
            $Values .= "($BasketId, {$_SESSION['client_id']}, $OrderId),";

        }
        $Values = rtrim($Values, ",");
        if(!empty($Values)) {
            $Qry = "INSERT INTO zamowienia_2_klienci (koszyk_id, klienci_id, zamowienia_id) VALUES $Values";
            $_DB->Query($Qry);
            if(empty($_DB->error)) {
                unset($_SESSION["BasketIds"]);
                $Message = "Zamówienie zostało złożone :). Twój numer zamówienia to: $OrderId";
            } else {
                $Message = "Zamówienie nie zostało zostało złożone :/. Spróbuj ponownie za chwilę.";
            }
        } else {
            $Message = "Coś poszło nie tak przy pobieraniu danych z koszyka...";
        }
        $View->Render(["msg"=>$Message]);
    }
}