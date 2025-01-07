<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .div_design {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        .cart_table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            background-color: black;
            color: white;
            font-weight: bold;
            font: 1em;
        }

        td {
            border: 1px solid skyblue;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order-design {
            padding-right: 150px;
            margin-top: -200px;
        }

        label {
            display: inline-block;
            width: 150px;
        }

        .div-gap {
            padding: 20px;
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


    <?php
        $value = 0
    ?>
    <div class="div_design">

        <div class="order_design">
            <form action="{{ route('place_order') }}" method="POST">
                @csrf
                <div class="div-gap">
                    <label>Receiver Name</label>
                    <input type="text" name="name" value="{{Auth::user()->name}}">
                </div>

                <div class="div-gap">

                    <label>Receiver Address</label>
                    <textarea name="address" id="">{{Auth::user()->address}}</textarea>
                </div>
                <div class="div-gap">
                    <label>Receiver Phone</label>
                    <input type="text" name="phone" value="{{Auth::user()->phone}}">
                </div>

                <div class="div-gap">
                    <input class="btn btn-primary" type="submit" value="Place Order">
                </div>
            </form>
        </div>

        <table class="cart_table">
            <tr>
                <th>
                    Product Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Image
                </th>
            </tr>
            @foreach($cart->products as $product)
            <tr>
                <td>
                    {{$product->name}}
                </td>
                <td>
                    {{$product->price}}
                </td>
                <td>
                    {{$product->image}}
                </td>
                <td>
                    <form action="{{ route('remove_cart_item', $cart->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Remove">
                    </form>
                </td>
            </tr>
            <?php

            //$value = $value + $cart->product->price;
            ?>

            @endforeach

        </table>
    </div>
    <div class="cart_value">
        <h3>Total Value of Cart: ${{$value}}</h3>
    </div>

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