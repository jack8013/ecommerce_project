<!DOCTYPE html>
<html>

<head>
    @include('home.css');
    <style>
        .div_design {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .detail-box {
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->


    </div>
    <!-- end hero area -->
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Product Details
                </h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="div_design">

                            <div width="400" class="img-box">
                                <img src="{{asset('images/p1.png')}}" alt="">
                            </div>



                        </div>

                        <div class="detail-box">
                            <h6>
                                {{$product->name}}
                            </h6>
                            <h6>
                                Price
                                <span>
                                    {{$product->price}}
                                </span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <h6>
                                Category: {{$product->category}}
                            </h6>
                            <h6>
                                Quantity
                                <span>
                                    {{$product->quantity}} In Stock
                                </span>
                            </h6>
                        </div>


                        <div class="detail-box">
                            <p>{{$product->description}}</p>

                        </div>

                        <div class="detail-box">
                            <form action="{{route('add_cart',$product->id)}}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}">
                                <input class="btn btn-primary" type="submit" value="Add to Cart"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- info section -->
    @include('home.footer')
    <!-- end info section -->


    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="{{asset('js/custom.js')}}"></script>

</body>

</html>