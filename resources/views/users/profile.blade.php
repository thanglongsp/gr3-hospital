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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body> 
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
                            <td>xxx<td>
                        </tr> 
                        <tr>
                            <th>Gender </th>
                            <td>xxx<td>
                        </tr>
                        <tr>
                            <th>Phone number </th>
                            <td>xxx<td>
                        </tr>
                        <tr>
                            <th>Birth day </th>
                            <td>xxx<td>
                        </tr>
                        <tr>
                            <th>Email </th>
                            <td>xxx<td>
                        </tr>
                    </table>

                    <p> <a href="#" style="margin-left:90%; color: blue;"><u>Cập nhật</u></a>
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