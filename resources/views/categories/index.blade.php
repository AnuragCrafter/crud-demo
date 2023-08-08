<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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

        .subContainer2 {
            flex:0.05;
            align-items: center;
            
        }

        .subContainer1 {
            flex:1;
            display:flex;
            gap: 50px;
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

        table.dataTable tbody td {
    padding: 0px 0px;
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
            margin-bottom:4px;
        }

        ul {
            display: flex;
        }
    </style>


    <title>Categories</title>
</head>

<body>

    <div class="container">
        <div class="subContainer1">
            <a class="nav cat" href="{{ route('books.index') }}"> Switch to Books</a>
            <a class="nav cat" href="{{route('categories.create')}}"> Add New Category</a>
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
        <h1>Categories</h1>
    </div>
    <div class="table-wrap">
        <table id="categorytable">
            <thead>
                <th>
                    <h3>Sr No</h3>
                </th>
                <th>
                    <h3>Category Name</h3>
                </th>
                <th>
                    <h3>Books Count</h3>
                </th>
                <th>
                    <h3>Action</h3>
                </th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>


</body>

<script>

$(document).ready(function () {
    
         $('#categorytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('CategoryDataTable') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'books_count', name: 'books_count'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: true,
            },
        ]
    });    
  });


@if(session()->has('success'))
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Category created successfully.',
});
@endif

@if(session()->has('update'))
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Category name updated successfully.',
});
@endif

function confirmation(ev){
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
      'Your Category is safe.',
      'error'
    )
  }
})
}
@if(session()->has('delete'))
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Category Deleted successfully.',
});
@endif

</script>

</html>
