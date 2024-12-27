<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<style type="text/css">
    .product_form {
        display: flex;
        justify-content: center;
        padding: 15px;
    }

    label {
        display: inline-block;
        width: 250px;
        font-size: 1.25em !important;
    }

    textarea{
        width: 450px;
        height: 80px;
    }

    input[type="text"] {
        width: 350px;
        height: 50px;
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

                    <h1>Update Product</h1>
                    <div class="product_form">

                        <form action="{{ route('admin.update_product',$data->id) }}" method=POST enctype="multipart/form-data">


                            @csrf

                            <div class="product_input">
                                <label>
                                    Product Title
                                </label>
                                <input type="text" name="name" value="{{$data->name}}" required>
                            </div>

                            <div class="product_input">
                                <label>
                                    Description
                                </label>
                                <textarea type="text" name="description" required>{{$data->description}}</textarea>
                            </div>

                            <div class="product_input">
                                <label>
                                    Price
                                </label>
                                <input type="text" name="price" value="{{$data->price}}" required>
                            </div>

                            <div class="product_input">
                                <label>
                                    Quantity
                                </label>
                                <input type="number" name="quantity" value="{{$data->quantity}}" required>
                            </div>

                            <div class="product_input">
                                <label>
                                    Product Category
                                </label>
                                <select name="category">
                                    <option value="{{$data->category}}">
                                        {{$data->category}}
                                    </option>

                                    @foreach($category as $category)

                                    @if($data->category !== $category->category_name)
                                    <option value="{{$category->category_name}}">
                                        {{$category->category_name}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="product_input">
                                <label>Current Image</label>
                                <img width="150" src="/products/{{$data->image}}" alt="" class="">
                            </div>

                            <div class="product_input">
                                <label class="">New Image</label>
                                <input type="file" name="image">
                            </div>
                            <input class="btn btn-success" type="submit" value="Edit">
                        </form>
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