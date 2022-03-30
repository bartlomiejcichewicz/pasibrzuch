<section class="footer" id="contact">

    <div class="box-container">

        <div class="box">
            <h3>Lokalizacja</h3>
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=warszawa%20kwitn%C4%85ca%2017&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="box">
            <h3>Kontakt</h3>
            <a>+48 777 333 111</a>
            <a>+48 777 333 222</a>
            <a>kontakt@pasibrzuch.pl</a>
            <a>ul. Kwitnąca 17</a>
            <a>01-926 Warszawa</a>
        </div>

        <div class="box">
            <h3>Śledź nas</h3>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
        <div class="box">
            <h3>Nawigacja</h3>
            <a href="#">O Nas</a>
            <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#appetizers" : ROOT_URI."#appetizers"?>"">Przystawki</a>
            <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#dania główne" : ROOT_URI."#DANIA GŁÓWNE"?>"">Dania Główne</a>
            <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#NAPOJE" : ROOT_URI."#NAPOJE"?>"">Napoje</a>
            <a href="<?=$_SERVER["REQUEST_URI"] == "/pasibrzuch/" ? "#contact" : ROOT_URI."#contact"?>">Kontakt</a>
        </div>
    </div>

</section>