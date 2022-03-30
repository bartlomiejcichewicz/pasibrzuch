<?php

class HomeView extends View
{
    protected function GetContent($Data)
    {
        foreach ($Data as $category => $dishes) {
        echo '<section class="menu">
        
            <h3 class="sub-heading">menu</h3>
            <h1 class="heading" id="'.$category.'">' . $category . '</h1>
            <div class="box-container">
        ';
                    foreach ($dishes as $dish) {
                        echo '<div class="box">
                    <div class="image">
                        <img src="' . IMG_URI . $dish['image'] . '" alt="">
                    </div>
                    <div class="content">
                        <h3>' . $dish['name'] . '</h3>
                        <p>' . $dish['description'] . '</p>
                        <span class="price">' . $dish['price'] . ' zł</span>
                        <a href="'.ROOT_URI.'dodaj-do-koszyka/' . $dish['potrawy_id'] . '" class="btn">Dodaj do koszyka</a>
                    </div>
                </div>';
                    }
                    echo '    </div>
        
        </section>';
        }
    }
}