<!DOCTYPE html>
<html>
<head>
    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        .nav {
            width: 150px;
            height: 100px;
            float: right;


        }
        .anamenu, .altmenu {
            list-style: none;
            text-align: center;
        }

        .anamenu a{
            display: block;
            padding: 12px;
            text-decoration: none;
            color: white;
        }

        .anamenu a:hover {
            background-color:white;
            text-decoration: none;
            color: black;
        }


        .anamenu li:hover .altmenu {
            display: block;

            max-height: 200px;
        }

        .altmenu a{
            background-color:black;
        }

        .altmenu a:hover {
            background-color:black;
            color: white;
        }

        .altmenu {
            overflow: hidden;

            max-height: 0;

            -webkit-transition: all 0.5s ease-out;
        }
    </style>
    <title>@yield('title', config('app.name'))</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
    <script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
    <!--Custom-Theme-files-->
    <!--theme-style-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Luxury Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--start-menu-->
    <script src="{{asset('js/simpleCart.min.js')}}"> </script>
    <link href="{{asset('css/memenu.css')}}" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{asset('js/memenu.js')}}"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <!--dropdown-->
    <script src="{{asset('js/jquery.easydropdown.js')}}"></script>
</head>
<body>

<div style="width: 60px;float: left; height: 50px;">

    @include('layouts.sidebar2')
</div>
<div class="top-header">
                @auth()
                <div>
                    <div style="text-align: right;float: left;width: 1690px; height: 50px;margin-top: 5px">
                        <nav class="nav">
                            <ul class="anamenu">
                            <li><a  href="" >{{Illuminate\Support\Facades\Auth::user()->name}}</a>
                                    <ul class="altmenu">

                                        <li>
                                            <a href="{{route('profil.index')}}"> Profil

                                            </a>
                                        <li>
                                            <a href="{{route('begen.index')}}"> Beğendiklerim

                                            </a>


                                        </li>
                                        <li>
                                            <a href="{{route('order.index')}}"> Siparişlerim

                                            </a>


                                        </li>
                                        <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}" style=";color: white">Çıkış Yap</a>
                                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                                            {{csrf_field()}}
                                        </form>
                                        </li>

                                    </ul>
                            </li>
                            </ul>
                        </nav>
                    </div>
                    <div style="margin-top: 5px;float: left;color: white; height: 40px;width: 13px;padding-top: 12px;">
                        /
                    </div>

                    <div class="sepet-simge" style="margin-top: 5px;text-align: right;float: left;padding-left: 10px;padding-top: 2px; ">
                    <a href="{{route('sepet.index')}}">
                        <div class="total">
                            <span style="font-size: 13px;">{{App\Helper\sepetHelper::totalPrice()}} TL</span></div>
                        <img src="{{asset('images/cart-1.png')}}" alt="" />
                    </a>
                    <p><a href="{{route('sepet.flush')}}" class="simpleCart_empty">Sepeti Boşalt</a></p>
                    </div>
                </div>
                    @endauth
                    <div class="drop">


                        @guest()
                            <div style="text-align: right;padding-right: 20px;padding-top: 5px;float: left;width: 1700px; height: 40px;">
                                <a href="{{route('login')}}" style="color: white">Giriş Yap</a>
                            </div>
                        <div style="padding-top: 5px;float: left;color: white; height: 40px;width: 13px">
                            /
                        </div>
                            <div style="text-align: center;float: left;padding-top: 5px;height: 40px;width: 70px;  ">
                                <a href="{{url('/register')}}" style="color: white">Kayıt Ol</a>
                            </div>
                        @endguest
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

            <div class="clearfix"></div>



<!--top-header-->
<!--start-logo-->
<div class="logo">
    <a href="{{route('index')}}"><h1>Kitap Diyarı</h1></a>
</div>
<!--start-logo-->
<!--bottom-header-->
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="top-nav">
                    <ul class="memenu skyblue">
                        <li class="active"><a href="{{route('index')}}">Anasayfa</a></li>
                            @foreach(App\YayinEvi::all() as $key => $value)
                            <li class="grid"><a href="{{route('yayin',['selflink'=>$value['selflink']])}}">{{$value['name']}}</a></li>
                            @endforeach
                   <!--     <li class="grid"><a href="#">Women</a>
                            <div class="mepanel">
                                <div class="row">
                                    <div class="col1 me-one">
                                        <h4>Shop</h4>
                                        <ul>
                                            <li><a href="products.html">New Arrivals</a></li>
                                            <li><a href="products.html">Blazers</a></li>
                                            <li><a href="products.html">Swem Wear</a></li>
                                            <li><a href="products.html">Accessories</a></li>
                                            <li><a href="products.html">Handbags</a></li>
                                            <li><a href="products.html">T-Shirts</a></li>
                                            <li><a href="products.html">Watches</a></li>
                                            <li><a href="products.html">My Shopping Bag</a></li>
                                        </ul>
                                    </div>
                                    <div class="col1 me-one">
                                        <h4>Style Zone</h4>
                                        <ul>
                                            <li><a href="products.html">Shoes</a></li>
                                            <li><a href="products.html">Watches</a></li>
                                            <li><a href="products.html">Brands</a></li>
                                            <li><a href="products.html">Coats</a></li>
                                            <li><a href="products.html">Accessories</a></li>
                                            <li><a href="products.html">Trousers</a></li>
                                        </ul>
                                    </div>
                                    <div class="col1 me-one">
                                        <h4>Popular Brands</h4>
                                        <ul>
                                            <li><a href="products.html">499 Store</a></li>
                                            <li><a href="products.html">Fastrack</a></li>
                                            <li><a href="products.html">Casio</a></li>
                                            <li><a href="products.html">Fossil</a></li>
                                            <li><a href="products.html">Maxima</a></li>
                                            <li><a href="products.html">Timex</a></li>
                                            <li><a href="products.html">TomTom</a></li>
                                            <li><a href="products.html">Titan</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="grid"><a href="contact.html">Contact</a>
                        </li>-->
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-3 header-right">
                <div class="search-bar">
                    <form action="{{route('search')}}" >
                    <input type="text" name="q" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                    <input type="submit" value="">
                    </form>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--bottom-header-->

@yield('content')

<div style="width: 350px" class="col-md-6 infor-left">

</div>
<div class="col-md-6 infor-left">
    <hr style="width: 1135px">

</div>

<div class="information">
    <div class="container">
        <div class="infor-top">
            <div class="col-md-3 infor-left">
                <h3>Bizi Takip Edin</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                    <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                    <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Bilgilendirme</h3>
                <ul>
                    <li><a href="#"><p>Çok Satanlar</p></a></li>
                    <li><a href="#"><p>Yeni Ürünler</p></a></li>
                    <li><a href="#"><p>Kendi Mağazalarımız</p></a></li>
                    <li><a href="contact.html"><p>Bizimle İletişime Geçin</p></a></li>
                    <li><a href="#"><p>En Çok Beğenilenler</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Hesabım</h3>
                <ul>
                    <li><a href="#"><p>Hesabım</p></a></li>
                    <li><a href="#"><p>Satın Alımlar</p></a></li>
                    <li><a href="#"><p>Hesap Bilgilerim</p></a></li>
                    <li><a href="#"><p>Adreslerim</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Mağaza Bilgisi</h3>
                <h4>Kitap Diyarı,
                    <span>Çınar Mah. 1678. sok,</span>
                    no:8/6 İstanbul/Esenyurt.</h4>
                <h5>+90 538 954 7821</h5>
                <p><a href="mailto:example@email.com">iletisimegec@gmail.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->
<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
                <form>
                    <input type="text" value="E-mailinizi giriniz" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mailinizi giriniz';}">
                    <input type="submit" value="Abone Ol">
                </form>
            </div>
            <div class="col-md-6 footer-right">
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="/">Kitap Diyarı</a>, Tüm Hakları Saklıdır.
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--footer-end-->
</body>
</html>
