@extends('layouts.admin')
@section('title','Admin - Arama')
@section('content')
                   <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Arama Sonuçları</h4>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <div class="product-top" style="height: 300px;">
                                            @foreach($data->chunk(4) as $chunk)
                                                <div class="product-one">
                                                    @foreach($chunk as $key => $value)
                                                        <div class="col-md-3 product-left">
                                                            <div class="product-main simpleCart_shelfItem">
                                                                <a href="{{route('kitap.detay',['selflink'=>$value['selflink']])}}" class="mask">
                                                                    <img class="img-responsive zoom-img" style="width: 200px; height: 200px;" src="{{asset($value['image'])}}" alt="" /></a>
                                                                <div class="product-bottom">
                                                                    <h3>{{$value['name']}}</h3>
                                                                    <p>{{App\Yazarlar::getField($value['yazarid'],"name")}}</p>
                                                                    <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">{{$value['fiyat']}}TL</span></h4>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="clearfix"></div>
                                                </div>
                                            @endforeach
                                            {{$data->links()}}
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
@endsection


