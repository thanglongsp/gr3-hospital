<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hospital</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body> 
@include('layouts.header')
@include('layouts.background')
<div class="container">
    <div class="fb-profile">
        <img align="left" class="fb-image-profile" src="../images/long.jpg"/>
        <!-- <div class="fb-profile-text">
            <h1>Thanglongsp</h1>
        </div> -->
    </div>
</div> <!-- /container -->  

<div class="container">
    <div class="row mt-12">
        <div class="col-sm-4">
            <div class=" w3-bar-block w3-light-grey w3-card" style="width:200px; margin-left:-100px; height:300px;">
                <h5 class="w3-bar-item" style="text-align: center; color: green;">Thanglongsp <span class="glyphicon glyphicon-refresh"></span></h5>
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Thông tin cá nhân')">Thông tin cá nhân</button>
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Hồ sơ bệnh án')">Hồ sơ bệnh án</button>
            </div>
        </div>
        <div class="col-sm-8">
            <div style="margin-left:-200px">
                <div id="Thông tin cá nhân" class="w3-container city" style="display:none">
                    <table style="width:100%">
                        <tr>
                            <th>Name </th>
                            <td>{{ Auth::user()->name }}<td>
                        </tr> 
                        <tr>
                            <th>Gender </th>
                            @if( Auth::user()->gender == 1 )
                            <td>Nam<td>
                            @else
                            <td>Nữ<td>
                            @endif

                        </tr>
                        <tr>
                            <th>Phone number </th>
                            <td>{{ Auth::user()->phone_number }}<td>
                        </tr>
                        <tr>
                            <th>Birth day </th>
                            <td>{{ Auth::user()->birth_day }}<td>
                        </tr>
                        <tr>
                            <th>Email </th>
                            <td>{{ Auth::user()->email }}<td>
                        </tr>
                    </table>

                    <p> <a href="#" style="margin-left:90%; color: blue;" data-toggle="modal" data-target="#myModalProfile"><u>Cập nhật</u></a>
                    <!-- Modal -->
                        <div class="modal fade" id="myModalProfile" role="dialog">
                            <div class="modal-dialog">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Cập nhật thông tin cá nhân </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <form method="post" action="#" enctype="multipart/form-data">
                                            @csrf
                                            <input name="_method" type="hidden" value="PUT">     
                                            <div class="row mt-5">
                                                <div class="col-sm-9">
                                                    <div class="form-group row"> 
                                                        <label for="inputName" class="col-sm-2 col-form-label">Name :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="inputName" placeholder="Họ tên" value="{{ Auth::user()->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" name="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="birthday" class="col-sm-2 col-form-label">Birth day :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="birthday" name="birthday" value="{{ date('m/d/Y', strtotime(Auth::user()->birthday)) }}"><!--validate cho trường này do đổi type-->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"> 
                                                        <label for="inputGender" class="col-sm-2 col-form-label">Gender :</label>
                                                        <div class="col-sm-10">
                                                            @if(Auth::user()->gender == 1)
                                                            <div class="form-inline">
                                                                <input class="form-control" type="radio" name ="inputGender" value="1" checked>Male</input><br>
                                                                <input class="form-control" type="radio" name ="inputGender" value="2">Female</input>
                                                            </div>
                                                            @endif
                                                            @if(Auth::user()->gender == 2)
                                                            <div class="form-inline">
                                                                <input class="form-control" type="radio" name ="inputGender" value="1"> Male</input><br>
                                                                <input class="form-control" type="radio" name ="inputGender" value="2" checked> Female</input>
                                                            </div>
                                                            @endif 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="phone-number" class="col-sm-2 col-form-label">Phone number :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="phone_number" placeholder="phone number" value="{{ Auth::user()->phone_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password :</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" name="inputPassword" placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-sm-2 col-form-label">Confirm password :</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" name="inputPassword_confirmation" placeholder="Re-enter password">
                                                        </div>
                                                    </div>
                                                    <br> 
                                                    <div class="form-group row">
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-primary">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                            </div>
                        </div
                    <!-- end modal -->
                </div>
                <div id="Hồ sơ bệnh án" class="w3-container city" style="display:none">
                    <div class="ex1">
                        <h2>Ngày xxx</h2>
                        <p>~~~</p> 
                        <p>abc xyz.</p>
                        <p> <a href="#" style="margin-left:90%; color: blue;"><u>chi tiết</u></a>

                        <h2>Ngày xxx</h2>
                        <p>~~~</p> 
                        <p>abc xyz.</p>
                        <p> <a href="#" style="margin-left:90%; color: blue;">chi tiết</a>

                        <h2>Ngày xxx</h2>
                        <p>~~~</p> 
                        <p>abc xyz.</p>
                        <p> <a href="#" style="margin-left:90%; color: blue;">chi tiết</a>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

</body>
</html>

<script>
    function openCity(evt, cityName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); 
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " w3-red";
    }
</script>