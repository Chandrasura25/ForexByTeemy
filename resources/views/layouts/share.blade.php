<link rel="stylesheet" href="/css/share.css">
<div class="menu">
    <div class="toggle">
        <ion-icon name="share-social"></ion-icon>
    </div>
    <!-- <ul> -->
    <li style="--i:0;--clr:#1877f2">
        <a href="#">
            <ion-icon name="logo-facebook"></ion-icon>
        </a>
    </li>
    <li style="--i:1;--clr:#25d366">
        <a href="#">
            <ion-icon name="logo-whatsapp"></ion-icon></a>
    </li>
    <li style="--i:2;--clr:#1da1f2">
        <a href="#">
            <ion-icon name="logo-twitter"></ion-icon></a>
    </li>
    <li style="--i:3;--clr:#ea4c89">
        <a href="#">
            <ion-icon name="logo-dribbble"></ion-icon>
        </a>
    </li>
    <li style="--i:4;--clr:#0a66c2">
        <a href="#">
            <ion-icon name="logo-linkedin"></ion-icon></a>
    </li>
    <li style="--i:5;--clr:#c32aa3">
        <a href="#">
            <ion-icon name="logo-instagram"></ion-icon></a>
    </li>

    <li style="--i:6;--clr:#bd081c">
        <a href="#">
            <ion-icon name="logo-pinterest"></ion-icon></a>
    </li>
    <li style="--i:7;--clr:#ff0000">
        <a href="#">
            <ion-icon name="logo-youtube"></ion-icon></a>
    </li>
    <!-- </ul> -->
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    let menu = document.querySelector('.menu')
    let toggle = document.querySelector('.toggle')
    toggle.onclick = () => {
        menu.classList.toggle('active')
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $(".menu").draggable();
    });
</script>
