<header>
    <a href="<?=ROOT_URI?>" class="logo"><img src="<?=IMG_URI?>/logo.jpg"></a>

    <nav class="navbar">
        <a href="#">O Nas</a>
        <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#przystawki" : ROOT_URI."#przystawki"?>"">Przystawki</a>
        <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#dania główne" : ROOT_URI."#DANIA GŁÓWNE"?>"">Dania Główne</a>
        <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#napoje" : ROOT_URI."#NAPOJE"?>"">Napoje</a>
        <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#contact" : ROOT_URI."#contact"?>">Kontakt</a>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="<?=ROOT_URI."koszyk"?>" class="fas fa-shopping-cart"></a>
    </div>

</header>