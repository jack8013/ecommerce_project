<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">
        input[type='text'] {
            width: 400px;
            height: 50px;
        }

        .add_category {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category_table {
            text-align: center;
            margin: auto;
            margin-top: 30px;
        }

        th {
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        td {
            color: white;
            padding: 10px;
        }
    </style>


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
                    <h1 style="color:white">Add Category</h1>

                    <!-- For API calls -->
                    <!-- <div class="add_category">
                        <input type="text" id="category_name" name="category_name" placeholder="Category Name">
                        <input type="submit" class="btn btn-primary" value="Add Category" id="submitCategory">
                    </div> -->

                    <form action="{{route('admin.add_category')}}" method="POST">
                        @csrf
                        <div class="add_category">
                            <form>
                                <div>
                                    <input type="text" name="category_name">
                                    <input type="submit" class="btn btn-primary" value="Add Category">
                                </div>

                            </form>

                        </div>
                    </form>

                    <div>
                        <table class="category_table" id="categoryTable">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

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
        <script src="{{asset('admincss/js/front.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            const apiUrl = '/api/categories';
            const tableBody = document.querySelector('#categoryTable tbody');

            async function fetchCategories() {

                tableBody.innerHTML = '';

                try {
                    const response = await axios.get(apiUrl);
                    const categories = response.data.data;

                    categories.forEach(element => {
                        const editUrl = "{{ route('admin.edit_category', ':id') }}".replace(':id', element.id);
                        const row = `<tr>
                                        <td>${element.category_name}</td>
                                        <td> <button class="btn btn-success edit-btn" data-id="${element.id}" data-url="${editUrl}">Edit</td>
                                        <td> <button class="btn btn-danger delete-btn" data-id="${element.id}" >Delete</td>
                                    </tr>`
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });

                } catch (error) {
                    console.error('Error fetching categories:', error);
                }
            }
            fetchCategories();
        </script>

        <script>
            // For API calls
            async function addCategories() {

                event.preventDefault();

                const categoryName = document.getElementById('category_name').value;

                if (!categoryName) {
                    alert('Category name is required');

                    return;
                }

                try {
                    const response = await axios.post(apiUrl, {
                        category_name: categoryName
                    });

                    if (response.status === 200) {

                        document.getElementById('category_name').value = '';
                        const newData = response.data.data;
                        tableBody.insertAdjacentHTML(
                            'beforeend',
                            `<tr>
                                <td>${newData.category_name}</td>

                            </tr>`
                        );

                    }

                } catch (error) {
                    console.error('Error adding categories:', error);
                }
            }

            //document.getElementById('submitCategory').addEventListener('click', addCategories);
        </script>

        <script>
            const deleteUrlBase = '/admin/delete_category'; // Replace with your actual web route if using Blade-generated delete URL

            document.querySelector('#categoryTable').addEventListener('click', async (event) => {
                if (event.target.classList.contains('delete-btn')) {
                    const categoryId = event.target.getAttribute('data-id');
                    const confirmed = confirm('Are you sure you want to delete this category?');
                    if (confirmed) {
                        try {
                            // Send a DELETE request via Axios;
                            const response = await axios.delete(`${deleteUrlBase}/${categoryId}`);

                            if (response.status === 200) {
                                location.reload();
                            }
                        } catch (error) {
                            console.error('Error deleting category:', error);
                        }
                    }
                }
            });
        </script>

        <script>
            const editUrl = '/admin/edit_category';
            document.querySelector('#categoryTable').addEventListener('click', async (event) => {
                if (event.target.classList.contains('edit-btn')) {
                    const categoryId = event.target.getAttribute('data-id');
                    try {
                        window.location.href = `${editUrl}/${categoryId}`;
                    } catch {

                    }
                };
            });
        </script>
</body>

</html>