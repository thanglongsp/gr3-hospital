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
    <script src="{{asset('js/app.js')}}"></script>
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
        @if(Auth::user()->avatar != NULL)
            <img  align="left" class="fb-image-profile" style="width:200px;" id="img_avatar" class="card-img-top" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Card image cap" style="padding: 6px">
            @else
                @if(Auth::user()->gender == 1)
                    <img  align="left" class="fb-image-profile" style="width:200px;" id="img_avatar" class="card-img-top" src="/images/avatars/user_man.png" alt="Card image cap" style="padding: 6px">
                @else
                    <img  align="left" class="fb-image-profile" style="width:200px;" id="img_avatar" class="card-img-top" src="/images/avatars/user_girl.png" alt="Card image cap" style="padding: 6px">
                @endif
        @endif
        <!-- <div class="fb-profile-text">
            <h1>Thanglongsp</h1>
        </div> -->
    </div>
</div> <!-- /container -->  

<div class="container">
    <div class="row mt-12">
        <div class="col-sm-4">
            <div class=" w3-bar-block w3-light-grey w3-card" style="width:200px; margin-left:-100px; height:300px;">
                <h5 class="w3-bar-item" style="text-align: center; color: green;"> {{ Auth::user()->name }} <a href="#" data-toggle="modal" data-target="#myModalPicture"><span class="glyphicon glyphicon-picture"></a></span></h5>
                <!-- Modal -->
                <div class="modal fade" id="myModalPicture" role="dialog">
                            <div class="modal-dialog">
                            
                            <!-- Modal content-->
                            <div class="modal-content"> 
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Cập nhật ảnh đại diện </h4>
                                </div>
                                <div class="modal-body">
                                <div class="card">
                                <form method="post" action="{{route('users.update_picture', Auth::user()->id)}}" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="new_name" id="new_name" value="{{Auth::user()->avatar}}">
                                    @if(Auth::user()->avatar != NULL)
                                    <img  style="width:200px;" id="img_avatar" class="card-img-top" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Card image cap" style="padding: 6px">
                                    @else
                                        @if(Auth::user()->gender == 1)
                                        <img  style="width:200px;" id="img_avatar" class="card-img-top" src="/images/avatars/user_man.png" alt="Card image cap" style="padding: 6px">
                                        @else
                                        <img  style="width:200px;" id="img_avatar" class="card-img-top" src="/images/avatars/user_girl.png" alt="Card image cap" style="padding: 6px">
                                        @endif
                                    @endif
                                    <div class="card-body">
                                        <input accept="image/*" name="avatar" title="Đổi ảnh đại diện" type="file" id="avatar"  onchange="reupAvatar()">
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div
                    <!-- end modal -->
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Thông tin cá nhân')">Thông tin cá nhân</button>
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Yêu cầu khám bệnh')">Yêu cầu khám bệnh</button>                
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Trạng thái các khoa')">Trạng thái các khoa</button>                
                @if(Auth::user()->role != 'A' && Auth::user()->role != 'B')
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Hồ sơ bệnh án')">Hồ sơ bệnh án</button>
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Đặt lịch khám')">Đặt lịch khám</button>
                @endif
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Bài viết yêu thích')">Bài viết yêu thích</button>
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Bài viết của tôi')">Bài viết của tôi</button>
            </div>
        </div>
        <div class="col-sm-8">
            <div style="margin-left:-200px">
                <div id="Thông tin cá nhân" class="w3-container city" style="display:none">
                    <table style="width:100%; margin-top: 0px;">
                        <tr>
                            <th style="height: 40px;">Biệt danh  </th>
                            <td>{{ Auth::user()->name }}<td>
                        </tr> 
                        <tr>
                            <th style="height: 40px;">Họ tên đầy đủ  </th>
                            <td>{{ Auth::user()->full_name }}<td>
                        </tr>
                        <tr>
                            <th style="height: 40px;">Ngày sinh  </th>
                            <td>{{ Auth::user()->birth_day }}<td>
                        </tr> 
                        <tr>
                            <th style="height: 40px;">Địa chỉ hiện tại  </th>
                            <td>{{ Auth::user()->address }}<td>
                        </tr> 
                        <tr>
                            <th style="height: 40px;">Công việc  </th>
                            <td>{{ Auth::user()->work }}<td>
                        </tr> 
                        <tr>
                            <th style="height: 40px;">Giới tính  </th>
                            @if( Auth::user()->gender == 1 )
                            <td>Nam<td>
                            @else
                            <td>Nữ<td>
                            @endif
                        </tr>
                        <tr>
                            <th style="height: 40px;">Số điện thoại  </th>
                            <td>{{ Auth::user()->phone_number }}<td>
                        </tr>
                        <tr>
                            <th style="height: 40px;">Email </th>
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
                                        <form method="post" action="{{ route('users.update_profile', Auth::user()->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            <input name="_method" type="hidden" value="post">     
                                            <div class="row mt-5">
                                                <div class="col-sm-9">
                                                    <div class="form-group row"> 
                                                        <label for="inputName" class="col-sm-2 col-form-label">Name :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="inputName" placeholder="Biệt danh" value="{{ Auth::user()->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"> 
                                                        <label for="full_name" class="col-sm-2 col-form-label">Full Name :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="full_name" placeholder="Họ tên" value="{{ Auth::user()->full_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"> 
                                                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="{{ Auth::user()->address }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"> 
                                                        <label for="work" class="col-sm-2 col-form-label">Công việc :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="work" value="{{ Auth::user()->work }}">
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
                                                        <label for="new_password" class="col-sm-2 col-form-label">New password :</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" name="new_password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="cof_new_password" class="col-sm-2 col-form-label">Confirm new-password :</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" name="cof_new_password">
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
                @if(Auth::user()->role != 'A' && Auth::user()->role != 'B')
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
                <div id="Đặt lịch khám" class="w3-container city" style="display:none">
                    <div class="ex1">
                            <table style="width: 100%;">
                                <tr style="height: 30px;">
                                    <th>Bệnh viện</th>
                                    <th>Ngày đặt</th>
                                    <th>Giờ đặt</th>
                                    <th>Khoa</th>
                                    <th>Chuyên môn</th>
                                    <th>Cách thức</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                @if($requests_a != '')
                                    @foreach($requests_a->sortBy('ngay_thu') as $req)
                                    <tr style="height: 30px;">
                                        <td>Bệnh viện A</td>
                                        <td>{{ $req->ngay_thu }}</td>
                                        <td>{{ $req->thoi_gian }}</td>
                                        <td>{{ $req->ten_khoa }}</td>
                                        <td>{{ $req->ten_chuyen_mon }}</td>
                                        <td>{{ $req->cach_thuc }}</td>
                                        <td>Đã đặt </td>
                                        <td><button style="background-color: Transparent;border: none;color:red;" name="A" id="{{ $req->ma_request }}" onclick="cancelDatlich(this.id, this.name)">Hủy lịch</button> </td>
                                    </tr>
                                    @endforeach   
                                @endif
                                @if($requests_b != '')
                                    @foreach($requests_b->sortBy('ngay_thu') as $req)
                                    <tr style="height: 30px;">
                                        <td>Bệnh viện B</td>
                                        <td>{{ $req->ngay_thu }}</td>
                                        <td>{{ $req->thoi_gian }}</td>
                                        <td>{{ $req->ten_khoa }}</td>
                                        <td>{{ $req->ten_chuyen_mon }}</td>
                                        <td>{{ $req->cach_thuc }}</td>
                                        <td>Đã đặt </td>
                                        <td><button style="background-color: Transparent;border: none; color:red;" name="B" id="{{ $req->ma_request }}" onclick="cancelDatlich(this.id, this.name)">Hủy lịch</button> </td>                                                                                
                                    </tr>
                                    @endforeach   
                                @endif                              
                            </table>
                    <br>
                    
                    </div>
                </div>
                @endif
                <!-- Hiển thị yêu cầu khám -->
                @if(Auth::user()->role == 'A')
                <div id="Yêu cầu khám bệnh" class="w3-container city" style="display:none">
                <center><input type="text" id="myInputA" onkeyup="myFunctionA()" placeholder="Tìm kiếm với chuyên môn" style="width: 200px;"></center>
                <br>
                    <div class="ex1">
                    <table style="width: 100%;" id="myTableA">
                                <tr style="height: 30px;">
                                    <th>Tên người dùng </th>
                                    <th>Ngày đặt</th>
                                    <th>Giờ đặt</th>
                                    <th>Khoa</th>
                                    <th>Chuyên môn</th>
                                    <th>Cách thức</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                @if($requests_a_all != '')
                                    @foreach($requests_a_all->sortBy('ngay_thu') as $req)
                                    <tr style="height: 30px;">
                                        @foreach($users as $user)
                                        @if($user->id == $req->user_id)
                                        <td> <a href="{{ route('users.profile', $user->id) }}">{{ $user->full_name }} </a> </td>
                                        @endif
                                        @endforeach
                                        <td>{{ $req->ngay_thu }}</td>
                                        <td>{{ $req->thoi_gian }}</td>
                                        <td>{{ $req->ten_khoa }}</td>
                                        <td>{{ $req->ten_chuyen_mon }}</td>
                                        <td>{{ $req->cach_thuc }}</td>
                                        <td>Đã đặt </td>
                                        <td><button style="background-color: Transparent;border: none;color:red;" name="A" id="{{ $req->ma_request }}" onclick="cancelDatlich(this.id, this.name)">Hủy lịch</button> </td>
                                    </tr>
                                    @endforeach   
                                @endif
                    </table>
                    </div>
                </div>
                @endif
                @if(Auth::user()->role == 'B')
                <div id="Yêu cầu khám bệnh" class="w3-container city" style="display:none">
                <center><input type="text" id="myInputB" onkeyup="myFunctionB()" placeholder="Tìm kiếm với chuyên môn" style="width: 200px;"></center>
                <br>
                    <div class="ex1">
                    <table style="width: 100%;" id="myTableB">
                                <tr style="height: 30px;">
                                    <th>Tên người dùng </th>
                                    <th>Ngày đặt</th>
                                    <th>Giờ đặt</th>
                                    <th>Khoa</th>
                                    <th>Chuyên môn</th>
                                    <th>Cách thức</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                @if($requests_b_all != '')
                                    @foreach($requests_b_all->sortBy('ngay_thu') as $req)
                                    <tr style="height: 30px;">
                                        @foreach($users as $user)
                                        @if($user->id == $req->user_id)
                                        <td> <a href="{{ route('users.profile', $user->id) }}">{{ $user->full_name }} </a> </td>
                                        @endif
                                        @endforeach
                                        <td>{{ $req->ngay_thu }}</td>
                                        <td>{{ $req->thoi_gian }}</td>
                                        <td>{{ $req->ten_khoa }}</td>
                                        <td>{{ $req->ten_chuyen_mon }}</td>
                                        <td>{{ $req->cach_thuc }}</td>
                                        <td>Đã đặt </td>
                                        <td><button style="background-color: Transparent;border: none;color:red;" name="A" id="{{ $req->ma_request }}" onclick="cancelDatlich(this.id, this.name)">Hủy lịch</button> </td>
                                    </tr>
                                    @endforeach   
                                @endif
                    </table>
                    </div>
                </div>
                @endif
                <!-- end hiển thị Yêu cầu khám -->
                <div id="Trạng thái các khoa" class="w3-container city" style="display:none">
                
                </div>
                <!-- display favarite post -->
                <div id="Bài viết yêu thích" class="w3-container city" style="display:none">
                    <div class="ex1">
                    <br>
                    @foreach($likes->sortByDESC('created_at') as $like)
                        <table style="width: 100%;">
                        <tr style="height: 30px;">
                            <th>Tiêu đề </th>
                            <td>{{ $like->post['title'] }}</td>
                        </tr>
                        <tr style="height: 30px;">
                            <th>Thời gian</th>
                            <td>{{ $like->post['created_at'] }}</td>
                        </tr>
                        <tr style="height: 30px;"> 
                            <th>Người đăng</th>
                            <td>{{ $like->post->user['name']}}</td>
                        </tr>
                        <tr style="height: 30px;">
                            <th><a href="#" style="color: blue;"><u>chi tiết</u></a></th>  
                            <td></td>
                        </tr>
                        </table>
                        <br>
                    @endforeach
                    </div>
                </div>
                <!-- End display favarite post -->

                <!-- display favarite post -->
                <div id="Bài viết của tôi" class="w3-container city" style="display:none">
                    <div class="ex1">
                    @foreach($posts->sortBy('created_at') as $post)
                        <h2>Tiêu đề : {{ $post->title }}</h2>
                        <p>Thời gian : {{ $post->created_at }}</p> 
                        <p> <a href="#" style="margin-left:90%; color: blue;"><u>chi tiết</u></a>
                    @endforeach
                    </div>
                </div>
                <!-- End display favarite post -->

            </div>    
        </div>
    </div>
</div>

</body>
</html>

<script>
function cancelDatlich(clicked_id, clicked_name){
        if(confirm("Bạn đã chắc chắn hủy ?")){
            var url = "{{route('users.cancelDatlich')}}";
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token"        : '{{csrf_token()}}',
                    "benh_vien"        : clicked_name,
                    "ma_request"       : clicked_id,
                },
                success: function(data) {
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                    alert('error!');
                },
            });
        }
}
</script>
<script>
function myFunctionA() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputA");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableA");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script>
function myFunctionB() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputB");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableB");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>