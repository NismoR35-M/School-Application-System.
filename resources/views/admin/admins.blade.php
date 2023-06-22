<!-- admins.blade.php -->

@extends('layouts.app-admin')

@section('content')
<div class="table">
    <h2>Admins</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>email</th>
                <th>phone_number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $index => $admin)
                <tr>
                    <td>{{ $admins-> firstItem() + $index }}</td>
                    <td>{{ $admin->first_name}}</td>
                    <td>{{ $admin->middle_name}}</td>
                    <td>{{ $admin->email}}</td>
                    <td>{{ $admin->phone_number}}</td>
                    <td>
                    <a class="edit cursor-pointer" title="edit" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen"></i></a>
                    |
                    <a class="delete cursor-pointer" title="Delete" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></a>
                    </td>   
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        <div class="hint-text">Showing <b>{{ $admins->firstItem() }}</b> to <b>{{ $admins->lastItem() }}</b> of <b>{{ $admins->total() }}</b> entries</div>
        {{ $admins->links('admin.custom-pagination') }}
    </div>
    
</div>
@endsection
