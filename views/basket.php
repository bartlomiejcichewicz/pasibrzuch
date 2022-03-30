<?php

class BasketView extends View
{
    protected function CustomJavascript()
    {
        return '<script type="text/javascript" src="'.JS_URI.'addToBasket.js"></script>';
    }

    protected function GetContent($Data)
    {
        if(empty($Data)) {
            echo ' <h1 class="heading">Niestety koszyk jest pusty :/</h1>';
            return;
        }
        echo "<form action='".ROOT_URI."zloz-zamowienie' method='post'>";
        foreach ($Data as $Dish) {
            echo '
                <section class="basket">
                    <div class="box">
                        <div class="content">
                            <h3>' . $Dish['name'] . '</h3>
                            <p>' . $Dish['description'] . '</p><p ">
                            <p id="basket-amount-'.$Dish['koszyk_id'].'">' . $Dish['amount'] . '</p>
                            <span class="price" id="basket-price-'.$Dish['koszyk_id'].'">' . $Dish['price'] . ' zł</span>
                        </div>
                        <label for="amount-change">Zmiana ilości:</label>
                        <input type="number" class="amount-change" id="basket'.$Dish['koszyk_id'].'" value="'.$Dish['amount'].'">
                        <input type="button" onclick="changeAmount('.$Dish['koszyk_id'].')" value="zmien">
                    </div>
                </section>
            ';
        }
        echo "
            <label for='name'>Imię</label>
            <input class='form-input' type='text' id='name' name='clientName' value='" . ($_SESSION['clientName'] ?? '') . "'>
            <label for='lastName'>Nazwisko</label>
            <input class='form-input' type='text' id='lastName' name='clientLastName' value='" . ($_SESSION['clientLastName'] ?? '') . "'>
            <label for='email'>Email</label>
            <input class='form-input' type='text' id='email' name='clientEmail' value='" . ($_SESSION['clientEmail'] ?? '') . "'>
            <label for='TelNumber'>Numer telefonu</label>
            <input class='form-input' type='text' id='TelNumber' name='clientTelNumber' value='" . ($_SESSION['clientTelNumber'] ?? '') . "'>
            <label for='clientAddress'>Numer telefonu</label>
            <input class='form-input' type='text' id='clientAddress' name='clientAddress' value='" . ($_SESSION['clientAddress'] ?? '') . "'>
            
            <input class='form-input' type='submit' value='Złóż zamówienie'>
        </form>
";
    }
}