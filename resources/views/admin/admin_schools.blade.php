<!-- students.blade.php -->

@extends('layouts.app-admin')

@section('content')
<div class="table">
    <div class="tabelitems">
      <div class="search-container">
        <div class="searchgroup">
          <form action="{{ route('admin.search.schools') }}" method="GET" role="search">   
            {{ csrf_field() }}
            <input placeholder="Search school" type="text" class="input" name="search" value="{{ Request::get('search') }}">
          </form>
        </div>
      </div>
    </div>
    <div class="button-container">
        <form action="{{ route('admin.schools.create') }}" method="GET">
            @csrf
            <button type="submit">New School</button>
        </form>
    </div>


    <div class="section--title">
        <h3 class="title">All Registered Schools</h3>
    </div>
    <table>
        <thead>
            @php
            $i = 0;
            @endphp
            <tr>
                <th>#</th>
                <th>School Name</th>
                <th>County</th>
                <th>Category</th>
                <th>Gender</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @if(isset($schools))
        @foreach($schools as $index => $school)
            <tr>
                <td>{{ $schools->firstItem() + $index }}</td>
                <td>{{ $school->name }}</td>
                <td>{{ $school->county }}</td>
                <td>{{ $school->category }}</td>
                <td>{{ $school->gender }}</td>
                <td>{{ $school->capacity }}</td>
                <td>
                    <a href="{{ route('admin.schools.update', $school -> id) }}" class="edit cursor-pointer" title="edit" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen"></i></a>
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
    @if(isset($schools))
    <div class="pagination">
        {{ $schools->links('admin.custom-pagination') }}
    </div>
    @endif
</div>
@endsection
