<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<style type="text/css">
    .product_form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;

    }

    h1 {
        color: white;
    }

    label {
        display: inline-block;
        width: 250px;
        font-size: 1.25em !important;
    }

    input[type="text"] {
        width: 350px;
        height: 50px;
    }

    textarea {
        width: 450px;
        height: 80px;
    }

    .product_input {
        padding: 10px;
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

                    <h1>Add Product</h1>

                    <div class="product_form">
                        <form action="{{route('admin.upload_product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="product_input">
                                <label>
                                    Product Title
                                </label>
                                <input type="text" name="name" required>
                            </div>

                            <div class="product_input">
                                <label>
                                    Description
                                </label>
                                <textarea type="text" name="description" required></textarea>
                            </div>

                            <div class="product_input">
                                <label>
                                    Price
                                </label>
                                <input type="text" name="price" required>
                            </div>

                            <div class="product_input">
                                <label>
                                    Quantity
                                </label>
                                <input type="number" name="quantity" required>
                            </div>

                            <div class="product_input">
                                <label>
                                    Product Category
                                </label>
                                <select name="category">
                                    <option>
                                        Select an Option
                                    </option>

                                    @foreach($category as $category)
                                    <option value="{{$category->category_name}}">
                                        {{$category->category_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="product_input">
                                <label>
                                    Product Image
                                </label>
                                <input type="file" name="image">
                            </div>

                            <div class="product_input">
                                <input type="submit" class="btn btn-success" value="Add Product">
                            </div>
                        </form>
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