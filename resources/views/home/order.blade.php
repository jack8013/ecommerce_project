<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .order_div {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .order_table {
            border: 2px solid greenyellow;
        }

        th {
            background-color: black;
            color: white;
            font-size: 1em;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }

        td {
            border: 1px solid skyblue;
            text-align: center;
            /* color: white; */
            padding: 20px;
        }

        input[type=search] {
            margin-left: 50px;
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

    <div class="order_div">
        <table class="order_table">
            <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product Name</th>
                <th>Price</th>
                {{-- <th>Image</th> --}}
                <th>Status</th>
            </tr>
            {{-- @foreach ($orders->orderDetails as $orderDetail) --}}
            @foreach ($orders as $order)
                @foreach ($order->orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $order->user->name}}</td>
                        <td>{{ $order->rec_address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->order_total }}</td>
                        <td>{{ $orderDetail->product_quantity }}</td>
                        {{-- <td>{{ $orderDetail->product->image }}</td> --}}
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            @endforeach
        </table>

    </div>



    <!-- info section -->
    @include('home.footer')
    <!-- end info section -->


    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
