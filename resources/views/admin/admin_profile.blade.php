@extends('layouts.app-admin')

@section('content')

<div class="main--container">
 <style>
    * {
      box-sizing: border-box;
    }
    
    input[type=text], select, textarea {
      width: 70%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }
    
    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }
    
    input[type=submit] {
      background-color: #04AA6D;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }
    
    input[type=submit]:hover {
      background-color: #45a049;
    }
    
    .container {
      border-radius: 5px;
      background-color: white;
      padding: 20px;
    }
    
    
    .col-35 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }
    
    .col-65 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }
    
    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    
    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>


    <div class="container">
        <h1>Admin Profile</h1>

        <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
        <div class="col-35">
          <label for="first_name"> First Name :</label>
        </div>
        <div class="col-65">
        <input type="text" name="first_name" id="name" class="form-control" value="{{ $admin->first_name }}" required>
        </div>
      </div>

      <div class="row">
        <div class="col-35">
          <label for="middle_name"> Middle Name :</label>
        </div>
        <div class="col-65">
        <input type="text" name="middle_name" id="name" class="form-control" value="{{ $admin->middle_name }}" required>
        </div>
      </div>

           

            <div class="row">
        <div class="col-35">
          <label for="phone_number"> Phone Number :</label>
        </div>
        <div class="col-65">
        <input type="text" name="phone_number" id="name" class="form-control" value="{{ $admin->phone_number }}" required>
        </div>
      </div> 
                <div class="row">
                    <div class="col-35">
                <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            </div>

            <div class="profile-picture-preview">
                @if ($admin->profile_picture)
                    <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture">
                @else
                    <span>No profile picture available</span>
                @endif
            </div>

            <!-- Add more fields for other details you want to update -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection