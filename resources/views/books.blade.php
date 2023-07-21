<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>

    <style>
        * {
            margin: 10px 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        a {
            height:30px;
            padding:10px 15px;
            text-decoration:none;            
        }

        .table-wrap {
            max-width: 800px;
            margin: 20px auto;
            overflow-x: auto;
        }

        table,
        td,
        th {
            border: 1px solid #ddd;
            text-align: center;
            font-size: 15px;
            text-transform: capitalize;
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

        .red {
            background: #ed3b3b;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .add {           
            text-align:right;
            margin-left:1780px;
            padding: 10px;
        }

    </style>


    <title>View Books Records</title>
</head>

<body>

    
    <a class="green add"  href="{{ route('books.create') }}"> Add New Book</a>
    <div class="box-wrap">
        <h1>Books Records</h1>
    </div>
    <div class="table-wrap">
        <table border="1">
            <thead>
                <th>
                    <h3>Book ID</h3>
                </th>
                <th scope="col">
                    <h3>Book Name</h3>
                </th>
                <th scope="col">
                    <h3>Action</h3>
                </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr scope="row">
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['name'] }}</td>
                        <td>
                            <form action="{{ route('books.destroy',$book->id) }}" method="Post" >
                            
                                <a class="green" href="{{ route('books.edit',$book->id) }}">Edit</a>
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

@if(session()->has('success'))
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Book saved successfully.',
});
@endif

@if(session()->has('update'))
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Book name updated successfully.',
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
      'Your Book is safe.',
      'error'
    )
  }
})
}
@if(session()->has('delete'))
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Book Deleted successfully.',
});
@endif

        
        
  
</script>

</body>

</html>
