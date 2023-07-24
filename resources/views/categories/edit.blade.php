<html>
<head>
<title></title>

<style>
* {
            margin: 10px 0;
            padding: 0;
        }
a {
            margin-top:100px;
            height:30px;
            padding:10px 15px;;
            text-decoration:none;
            margin-left:1840px;
            background: #369c73;
            color: white;
            border: none;
            border-radius: 5px;
        }
    div {
        max-width:250px;
        height: 200px;
        padding: 30px;
        background:#d9dbde;
        display:flex;
        flex-direction:column;
        margin:auto;
        margin-top:3vh;
        text-align: center;
        justify-content: center;
        

    }

    h3 {
           background: #369c73;
           width: 200px;
           margin:auto;
           padding:10px 55px;
           margin-top:30vh;
           text-align:center;
           color:white;
    }

    input {
        height:35px;
        width: 220px;
        margin:auto;
    }

    button {
            font-size: 15px;
            padding: 5px;
            text-align: center;
            margin: auto;
            width: 80px;
            height: 35px;
            cursor:pointer;
            background: #369c73;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .text-danger {
            color: red;
        }
        
</style>

</head>
<body>
        <a href="{{ route('books.index') }}"> Back</a>
<h3>Edit Category details</h3>

<form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    
                    <div>
                        <h2>Update Category Name:</h2>
                        <input type="text" name="name" value="{{ $category->name }}" placeholder="Enter your category name">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                        <button type="submit" class="btn btn-primary ml-3">Save</button>
                    </div> 
</form>

</body>
</html>