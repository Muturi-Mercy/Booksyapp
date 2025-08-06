@extends('layouts.admin-app')

@section('content')

<section class="addbook-section">

    <div class="addbook-title">
        <h2>Booksy Admin</h2>
        <p>Update book details below to keep your inventory accurate and up to date.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Book Update</h3>
        
        <div class="continue">
            <a href="{{ route('admin.books.index') }}"><i class="fa-solid fa-circle-arrow-left cicons"></i><span>Back to Book List</span></a>    
        </div>

        <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">

            @csrf
            <label class="plabel">Title:</label>
            <input type="text" name="title" value="{{ $book->title }}" required class="pinput"><br>

            <label class="plabel">Author:</label>
            <input type="text" name="author" value="{{ $book->author }}" required class="pinput"><br>

            <label class="plabel">Genre:</label>
            <input type="text" name="genre" value="{{ $book->genre }}" required class="pinput"><br>

            <label class="plabel">Price:</label>
            <input type="number" name="price" value="{{ $book->price }}" step="0.01" required class="pinput"><br>

            <label class="plabel">Stock Quantity:</label>
            <input type="number" name="stock_quantity" value="{{ $book->stock_quantity }}" required class="pinput"><br>

            <label class="plabel">Cover Image:</label><br>
            @if($book->cover_image)
                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" width="100"><br>
            @endif
            <input type="file" name="cover_image" class="pinput"><br><br>

            <button type="submit" class="pbtn">Update Book</button>

        </form>

    </div>

</section>
@endsection
