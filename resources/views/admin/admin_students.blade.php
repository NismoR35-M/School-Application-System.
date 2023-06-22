@extends('layouts.app-admin')

@section('content')
<div class="table">
    <div class="tabelitems">
      <div class="search-container">
        <div class="searchgroup">
          <form action="{{ route('admin.search.students') }}" method="GET" role="search">   
            {{ csrf_field() }}
            <input placeholder="Search student" type="text" class="input" name="search" value="{{ Request::get('search') }}">
          </form>
        </div>
      </div>
    </div>
    <div class="button-container">
        <button>New Student</button>
    </div>
    <div class="section--title">
        <h3 class="title">All Registered Students</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>County</th>
                <th>Primary School</th>
            </tr>
        </thead>
        <tbody>
        @if(isset($users))

            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->middle_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->county }}</td>
                <td>{{ $user->primary_school }}</td>
                <td>
                    <a class="edit cursor-pointer" title="edit" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen"></i></a>
                    |
                    <a class="delete cursor-pointer" title="Delete" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(isset($message))
    <p>{{$message}} </p>
    @endif
    @if(isset($users))
    <div class="pagination">
        {{ $users->links('admin.custom-pagination') }}
    </div>
    @endif
</div>
@endsection
