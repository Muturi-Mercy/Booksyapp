@extends('layouts.admin-app')

@section('content')
<section class="listing-section">
    <div class="listing-title">
        <h2>Booksy Admin</h2>
        <p>Manage your book inventory with ease. Add, edit, and track all books in one place.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Book Listing</h3>
        
        <div class="continue">
            <a href="{{ route('admin.books.create') }}"><i class="fa-solid fa-plus fa-fade cicons"></i><span>Add New Book</span></a>    
        </div>

        <div class="table-container">
            <table>

                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Price(KES)</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>
                            @if($book->cover_image)
                                <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" width="50" >
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->stock_quantity }}</td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="edit-btn"> Edit</a>
                            <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" >
                                @csrf
                                <button type="submit" onclick="return confirm('Delete this book?')" class="delete-btn"> Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No books found.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</section>
@endsection
