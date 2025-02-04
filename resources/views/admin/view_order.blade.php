<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<style type="text/css">
    .order_div {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
    }

    .order_table {
        border: 2px solid greenyellow;
    }

    th {
        background-color: skyblue;
        color: white;
        font-size: 1em;
        font-weight: bold;
        padding: 15px;
        text-align: center;
    }

    td {
        border: 1px solid skyblue;
        text-align: center;
        color: white;
        padding: 20px;
    }

    input[type=search] {
        margin-left: 50px;
    }

    .order_details {
        justify-content: center;
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

                <div class="order_div">
                    <table class="order_table">
                        <tr>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Details</th>
                            <th></th>
                        </tr>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->rec_address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->order_total }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <form action="{{ route('admin.on_the_way', $order->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">On the Way</button>
                                    </form>
                                    <form action="{{ route('admin.delivered', $order->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Delivered</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('admin.print_pdf', $order->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary">Print PDF</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="order_details_toggle"
                                        data-order-id="{{ $order->id }}">Details</button>
                                </td>
                            </tr>

                            <tr class="order_details" id="order-details-{{ $order->id }}" style="display: none;">
                                <td colspan="8">
                                    <table class="order-details-table">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Quantity</th>
                                            <th>Product Price</th>
                                            <th>Price Total</th>
                                        </tr>
                                        @foreach ($order->orderDetails as $orderDetail)
                                            <tr>
                                                <td>{{ $orderDetail->product->name }}</td>
                                                <td>{{ $orderDetail->product_quantity }}</td>
                                                <td>{{ $orderDetail->product->price }}</td>
                                                <td>{{ $orderDetail->price_total }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- JavaScript files-->
        <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
        <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
        <script src="{{ asset('admincss/js/front.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            const element = document.getElementById("order_details_toggle");

            document.querySelectorAll('.order_details_toggle').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const detailRows = document.getElementById('order-details-' + orderId);
                    console.log(detailRows);
                    if (detailRows.style.display == 'none') {
                        detailRows.style.display = 'table-row';
                    } else {
                        detailRows.style.display = 'none';
                    }

                })
            })
        </script>

        <!-- <script>
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
            </script> -->
</body>

</html>
