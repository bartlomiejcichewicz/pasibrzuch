<?php

require_once(VIEWS_SRC . "addToBasket.php");

class AddToBasket implements Controller
{
    /**
     * @var int
     */
    private $BasketId;

    public function __construct($id) {
        $this->ClientId = (int)$_SESSION['client_id'];
        $this->DishId = $id;
    }
    public function Run()
    {
        global $_DB;
        $this->BasketId = 0;
        if (isset($_SESSION['BasketIds'])) {
            $BasketIds = implode(",", array_keys($_SESSION['BasketIds']));
            $_DB->Query("SELECT koszyk_id FROM koszyk WHERE koszyk_id in ($BasketIds) AND potrawy_id = $this->DishId  AND klienci_id = $this->ClientId LIMIT 1");
            $this->BasketId = $_DB->FetchLastResult()[0];
        }
        if(isset($_POST['Amount'])) {
            $this->BasketId = $_POST['BasketId'];
            $this->changeBasketAmount($_POST['Amount']);
            return;
        }
        $Message = '<section class="about" id="about">
            <h3 class="sub-heading">Pomyślnie dodano do koszyka</h3>
            <h1 class="heading">Pomyślnie dodano do koszyka. W przypadku zwiększenia ilości, odwiedź koszyk :)</h1>
            </section>
        ';
        echo $_DB->lastQuery;
        $View = new AddToBasketView();
        if ($this->BasketId) {
            $this->changeBasketAmount("`amount` + 1");
        } else {
            $_DB->Query("INSERT INTO koszyk (`amount`, `klienci_id`, `potrawy_id`)VALUES (1, $this->ClientId, $this->DishId)");
            $BasketId = $_DB->GetLastIntesrtedId();
            $_SESSION['BasketIds'][$BasketId] = true;
        }
        $View->Render(["msg"=>$Message]);
    }

    private function changeBasketAmount($amount)
    {
        global $_DB;
        $_DB->Query("UPDATE koszyk SET `amount` = $amount WHERE koszyk_id = $this->BasketId");
        echo $_DB->lastQuery;
    }
}