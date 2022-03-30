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
                        <label for="amount-change">Ile: </label>
                        <input type="number" class="amount-change" id="basket'.$Dish['koszyk_id'].'" value="'.$Dish['amount'].'">
                        <input type="button" onclick="changeAmount('.$Dish['koszyk_id'].')" value="Aktualizuj">
                    </div>
                </section>
            ';
        }
        echo "
           <div class='basket-form'>
           <h2>Dane do dostawy:</h2>
            <label class='basket-label' for='name'>Imię:</label>
            <input class='form-input' type='text' id='name' name='clientName' value='" . ($_SESSION['clientName'] ?? '') . "' required>
            <label class='basket-label' for='lastName'>Nazwisko:</label>
            <input class='form-input' type='text' id='lastName' name='clientLastName' value='" . ($_SESSION['clientLastName'] ?? '') . "' required>
            <label class='basket-label' for='email'>Email:</label>
            <input class='form-input' type='email' id='email' name='clientEmail' value='" . ($_SESSION['clientEmail'] ?? '') . "' required>
            <label class='basket-label' for='TelNumber'>Numer telefonu:</label>
            <input class='form-input' type='text' id='TelNumber' pattern='[0-9]{9}' name='clientTelNumber' value=' " . ($_SESSION['clientTelNumber'] ?? '') . "' required>
            <label class='basket-label' for='clientAddress'>Adres:</label>
            <input class='form-input' type='text' id='clientAddress' name='clientAddress' value='" . ($_SESSION['clientAddress'] ?? '') . "' required>
            <input class='submit-button form-input' type='submit' value='Złóż zamówienie'>
            </div>
        </form>
";
    }
}