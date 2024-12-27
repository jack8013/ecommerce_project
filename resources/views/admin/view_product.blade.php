<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<style type="text/css">
    .product_div {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product_table {
        border: 2px solid greenyellow;
    }

    th {
        background-color: skyblue;
        color: white;
        font-size: 1em;
        font-weight: bold;
        padding: 15px;
    }

    td {
        border: 1px solid skyblue;
        text-align: center;
    }
</style>

<body>
    <!-- Header Start -->
    @include('admin.header')
    <!-- Header End -->
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">

                    <h1>All Products</h1>
                    <div class='product_div'>

                        <table class='product_table'>
                            <tr>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Image
                                </th>
                            </tr>

                            @foreach($products as $product)
                            <tr>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>
                                    {{$product->description}}
                                </td>
                                <td>
                                    {{$product->category}}
                                </td>
                                <td>
                                    {{$product->price}}
                                </td>
                                <td>
                                    {{$product->quantity}}
                                </td>
                                <td>
                                    <img src="{{ asset('products/' . $product->image) }}" style="width: 150px; height: auto;">
                                </td>

                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
            <!-- JavaScript files-->
            <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
            <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
            <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
            <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
            <script src="{{asset('admincss/js/charts-home.js')}}"></script>
            <script src="{{asset('admincss/js/front.js')}}"></script>
</body>

</html>