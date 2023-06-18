<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </style>
</head>
<body>

<div id="YanMenu" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">

        &times;</a>
    <ul>

    <li class="active"><a href="{{route('index')}}">Anasayfa</a></li>
    @foreach(App\Kategoriler::all() as $key => $value)
        <li class="grid"><a href="{{route('cat',['selflink'=>$value['selflink']])}}">{{$value['name']}}</a></li>
    @endforeach
    </ul>
</div>

<div id="main">



    <span style="font-size:30px;cursor:pointer" onclick="openNav()">

  &#9776;</span>

</div>

<script>
    function openNav() {
        document.getElementById("YanMenu").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("YanMenu").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }
</script>

</body>
</html>
