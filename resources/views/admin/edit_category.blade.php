<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

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

                    <h1>Update Category</h1>

                    <form action="{{ route('admin.update_category',$data->id) }}" method=POST>


                        @csrf
                        <input type="text" name="category_name" value="{{$data->category_name}}">
                        <input class="btn btn-success" type="submit" value="Edit">
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