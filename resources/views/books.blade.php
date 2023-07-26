<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <style>
        * {
            padding: 0;
        }

        .container {
            height: 50px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid black;
        }

        .subContainer1 {
            flex:1;
            display:flex;
            gap: 50px;
        }

        .subContainer2 {
            flex:0.05;
            align-items: center;
            
        }

        h1 {
            text-align: center;
        }

        a {
            height: 30px;
            padding: 10px 15px;
            text-decoration: none;
        }

        .table-wrap {
            max-width: 800px;
            margin: 40px auto;
            overflow-x: auto;
        }

        table,
        td,
        th {
            border: 1px solid #ddd;
            text-align: center;
            font-size: 15px;
            text-transform: capitalize;
            align-items:center;
        }

        th {
            background: #000000d6;
            color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 0px;
            white-space: nowrap;
        }

        table tbody tr:nth-child(odd) {
            background: #d9dcde;
            color: #000;
            font-weight: 500;
        }

        .box-wrap {
            padding: 0px 16px;
        }

        /*# sourceMappingURL=main.css.map */

        button {
            font-size: 15px;
            padding: 5;
            align: center;
            margin: 10px;
            width: 80px;
            height: 35px;
        }

        .green {
            background: #369c73;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .nav {
            border: none;
            color: black;
        }

        .red {
            background: #ed3b3b;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .add {
            float: right;
            padding: 10px;
            margin-right: 10px;
            height: 18px;
        }

        .cat {
            float: left;
            padding: 10px;
            margin-left: 10px;
            height: 18px;
            border: 5px;
            background: none;
        }

        select {
            height: 35px;
            width: 220px;
            float: right;
            margin-bottom:10px;
        }

        ul {
            display: flex;
        }
    </style>


    <title>View Books Records</title>
</head>

<body>

    <div class="container">
        <div class="subContainer1">
            <a class="nav cat" href="{{ route('categories.index') }}"> Switch to Categories</a>
            <a class="nav cat" href="{{ route('books.create') }}"> Add New Book</a>
        </div>
        <div class="subContainer2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')" onclick="event.preventDefault();
                this.closest('form').submit();"
                    class="nav cat">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>


    <div class="box-wrap">
        <h1>Books Records</h1>
    </div>

    <div class="table-wrap">
        

        <select onchange="document.location=this.options[this.selectedIndex].value">
            <option disabled="disabled" selected>Pick a choice!</option>
            <option value={{ route('books.index') }}>All</option>
            @foreach ($categories as $category)
                <option value="{{ route('books.index', ['category' => $category->id]) }}"
                    {{ $books == $category->name ? 'selected' : '' }}>{{ $category->name}}</option>
            @endforeach
        </Select>

        <table>
            <thead>
                <th>
                    <h3>Book ID</h3>
                </th>
                <th>
                    <h3>Book Name</h3>
                </th>
                <th>
                    <h3>Category Name</h3>
                </th>
                <th>
                    <h3>Action</h3>
                </th>
                </tr>
            </thead>
            <tbody>
            
                
            
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['name'] }}</td>
                        <td>
                            {{ $book->category->name }}
                        </td>
                        <td>
                        
                            <form action="{{ route('books.destroy', $book->id) }}" method="Post">

                                <a class="green" href="{{ route('books.edit', $book->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="red" onclick="confirmation(event)">Delete</button>
                            </form>
                        </td>
                    </tr>                    
                
                @endforeach
                
                
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Book saved successfully.',
            });
        @endif

        @if (session()->has('update'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Book name updated successfully.',
            });
        @endif

        function confirmation(ev) {
            ev.preventDefault();
            var form = event.target.form;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Your Book is safe.',
                        'error'
                    )
                }
            })
        }
        @if (session()->has('delete'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Book Deleted successfully.',
            });
        @endif
    </script>
</body>

</html>
