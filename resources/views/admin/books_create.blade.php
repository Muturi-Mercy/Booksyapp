@extends('layouts.admin-app')

@section('content')

<section class="addbook-section">

    <div class="addbook-title">
        <h2>Booksy Admin</h2>
        <p>Fill in the details below to add a new book to the store catalog.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">New Books</h3>
        
        <div class="continue">
            <a href="{{ route('admin.books.index') }}"><i class="fa-solid fa-circle-arrow-left cicons"></i><span>Back to Book List</span></a>    
        </div>

        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">

            @csrf
            <label class="plabel">Title:</label>
            <input type="text" name="title" required class="pinput"><br>

            <label class="plabel">Author:</label>
            <input type="text" name="author" required class="pinput"><br>

            <label class="plabel">Genre:</label>
            <input type="text" name="genre" required class="pinput"><br>

            <label class="plabel">Price:</label>
            <input type="number" name="price" step="0.01" required class="pinput"><br>

            <label class="plabel">Stock Quantity:</label>
            <input type="number" name="stock_quantity" required class="pinput"><br>

            <label class="plabel">Cover Image:</label>
            <input type="file" name="cover_image" required class="pinput"><br><br>

            <button type="submit" class="pbtn">Save Book</button>

        </form>

    </div>

</section>
@endsection
