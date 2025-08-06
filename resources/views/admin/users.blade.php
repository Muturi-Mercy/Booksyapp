@extends('layouts.admin-app')

@section('content')
<section class="orderlisting-section">

    <div class="orderlisting-title">
        <h2>Booksy Admin</h2>
        <p>Manage all registered users, view their details, and take administrative actions.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">User List</h3>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>{{ $user->orders->count() }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="edit-btn">View Profile</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this user?')" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        
    </div>
</section>

@endsection
