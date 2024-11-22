<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./commonStyle.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/aa7454d09f.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <div id="logo">
        <a href="./index.php">
          <img src="./img/logo-white.png" alt="">
        </a>
      </div>
      <ul class="nav" id="nav">
        <ul class="navLogo">
          <a href="./index.php">
            <img src="./img/logo-white.png" alt="">
          </a>
        </ul>
        <li class="nav-link">
          <a href="./index.php">Home</a>
        </li>
        <li class="nav-link">
          <a href="./dashboard.php">Dashboard</a>
        </li>
        <li class="nav-link">
          <a href="./login.php">Login</a>
        </li>
      </ul>
      <div id="barContainer">
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>
    </header>
    <section class="hero gridSection">
      <div class="sectionDesc">
        <h1 class="headline"> Most popular way to trade <span class="cryptoText">CRYPTO</span>. </h1>
        <p class="sub-headline"> You can see a record of all your transactions anytime you want and never have to worry about someone erasing or stealing your money! </p>
        <div class="btnContainer">
          <button class="btn btn1">Contact Now</button>
          <button class="btn btn2">play video <i class="fa-solid fa-play"></i>
          </button>
        </div>
      </div>
      <div class="sectionPic bouncepic" id="sectionPic">
        <img src="./img/hero-image.png" alt="">
      </div>
    </section>
    <section>
      <div class="carouselContainer">
        <div class="eachCarousel eachCarouselBorder">
          <img src="./img/bitcoin-icon.png" alt="">
          <article class="carouselDesc">
            <h1 class="carouselTitle">Bitcoin</h1>
            <p class="carouselPara">Bitcoin is an innovative payment network</p>
            <div class="carouselPrice">
              <h3 class="textPrice">$34,000</h3>
              <span class="rect"></span>
              <h3 class="carouselDiscount">15%</h3>
            </div>
            <button class="btn carouselBtn">Buy & Trade</button>
          </article>
        </div>
        <div class="eachCarousel">
          <img src="./img/ethereum-icon.png" alt="">
          <article class="carouselDesc">
            <h1 class="carouselTitle">Ethereum</h1>
            <p class="carouselPara">Ethereum is open-source blockchain currency</p>
            <div class="carouselPrice">
              <h3 class="textPrice">$25,600</h3>
              <span class="rect"></span>
              <h3 class="carouselDiscount">9%</h3>
            </div>
            <button class="btn carouselBtn">Buy & Trade</button>
          </article>
        </div>
        <div class="eachCarousel">
          <img src="./img/tether-icon.png" alt="">
          <article class="carouselDesc">
            <h1 class="carouselTitle">Tether</h1>
            <p class="carouselPara">Tether is a stable coin cryptocurrency</p>
            <div class="carouselPrice">
              <h3 class="textPrice">$7,000</h3>
              <span class="rect"></span>
              <h3 class="carouselDiscount">4%</h3>
            </div>
            <button class="btn carouselBtn">Buy & Trade</button>
          </article>
        </div>
        <div class="eachCarousel">
          <img src="./img/bitcoin-icon.png" alt="">
          <article class="carouselDesc">
            <h1 class="carouselTitle">Lite Coin</h1>
            <p class="carouselPara"> Litecoin is a peer-to-peer cryptocurrency </p>
            <div class="carouselPrice">
              <h3 class="textPrice">$34,000</h3>
              <span class="rect"></span>
              <h3 class="carouselDiscount">15%</h3>
            </div>
            <button class="btn carouselBtn">Buy & Trade</button>
          </article>
        </div>
        <div class="eachCarousel">
          <img src="./img/ethereum-icon.png" alt="">
          <article class="carouselDesc">
            <h1 class="carouselTitle"> Doge Coin </h1>
            <p class="carouselPara"> Dogecoin is a cryptocurrency featuring a likeness of the Shiba Inu. </p>
            <div class="carouselPrice">
              <h3 class="textPrice">$25,600</h3>
              <span class="rect"></span>
              <h3 class="carouselDiscount">9%</h3>
            </div>
            <button class="btn carouselBtn">Buy & Trade</button>
          </article>
        </div>
        <div class="eachCarousel">
          <img src="./img/tether-icon.png" alt="">
          <article class="carouselDesc">
            <h1 class="carouselTitle"> Ripple </h1>
            <p class="carouselPara"> Ripple is a digital payment protocol for financial transactions. </p>
            <div class="carouselPrice">
              <h3 class="textPrice">$7,000</h3>
              <span class="rect"></span>
              <h3 class="carouselDiscount">4%</h3>
            </div>
            <button class="btn carouselBtn">Buy & Trade</button>
          </article>
        </div>
      </div>
      <div class="carouselIndicator">
        <div class="nextBtn" onclick="nextCarousel()"> &#10094; </div>
        <div class="indicator activeIndicator" onclick="slideCarousel(0)"></div>
        <div class="indicator" onclick="slideCarousel(1)"></div>
        <div class="indicator" onclick="slideCarousel(2)"></div>
        <div class="indicator" onclick="slideCarousel(3)"></div>
        <div class="indicator" onclick="slideCarousel(4)"></div>
        <div class="indicator" onclick="slideCarousel(5)"></div>
        <div class="prevBtn" onclick="prevCarousel()"> &#10095; </div>
      </div>
    </section>
    <footer>
      <div class="joinSection">
        <div class="joinDesc">
          <h1 class="sectionHeader">Join with us</h1>
          <p class="sectionPara"> Once you have created your account, you can purchase coins from website </p>
        </div>
        <button class="btn primaryBtn">JOIN NOW</button>
      </div>
      <div class="footerlinksContainer">
        <div class="footerAboutus">
          <img src="./img/logo-white.png" alt="">
          <p class="darkPara">With no commissions and a simple user interface, Prouple is the most reliable way to trade for Cryptocurrency. </p>
          <div class="footersociallinkContainer">
            <img class="sociallink" src="./img/fabook-icon-white.svg" alt="">
            <img class="sociallink" src="./img/twitter-icon-white.svg" alt="">
            <img class="sociallink" src="./img/inkedin-icon-white.svg" alt="">
            <img class="sociallink" src="./img/whatsapp-icon-white.svg" alt="">
          </div>
        </div>
        <div class="footerlink">
          <h1 class="linkTitle">Explore</h1>
          <a href="#" class="eachLink">About us</a>
          <a href="#" class="eachLink">FAQ</a>
          <a href="#" class="eachLink">Blog</a>
          <a href="#" class="eachLink">Contact</a>
        </div>
        <div class="footerlink">
          <h1 class="linkTitle">Service</h1>
          <a href="#" class="eachLink">Mining</a>
          <a href="#" class="eachLink">Control Data</a>
          <a href="#" class="eachLink">Design</a>
          <a href="#" class="eachLink">Security</a>
        </div>
        <div class="footerlink">
          <h1 class="linkTitle">Resource</h1>
          <a href="#" class="eachLink">Style Guide</a>
          <a href="#" class="eachLink">Change Log</a>
          <a href="#" class="eachLink">License</a>
        </div>
      </div>
      <div class="footerCopyright">
        <p>&copy; 2024 design and developed by <a href="#" class="developedBy">Athallah Dzaki</a>. </p>
      </div>
    </footer>
    <script>
      const bar = document.getElementById("bar");
      const nav = document.getElementById("nav");
      bar.onclick = (e) => {
        const icon = e.target.getAttribute("class")
        if (icon == "fa-solid fa-bars") {
          e.target.setAttribute("class", "fa-solid fa-xmark")
        } else {
          e.target.setAttribute("class", "fa-solid fa-bars")
        }
        nav.classList.toggle("showNav")
      }
      const carouselContainer = document.querySelector(".carouselContainer");
      const eachCarousel = document.querySelector(".eachCarousel").clientWidth;
      const allEachCarousel = document.querySelectorAll(".eachCarousel");
      const allIndicator = document.querySelectorAll(".indicator");
      let currentCarousel = 0;
      const prevCarousel = () => {
        if (currentCarousel < allEachCarousel.length - 1) {
          slideCarousel(currentCarousel + 1)
        } else {
          slideCarousel(0)
        }
      }
      const nextCarousel = () => {
        if (currentCarousel > 0) {
          slideCarousel(currentCarousel - 1)
        } else {
          slideCarousel(allEachCarousel.length - 1)
        }
      }
      const slideCarousel = (index) => {
        for (let x = 0; x < allEachCarousel.length; x++) {
          if (x === index) {
            currentCarousel = index;
            allEachCarousel[x].classList.add("eachCarouselBorder")
            allIndicator[x].classList.add("activeIndicator")
          } else {
            allEachCarousel[x].classList.remove("eachCarouselBorder")
            allIndicator[x].classList.remove("activeIndicator")
          }
        }
        carouselContainer.scrollLeft = (index * (eachCarousel + 10))
        console.log(carouselContainer.scrollLeft)
      }
      document.body.onload = async () => {
        await fetch("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin,ethereum,tether,litecoin,dogecoin,ripple").then(response => response.json()).then(data => {
          console.log(data)
          for (let x = 0; x < allEachCarousel.length; x++) {
            console.log(x, data[x]);
            allEachCarousel[x].querySelector(".textPrice").innerText = `$${data[x].current_price}`;
          }
        })
      }
    </script>
  </body>
</html>