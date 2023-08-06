<link rel="stylesheet" href="/css/share.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    crossorigin="anonymous" />
<div class="menu-wrapper">
    <div class="menu">
        <div class="toggle">
            <ion-icon name="chatbubble-outline"></ion-icon>
        </div>
        <li style="--i:0;--clr:#1877f2">
            <a href="https://facebook.com/forexbyteemy" target="_blank">
                <ion-icon name="logo-facebook"></ion-icon>
            </a>
        </li>
        <li style="--i:1;--clr:#25d366">
            <a href="http://wa.me/2347031459341?text=I%20need%20your%20Ea%20Coding%20service" target="_blank">
                <ion-icon name="logo-whatsapp"></ion-icon>
            </a>
        </li>
        <li style="--i:2;--clr:#1da1f2">
            <a href="https://t.me/teemytee">
                <i class="fab fa-telegram" aria-hidden="true"></i>
            </a>
        </li>
        <li style="--i:3;--clr:#1DBF73">
            <a href="https://www.fiverr.com/teemytee">
                <svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512"
                    xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <circle cx="256" cy="256" fill="#00B22D" id="ellipse" r="256" />
                    <path
                        d="M297,137c0,17,13.8,30.8,31,30.8c17,0,30.8-13.8,30.8-30.8c0-17.2-13.8-31-30.8-31  C310.8,106,297,119.8,297,137L297,137z M223.5,111.1c-40,0-65.9,23.8-71,48.2c-0.5,2.9-1,5.8-1,8.7v22.8h-26.9v45.3h26.9v103h-26.9  V386c39,0,78.1,0,117.1,0v-46.8h-27.2v-103h81.9v103h-26.4V386c39,0,78.3,0,117.3,0v-46.8h-27.9V190.8h-145v-13.6  c0-11.2,10.9-17.9,20.1-17.9h22.5v-48.2H223.5z"
                        fill="#FFFFFF" id="logo" />
                </svg>
            </a>
        </li>
        <li style="--i:4;--clr:#ff0000">
            <a href="https://www.youtube.com/@forexbyteemy">
                <ion-icon name="logo-youtube"></ion-icon>
            </a>
        </li>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    let menu = document.querySelector('.menu')
    let toggle = document.querySelector('.toggle')
    toggle.onclick = () => {
        menu.classList.toggle('active') 
    }

    function handleScroll() {
      // Get scroll position
      let scroll = window.pageYOffset;

      // Calculate the maximum allowable scroll position where the menu should stop moving
      let menuHeight = menu.clientHeight;
      let windowHeight = window.innerHeight;
      let contentHeight = document.documentElement.scrollHeight;
      let maxScroll = contentHeight - windowHeight;

      // Calculate the translation value based on the scroll position
      let translateYValue = Math.max(0, Math.min(scroll, maxScroll));

      // Apply the translation to the menu
      menu.style.transform = `translateY(${translateYValue}px)`;
    }

    // Attach the scroll event listener
    window.addEventListener('scroll', handleScroll);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $(".menu").draggable();
        $(".menu").resizable();
    });
</script>
