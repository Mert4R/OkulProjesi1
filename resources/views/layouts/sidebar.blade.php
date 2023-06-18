<div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            KİTAP DİYARI
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active">
                <a href="{{route('admin.index')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Gösterge Paneli</p>
                </a>
            </li>
            <li>
                <a href="{{route('admin.yayinevi.index')}}">
                    <i class="material-icons">home</i>
                    <p>Yayın Evi</p>
                </a>
            </li>
            <li>
                <a href="{{route('admin.yazar.index')}}">
                    <i class="material-icons">person</i>
                    <p>Yazarlar</p>
                </a>
            </li>
            <li>
                <a href="{{route('admin.kategori.index')}}">
                    <i class="material-icons">list</i>
                    <p>Kategoriler</p>
                </a>
            </li>
            <li>
                <a href="{{route('admin.kitap.index')}}">
                    <i class="material-icons">books</i>
                    <p>Kitaplar</p>
                </a>
            </li>
            <li>
                <a href="{{route('admin.slider.index')}}">
                    <i class="material-icons">image</i>
                    <p>Slider</p>
                </a>
            </li>
            <li>
                <a href="{{route('admin.order.index')}}">
                    <i class="material-icons text-gray">shop</i>
                    <p>Siparişlerim</p>
                </a>
            </li>
        </ul>
    </div>
</div>
