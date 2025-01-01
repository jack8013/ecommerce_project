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

        td{
            border: 1px solid skyblue;
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

    <div class="div_design">
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
            @foreach($cart as $cart)
            <tr>
                <td>
                    {{$cart->product->name}}
                </td>
                <td>
                    {{$cart->product->price}}
                </td>
                <td>
                {{$cart->product->image}}
                </td>
            </tr>
            @endforeach


        </table>
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