
@vite(['resources/css/navigation.css', 'resources/js/navigation.js'])

<header class="flex fixed-top"  id="header"><!--header-start-->


    <div class="nav-cont ">



        <div class="header_left">
            <a class="logo" href="{{ route('home') }}"><h1 id="header_h1" style="color: #343a40;">PRO<span style="color: rgb(28, 122, 165);">GASTRO</h1></a>
        </div>

        <div class="header_mid">

            <label for="menuTrigger" class="nav_ico"><i class='bx bx-menu' style='color:#343a40'  ></i></label>
            <input id="menuTrigger" type="checkbox" name="">

            <nav class="main_nav">
                <div class="hiddenTittle">
                    <h1 style="color: #343a40;">PRO<span style="color: rgb(28, 122, 165);">GASTRO</h1>
                    <label for="menuTrigger">
                        <i class='bx bx-x ' style='color:#343a40'  ></i>
                    </label>
                </div>
                <ul>
                    <li><a href="{{ route('about') }}">ABOUT</a></li>

                    <li class="products">
                        <div class="products-nav">
                            <a href="{{ route('products') }}">PRODUCTS</a>
                            <i class='bx bx-chevron-down chevron-products' style='color:#343a40' ></i>
                        </div>

                        <ul>
                            <li><a href="{{ route('products', ['category' => 'Knives']) }}">Knives</a>
                                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                                <ul>
                                    <li><a href="{{ route('products', ['category' => 'Knives', 'brand' => 'Zwilling']) }}">Zwilling Knives</a></li>
                                    <li><a href="{{ route('products', ['category' => 'Knives', 'brand' => 'Swibo']) }}">Swibo Knives</a></li>
                                    <li><a href="{{ route('products', ['category' => 'Knives', 'brand' => 'Victorinox']) }}">Victorinox Knives</a></li>
                                    <li><a href="{{ route('products', ['category' => 'Knives', 'brand' => 'Dick']) }}">Dick Knives</a></li>

                                </ul>
                            </li>
                            <li><a href="#">Brands</a>
                                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                                <ul>
                                    <li><a href="{{ route('products', ['brand' => 'Zwilling']) }}">Zwilling </a></li>
                                    <li><a href="{{ route('products', ['brand' => 'Swibo']) }}">Swibo</a></li>
                                    <li><a href="{{ route('products', ['brand' => 'Victorinox']) }}">Victorinox</a></li>
                                    <li><a href="{{ route('products', ['brand' => 'Dick']) }}">Dick</a></li>
                                </ul></li>

                            <li><a href="{{ route('products', ['category' => 'Sharpener']) }}">Sharpen</a>
                                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                                <ul>
                                    <li><a href="{{ route('products', ['category' => 'Sharpener', 'brand' => 'Zwilling']) }}">Zwilling Sharpen</a></li>
                                    <li><a href="{{ route('products', ['category' => 'Sharpener', 'brand' => 'Swibo']) }}">Swibo Sharpen</a></li>
                                    <li><a href="{{ route('products', ['category' => 'Sharpener', 'brand' => 'Victorinox']) }}">Victorinox Sharpen</a></li>
                                    <li><a href="{{ route('products', ['category' => 'Sharpener', 'brand' => 'Dick']) }}">Dick Sharpen</a></li>

                                </ul>
                            </li>

                            <li><a href="#">Meat Grinders</a>
                                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                                <ul>
                                    <li><a href="#">Zwilling</a></li>
                                    <li><a href="#">Swibo</a></li>
                                    <li><a href="#">Victorinox</a></li>
                                    <li><a href="#">Zwilling</a></li>
                                    <li><a href="#">Swibo</a></li>
                                    <li><a href="#">Victorinox</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Safety Equipment</a>
                                <i class='bx bx-chevron-down' style='color:#343a40'  ></i>
                                <ul>
                                    <li><a href="#">Footwear</a></li>
                                    <li><a href="#">Aprons</a></li>
                                    <li><a href="#">Butcher's uniform</a></li>
                                </ul></li>

                            <li><a href="#">Thermometers</a></li>
                        </ul>


                    </li>
                    <li><a href="{{ route('contact') }}">CONTACT</a></li>

                    <li><a href="{{ route('cart.all') }}">CART</a></li>
                </ul>


            </nav>



        </div>




        <div class="header_right">

            <div class="search_bar">
                <form class="search_form" action="{{ route('products') }}" method="GET na ">
                    <input class="search_input" type="text" value="{{ request('search') }}" name="search" placeholder="Search products...">
                    <button class="search_button" type="submit"><i class="ri-search-2-line "></i></button>
                </form>
            </div>

            <div class="container search_mobile" >
                <form action="{{ route('products') }}" method="GET" class="search" id="search-bar">
                    <input type="text" placeholder="Search products..." value="{{ request('search') }}" name="search" class="search__input">

                    <div class="search__button" id="search-button">
                        <i class="ri-search-2-line search__icon"></i>
                        <i class="ri-close-line search__close"></i>
                    </div>
                </form>
            </div>

            <div id="open-profile-info" class="my_profile">
                <label for="">
                    <a  href="#"><i class='bx bx-user admin' style='color:#343a40'  ></i></a>
                </label>
            </div>

        </div>




    </div>

    <div id="profile-info" class="profile_info">

            @auth
                <i id="close-profile-info" class='bx bx-x close_icon'></i>

                <div class="info_elements">
                    <i class='bx bx-envelope' ></i>
                    <a href="">{{ Auth::user()->name }}</a>
                </div>

                <div class="info_elements">
                    <i class='bx bx-user-check ' ></i>
                    <a href="/profile">Edit profile</a>
                </div>

                @if(Auth::check() && Auth::user()->role === 'admin')
                <div class="info_elements">
                    <i class='bx bx-folder-plus'></i>
                    <a href="{{ route('product.create') }}">Add product</a>
                </div>
                @endif




                <div class="info_elements">
                    <i class='bx bx-log-out' ></i>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>


            @else
                <i id="close-profile-info" class='bx bx-x close_icon'></i>
                <div class="info_elements">
                    <i class='bx bx-log-in' ></i>
                    <a href="{{ route('login') }}">Login</a>
                </div>
                <div class="info_elements">
                    <i class='bx bx-user-plus' ></i>
                    <a href="{{ route('register') }}">Register</a>
                </div>
            @endauth


    </div>


</header>
