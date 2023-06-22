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
  
    <h1>Create School</h1>
    <div class="container" id="schools-table">
     <form action="{{ route('admin.schools.store') }}" method="POST" >

        @if(Session::has('success,'))
        {{Session::get('success')}}
        @endif
        @csrf

      <div class="row">
        <div class="col-35">
          <label for="name">Name :</label>
        </div>
        <div class="col-65">
          <input type="text" name="name" id="name" required>
        </div>
      </div>
      <div class="row">
       <div class="col-35">
        <label for="county">County :</label>
       </div>
       <div class="col-65">
        <select name="county" id="county" required style="background-color: white;">
          <option value disabled selected>Select County </option>
          <option value="Baringo">Baringo</option>
          <option value="Bomet">Bomet</option>
          <option value="Bungoma">Bungoma</option>
          <option value="Busia">Busia</option>
          <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
          <option value="Embu">Embu</option>
          <option value="Garissa">Garissa</option>
          <option value="Homa Bay">Homa Bay</option>
          <option value="Isiolo">Isiolo</option>
          <option value="Kajiado">Kajiado</option>
          <option value="Kakamega">Kakamega</option>
          <option value="Kericho">Kericho</option>
          <option value="Kiambu">Kiambu</option>
          <option value="Kilifi">Kilifi</option>
          <option value="Kirinyanga">Kirinyanga</option>
          <option value="Kisii">Kisii</option>
          <option value="Kisumu">Kisumu</option>
          <option value="Kitui">Kitui</option>
          <option value="Kwale">Kwale</option>
          <option value="Laikipia">Laikipia</option>
          <option value="Lamu">Lamu</option>
          <option value="Machakos">Machakos</option>
          <option value="Makueni">Makueni</option>
          <option value="Mandera">Mandera</option>
          <option value="Meru">Meru</option>
          <option value="Migori">Migori</option>
          <option value="Marsabit">Marsabit</option>
          <option value="Mombasa">Mombasa</option>
          <option value="Muranga">Muranga</option>
          <option value="Nairobi">Nairobi</option>
          <option value="Nakuru">Nakuru</option>
          <option value="Nandi">Nandi</option>
          <option value="Narok">Narok</option>
          <option value="Nyamira">Nyamira</option>
          <option value="Nyandarua">Nyandarua</option>
          <option value="Nyeri">Nyeri</option>
          <option value="Samburu">Samburu</option>
          <option value="Siaya">Siaya</option>
          <option value="Taita Taveta">Taita Taveta</option>
          <option value="Tana River">Tana River</option>
          <option value="Tharaka Nithi">Tharaka Nithi</option>
          <option value="Trans Nzoia">Trans Nzoia</option>
          <option value="Turkana">Turkana</option>
          <option value="Uasin Gishu">Uasin Gishu</option>
          <option value="Vihiga">Vihiga</option>
          <option value="Wajir">Wajir</option>
          <option value="West Pokot">West Pokot</option>
        </select>
       </div>
      </div>
      

      <div clas="row">
       <div class="col-35">
        <label for="category">Category :</label>
       </div>
       <div class="col-65">
        <select name="category" id="category" required style="background-color: white;">
          <option value disabled selected>Select Category</option>
          <option value="Premier National School">Premier National School</option>
          <option value="Standard National School">Standard National School</option>
          <option value="Extra County School">Extra County School</option>
          <option value="County School">County School</option>
          <option value="Sub County School">Sub County School</option>
        </select>
       </div>
      </div>
      

      <div class="row">
        <div class="col-35">
         <label for="boardingstatus ">Boarding Status :</label>
        </div>
        <div class="col-65">
        <select name='boardingstatus' id='boardingstatus' required style="background-color: white">
         <option value disabled selected>Select Boarding Status </option>
         <option value="Boarding School">Boarding School</option>
         <option value="Day School">Day School</option>
       </select>
        </div>
      </div>

      <div class="row">
       <div class="col-35">
        <label for="gender">Gender :</label>
       </div>
       <div class="col-65">
        <select name='gender'id='gender' required style="background-color: white">
         <option value disabled selected>Gender of School</option>
         <option value="Girls School">Girls School </option>
         <option value="Boys School">Boys School</option>
         <option value="Mixed School">Mixed School</option>
       </select>
       </div>
      </div>

      <div class="row">
       <div class="col-35">
        <label for="capacity">Capacity :</label>
       </div>
       <div class="col-65">
        <input type="text" name="capacity" id="capacity" required>
       </div>
      </div>
      
      <div class="row">
        <button type="submit" id="Create School" value="Create School" style="height: 50px; width:100px" >Create School</button>
      </div>
      
      
    </form>
    </div>
  </div>
@endsection