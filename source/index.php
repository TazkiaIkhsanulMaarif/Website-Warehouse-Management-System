<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);

    }
  </style>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" data-tag="font" />
  <link rel="stylesheet" href="./style.css" />

</head>

<body>
  <div>
    <link href="./home.css" rel="stylesheet" />
    <?php if(@$_SESSION['massage']){ ?>
      <script>
        swal("Good job!", "<?php echo $_SESSION['massage']; ?>", "succes");
      </script>
      <?php 
      unset ($_SESSION['massage']);
    }
    ?>
    <div class="home-container">
      <div class="container1">

        <!-- REGISTER -->
        <span class="icon-loss"><ion-icon name="close-outline"></ion-icon></span>
        <form class="home-form" action="cek_register.php" method="post">
          <span class="home-text">Sign Up</span>
          <div class="input-box">
            <input type="tel" class="home-textinput input" name="namalengkap" required />
            <label for="">Nama Lengkap</label>
          </div>
          <div class="input-box">
            <input type="text" class="home-textinput input" name="username" required />
            <label for="">Username</label>
          </div>
          <div class="input-box">
            <input type="password" class="home-textinput input" name="password" required />
            <label for="">Password</label>
          </div>
          <div class="input-box">
            <input type="password" class="home-textinput input" name="confirm-password" required />
            <label for="">Confirm Password</label>
          </div>
          <div class="input-box">
          <input type="email" class="home-textinput input" name="email" required />
            <label for="">Email</label>
          </div>
          <div class="role">
            <label for="">Role</label>
            <select class="home-select" name="role">
              <option value="Employee Staf">Employee Staf</option>
              <option value="Suppliers">Suppliers</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
          <div>
            <button class="home-button button" name="upload">Register</button>
          </div>
          <div class="sign-register">
            <span class="home-text01">Already a Member</span>
            <a href="#" class="link_register">
              Log In
            </a>
          </div>
        </form>


        <!-- LOGIN -->
        <form class="home-form_login" action="cek_login.php?op=in" method="post">
          <span class="home-text">Sign In</span>
          <div class="input-box">
            <input type="text" class="home-textinput input" name="username-login" required />
            <label for="">Username</label>
          </div>
          <div class="input-box">
            <input type="password" class="home-textinput input" name="password-login" required />
            <label for="">Password</label>
          </div>
          <div class="btn">
            <input type="submit" class="home-button_login" name="login" value="Login" />
          </div>
          <div class="sign-register">
            <span class="home-text01">Don't have an account</span>
            <a href="#" class="link_login">
              Sign Up
            </a>
          </div>
        </form>
      </div>





      <div class="home-navbar">
        <header data-role="Header" class="home-header max-width-container">
          <div class="home-navbar1">
            <div class="home-container3">
              <img alt="search3271286" src="/playground_assets/search3271286-qmam.svg" class="home-image" />
              <input type="text" placeholder="search" class="home-textinput5 input" />
            </div>
            <div class="home-middle">
              <div class="home-left">
                <span class="home-text02 navbar-link">PRODUCT</span>
                <span class="home-text03 navbar-link">INVENTORY MANAGEMENT</span>
                <span class="home-text04 navbar-link">REPORTS AND ANALYSIS</span>
              </div>
              <span class="navbar-logo-title">MWAREHOUSE</span>
              <div class="home-right">
                <span class="navbar-link home-text05">ABOUT</span>
                <span class="home-text06 navbar-link">ORDER MANAGEMENT</span>
                <span class="navbar-link home-text07"><a href="#" class="btnlogin">LOG IN</a></span>
              </div>
            </div>
            <div class="home-icons"></div>
          </div>
          <div data-role="BurgerMenu" class="home-burger-menu">
            <svg viewBox="0 0 1024 1024" class="home-icon">
              <path d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"></path>
            </svg>
          </div>
          <div data-role="MobileMenu" class="home-mobile-menu">
            <div class="home-nav">
              <div class="home-container4">
                <span class="home-logo-center1">MWAREHOUSE</span>
                <div data-role="CloseMobileMenu" class="home-close-mobile-menu">
                  <svg viewBox="0 0 1024 1024" class="home-icon02">
                    <path d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"></path>
                  </svg>
                </div>
              </div>
              <div class="home-middle1">
                <span class="home-text08">PRODUCT</span>
                <span class="home-text09">INVENTORY MANAGEMENT</span>
                <span class="home-text10">REPORT AND ANALYSIS</span>
                <span class="home-text11">ABOUT</span>
                <span class="home-text12">ORDER MANAGEMENT</span>
                <span class="home-text13">LOG IN</span>
              </div>
            </div>
            <div>
              <svg viewBox="0 0 950.8571428571428 1024" class="home-icon04">
                <path d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"></path>
              </svg><svg viewBox="0 0 877.7142857142857 1024" class="home-icon06">
                <path d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"></path>
              </svg><svg viewBox="0 0 602.2582857142856 1024" class="home-icon08">
                <path d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"></path>
              </svg>
            </div>
          </div>
        </header>
      </div>
    </div>
  </div>

  <script src="./script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>