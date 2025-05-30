<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="product_slider-main/style.css">
</head>
<body>
    
    <header>
        <figure class="logo">
            <img src="product_slider-main/images/Bg.png" alt="">
        </figure>
        <nav class="main-nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="carousel next">
            <div class="list">
                <article class="item other_1">
                    <div class="main-content" 
                    style="background-color: #daabe9;">
                    <div class="content">
                        <h2>BINIBeybi Milk Tea - Online Shop</h2>
                        <button class="addToCard"><a href="admin/login.php">
                            Order Now</a>
                        </button>
                    </div>
                    </div>
                    <figure class="image">
                        <img src="product_slider-main/images/1.png" alt="">
                        <figcaption>BINI Dream - Frappe</figcaption>
                    </figure>
                </article>
                <article class="item active">
                    <div class="main-content" 
                    style="background-color: #f5bfaf;">
                    <div class="content">
                        <h2>BINIBeybi Milk Tea - Online Shop</h2>
                        <button class="addToCard"><a href="admin/login.php">
                            Order Now</a>
                        </button>
                    </div>
                    </div>
                    <figure class="image">
                        <img src="product_slider-main/images/2.png" alt="">
                        <figcaption>Sweet berry - Fruit Tea</figcaption>
                    </figure>
                </article>
                <article class="item other_2">
                    <div class="main-content" 
                    style="background-color: #dedfe1;">
                    <div class="content">
                        <h2>BINIBeybi Milk Tea - Online Shop</h2>
                        <button class="addToCard"><a href="admin/login.php">
                            Order Now</a>
                        </button>
                    </div>
                    </div>
                    <figure class="image">
                        <img src="product_slider-main/images/3.png" alt="">
                        <figcaption>Boba Caramel - Milk Tea</figcaption>
                    </figure>
                </article>
                <article class="item">
                    <div class="main-content" 
                    style="background-color: #7eb63d;">
                        <div class="content">
                            <h2>BINIBeybi Milk Tea - Online Shop</h2>
                            <button class="addToCard"><a href="admin/login.php">
                                Order Now</a>
                            </button>
                        </div>
                    </div>
                    <figure class="image">
                        <img src="product_slider-main/images/4.png" alt="">
                        <figcaption>Nescafe Creamy White - Coffee</figcaption>
                    </figure>
                </article>
            </div>
            <div class="arrows">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>
        </section>
    </main>

    <script src="product_slider-main/app.js"></script>
</body>
</html>