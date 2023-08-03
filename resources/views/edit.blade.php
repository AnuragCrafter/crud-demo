<html>

<head>
    <title></title>

    <style>
        * {
            padding: 0;
        }

        .container {
            height: 50px;
            color:black;
            border-bottom: 1px solid black;
        }

        a {
            height: 18px;
            padding: 10px 15px;
            text-decoration: none;
            margin: 5px;
            float:right;
            background: #369c73;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .box {
            max-width: 250px;
            height: 230px;
            padding: 30px;
            background: #d9dbde;
            display: flex;
            flex-direction: column;
            margin: auto;
            margin-top: 3vh;
            text-align: center;
            justify-content: center;


        }

        h3 {
            background: #369c73;
            width: 200px;
            margin: auto;
            padding: 10px 55px;
            margin-top: 20vh;
            text-align: center;
            color: white;
        }

        input {
            height: 35px;
            width: 220px;
            margin: auto;
        }

        button {
            font-size: 15px;
            padding: 5px;
            text-align: center;
            margin: 10 auto 0;
            width: 80px;
            height: 35px;
            cursor: pointer;
            background: #369c73;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .text-danger {
            color: red;
        }

        select {
            height: 35px;
            width: 220px;
            margin: auto;
        }
    </style>

</head>

<body>
    <div class="container"><a href="{{ route('books.index') }}"> Back</a></div>
    <h3>Edit Book details</h3>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="box">
            <h4>Update Book Name:</h4>
            <input type="text" name="name" value="{{ $book->name }}" placeholder="Enter your book name">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif

            <h4>Category</h4>
            <Select name="category" id="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $book->category_id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach

            </Select>
            @if ($errors->has('category'))
                <span class="text-danger">{{ $errors->first('category') }}</span>
            @endif

            </Select>
            <button type="submit" class="btn btn-primary ml-3">Save</button>
        </div>
    </form>

</body>

</html>
