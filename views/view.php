<?php

abstract class View
{
    abstract protected function GetContent($Data);

    protected function CustomJavascript() {
        return "";
    }

    public function Render($Data)
    {
        require_once("./bootstrap.php");
        require_once("./public/head.php");
        ?>
        <body>
        <?php
        echo $this->CustomJavascript();
        require_once("./public/menu.php");
        echo $this->GetContent($Data);
        require_once("./public/footer.php");
        ?>
        </body>
        <?php

    }
}