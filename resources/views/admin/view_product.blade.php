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
        margin-top: 15px;
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
        color: white;
    }

    input[type=search] {
        margin-left: 50px;
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

                    <form action="{{route('admin.search_product')}}" method="GET">
                        @csrf
                        <input type="search" name="search">
                        <input type="submit" class="btn btn-secondary" value="Search">
                    </form>

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
                                    <img src="{{asset('products/' . $product->image) }}" style="width: 150px; height: auto;">
                                </td>
                                <td>
                                    <button class="btn btn-success edit-btn" data-id="{{$product->id}}">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger delete-btn" data-id="{{$product->id}}">
                                        Delete
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <div class="product_div">
                        {{$products->links()}}
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
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

            <script>
                const deleteProductUrl = '/admin/delete_product';

                document.querySelectorAll('.btn-danger').forEach((button) => {
                    button.addEventListener('click', async (event) => {
                        const productId = button.getAttribute('data-id');

                        if (confirm('Are you sure you want to delete this product?')) {
                            try {
                                const response = await axios.delete(`${deleteProductUrl}/${productId}`);
                                if (response.status === 200) {
                                    alert('Product deleted successfully!');
                                    location.reload(); // Reload the page to reflect changes
                                }
                            } catch (error) {
                                console.error('Error deleting product:', error);
                                alert('An error occurred while deleting the product.');
                            }
                        }
                    });
                });
            </script>

            <script>
                const productUrl = '/admin/edit_product';
                document.querySelectorAll('.btn-success').forEach((button) => {
                    button.addEventListener('click', async (event) => {
                        const productId = button.getAttribute('data-id');

                        try {
                            window.location.href = `${productUrl}/${productId}`;
                        } catch (error) {
                            console.error('Error editing product:', error);
                            alert('An error occurred while editing the product.');
                        }
                    })
                })
            </script>
</body>

</html>