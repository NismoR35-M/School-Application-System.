<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <script src="https://kit.fontawesome.com/883e95204a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>KHPS</title>
</head>
<body class="body">
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line menu"></i>
            <h2><span>HS |</span> The Placement Service</h2>
        </div>
        <div class="header--items">
            <i class="ri-search-2-line"></i>
            <div class="dark--theme--btn">
                <i class="ri-moon-line moon"></i>
                <i class="ri-sun-line sun"></i>
            </div>
            <i class="ri-notification-2-line"></i>
            <i class="ri-wechat-2-line chat"></i>
            <!-- <form action="{{ route('admin.uploadImage') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile">
                    <input type="file" name="profile_image" accept="image/*">
                    <img src="{{ asset('assets/images/profile.jpg') }}" alt="">
                </div>
                <button type="submit">Upload</button>
            </form> -->

        </div>
    </section>
    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <!-- Admin dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="">
                        <span class="icon"><i class="fa-solid fa-gauge"></i></span>
                        <div class="sidebar--item">Dashboard</div>
                    </a>
                </li>
                <li>
                    <!-- drawer for school selection -->
                    <a href="{{ route('admin.schools') }}">
                        <span class="icon"><i class="fa-solid fa-school"></i></span>
                        <div class="sidebar--item">Schools</div>
                    </a>
                </li>
                <li>
                    <!-- drawer for school selection -->
                    <a href="{{ route('admin.schoolSelection') }}">
                        <span class="icon"><i class="fa-solid fa-school"></i></span>
                        <div class="sidebar--item">Schools Sellections</div>
                    </a>
                </li>
                <li>
                    <!-- drawer for students -->
                    <a href="{{ route('admin.students') }}">
                        <span class="icon"><i class="fa-solid fa-people-group"></i></span>
                        <div class="sidebar--item">Students</div>
                    </a>
                </li>
                <li>
                    <!-- admins drawer -->
                    <a href="{{ route('admin.admins')}}">
                        <span class="icon"><i class="fa-solid fa-crown"></i></span>
                        <div class="sidebar--item">Admins</div>
                    </a>
                </li>
                <li>
                    <!-- drawer for admin-profile -->
                    <a href="{{ route('admin.admin_profile')}}">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <div class="sidebar--item">Profile</div>
                    </a>
                </li>
                <li>
            </ul>
            <ul class="sidebar--bottom--items">
                <li>
                    <a href="#">
                        <span class="icon"><i class="ri-question-line"></i></span>
                        <div class="sidebar--item">Help</div>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action ="{{ route('admin.logout') }}" method="POST">
                        @csrf
                    </form>
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="main--container">
            <div class="section--title">
                
                <h3 class="title">Welcome back</h3>
                
                <select name="date" id="date">
                    <option value="last7">Last 7 days</option>
                    <option value="lastmonth">Last month</option>
                    <option value="lastyear">Last year</option>
                    <option value="alltime">All time</option>
                </select>
            </div>     
       <!-- content area starts -->
       @yield('content')
       <!-- content area stop -->
       </div>

    </section>
       <script src="{{asset('/js/main.js')}}"></script>
       <script src="assets/js/sales.js"></script>
       <script src="assets/js/orders.js"></script>
       <script src="assets/js/products.js"></script>
       <script src="assets/js/customers.js"></script>
       <script src="assets/js/tarsale.js"></script>

       <script>
        $(".sidebar ul li").on('click', function() {
                $(".sidebar ul li.active").removeClass('active');
                $(this).addClass('active');
            });
       </script>
</body>
</html>