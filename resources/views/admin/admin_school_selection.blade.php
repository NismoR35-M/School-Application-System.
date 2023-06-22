@extends('layouts.app-admin')

@section('content')
<div class="table">
    <div class="search-form">
        <form action="{{ route('admin.schoolSelection') }}" method="GET">
            <input type="text" name="search" placeholder="Search by school name" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="section--title">
        <h3 class="title">School Selection</h3>
    </div>
    <table>
        <thead>
            @php
            $i = 0;
            @endphp
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>School ID</th>
                <th>Student Name</th>
                <th>School Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users_schools as $index => $user_schools)
            <tr>
                <td>{{ $users_schools->firstItem() + $index }}</td>
                <td>{{ $user_schools->id }}</td>
                <td>{{ $user_schools->id }}</td>
                <td>{{ $user_schools->first_name }} {{ $user_schools->last_name }}</td>
                <td>
                    <select class="school-select">
                        @foreach ($user_schools->schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                </td>
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
            <div class="hint-text">Showing <b>{{ $users_schools->firstItem() }}</b> to
             <b>{{ $users_schools->lastItem() }}</b> of <b>{{ $users_schools->total() }}</b>
              entries</div>
              {{ $users_schools->appends(['search' => request('search')])->links('admin.custom-pagination') }}
        </div>
</div>
@endsection
