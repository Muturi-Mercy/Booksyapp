@extends('layouts.admin-app')

@section('content')

<section class="lowstock-section">
    
    <div class="lowstock-title">
        <h2>Booksy</h2>
        <p>These books are running low. Restock now to avoid missing out on sales.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Low Stock</h3>

        <div class="table-container">

            @if($books->isEmpty())
            <p>All books are sufficiently stocked.</p>
            @else

            <table >
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td style="color: red;">{{ $book->stock_quantity }}</td>
                        <td>
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="cart-btn order-btn">Restock</a>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>

            @endif

        </div>
    </div>
</section>
@endsection
