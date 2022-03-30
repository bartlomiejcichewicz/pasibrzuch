<?php

class HomeView extends View
{
    protected function GetContent($Data)
    {
        foreach ($Data as $category => $dishes) {
        echo '<section class="menu">
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
    public function Render($Data)
    {
        require_once("./bootstrap.php");
        require_once("./public/head.php");
        ?>
        <body>
        <?php
         require_once("./public/about.php");
        echo $this->CustomJavascript();
        require_once("./public/menu.php");
        echo $this->GetContent($Data);
        require_once("./public/footer.php");
        ?>
        </body>
        <?php

    }
}