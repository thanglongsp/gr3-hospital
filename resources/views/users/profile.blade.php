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
                <div class="tab">
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Thông tin cá nhân')">Thông tin cá nhân</button>   
                    @if(Auth::user()->role == 'A' || Auth::user()->role == 'B')
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Yêu cầu khám bệnh')">Yêu cầu khám bệnh</button>                
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Trạng thái các khoa')">Trạng thái các khoa</button>                
                    @endif
                    @if(Auth::user()->role != 'A' && Auth::user()->role != 'B')              
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Hồ sơ bệnh án')">Hồ sơ bệnh án</button>
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Đặt lịch khám')">Đặt lịch khám</button>
                    @endif
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Bài viết yêu thích')">Bài viết yêu thích</button>
                    <button style="width: 200px;" class="tablinks" onclick="openCity(event, 'Bài viết của tôi')">Bài viết của tôi</button>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div style="margin-left:-200px">

                <!-- Hien thi thong tin ca nhan -->
                <div id="Thông tin cá nhân" class="tabcontent" style="display:none">
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
                                                            <input type="text" class="form-control" id="birthday" name="birthday" value="{{ date('m/d/Y', strtotime(Auth::user()->birth_day)) }}"><!--validate cho trường này do đổi type-->
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
                <!-- Ket thuc hien thi thong tin ca nhan -->

                <!-- Hien thi ho so benh an -->
                <div id="Hồ sơ bệnh án" class="tabcontent" style="display:none">
                    <div class="ex1">
                        <h2>Ngày xxx</h2>
                        <p>~~~</p> 
                        <p>abc xyz.</p>
                        <p> <a href="#" style="margin-left:90%; color: blue;" data-toggle="modal" data-target="#noikhoa">Nội khoa</a>
                        <p> <a href="#" style="margin-left:90%; color: blue;" data-toggle="modal" data-target="#nhikhoa">Nhi khoa</a>
                        <p> <a href="#" style="margin-left:90%; color: blue;" data-toggle="modal" data-target="#nhankhoa">Nhãn khoa</a>
                    <!-- Modal bệnh án nội khoa -->
                    <div class="modal fade" id="noikhoa" role="dialog" style="margin-left: -350px;">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bệnh án nội khoa</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="col-sm-12">                    
                                        <table style="width: 100%;">
                                        <tr>
                                            <td >
                                            <p>Sở y tế :</p> 
                                            <p>Bệnh viện :</p> 
                                            <p>Khoa :</p> 
                                            <p>Giường :</p> 
                                            </td>
                                            <td>Bệnh án nội khoa</td>
                                            <td>
                                            <p>Số lưu trữ : </p>
                                            <p>Mã YT : </p>
                                            </td>
                                        </tr>
                                        </table>
                                        <h3>I. HÀNH CHÍNH</h3>
                                            <p>1. Họ và tên <i>(In hoa)</i></p>
                                            <p>2. Ngày sinh      Tuổi   </p>
                                            <p>3. Giới tính :  </p>
                                            <p>4. Nghề nghiệp : </p>
                                            <p>5. Dân tộc : </p>
                                            <p>6. Ngoại kiều : </p>
                                            <p>7. Địa chỉ : </p>
                                            <p>8. Nơi làm việc : </p>
                                            <p>9. Đối tượng : </p>
                                            <p>10. BHYT giá trị đến ngày ... tháng ... năm ...  : </p>
                                            <p>11. Họ tên địa chỉ người nhà khi cần báo tin : ... số điện thoại </p>
                                        <h3>II. QUẢN LÝ NGƯỜI BỆNH</h3>
                                            <p>12. Vào viện : giờ ... phút ... ngày ... </p>
                                            <p>13. Trực tiếp vào : </p>
                                            <p>14. Nơi giới thiệu : ... Vào viện do bệnh này lần thứ ... </p>
                                            <p>15. Vào khoa : ... giờ ... phút ... ngày ... </p>
                                            <p>16. Chuyển khoa : ... giờ ... phút ... ngày ... </p>
                                            <p>17. Chuyển viện : </p>
                                            <p>18. Ra viện : ... ngày ... giờ ... phút ... lý do ...</p>
                                            <p>19. Tổng số ngày điều trị : ... </p>
                                        <h3>III. CHẨN ĐOÁN</h3>                                        
                                            <p>20. Nơi chuyển đến : ...</p>
                                            <p>21. KKB, Cấp cứu : ... </p>
                                            <p>22. Khi vào khoa điều trị : </p>
                                            <p>+ Thủ thuật : ... </p>
                                            <p>+ Phẫu thuật : ... </p>
                                            <p>23. Ra viện : </p>
                                            <p>+ Bệnh chính : ...</p>
                                            <p>+ Bệnh kèm theo : ...</p>
                                            <p>+ Tai biến : ...</p>
                                            <p>+ Biến chứng : ...</p>
                                        <h3>IV. TÌNH TRẠNG RA VIỆN</h3>
                                            <p>24. Kết quả điều trị</p>
                                            <p><i>1. Khỏi : ...</i></p>
                                            <p><i>2. Đỡ, giảm : ...</i></p>
                                            <p><i>3. Không thay đổi : ...</i></p>
                                            <p><i>4. Nặng hơn : ... </i></p>
                                            <p><i>5. Tử vong : ... </i></p>
                                            <p>25. Giải phẫu bệnh <i>khi có sinh thiết</i></p>
                                            <p><i>1. Lành tính : ... </i></p>
                                            <p><i>2. Nghi ngờ : ... </i></p>
                                            <p><i>3. Ác tính : ... </i></p>
                                            <p>26. Tình hình tử vong : ... giờ ... phút ... ngày ... tháng ... năm</p>
                                            <p><i>1. Do bệnh : ...</i></p>
                                            <p><i>2. Do tái biến điều trị : ...</i></p>
                                            <p><i>3. Trong 24 giờ vào viện : ...</i></p>
                                            <p><i>4. Sau 24 giờ vào viện : ...</i></p>
                                            <p><i>5. Khác : ... </i></p>
                                            <p>27. Nguyên nhân chính tử vong : ... </p>
                                            <p>28. Khám nghiệm tử thi : ...</p>
                                            <p>29. Chẩn đoán giải phẫu tử thi : ... </p>
                                        <table style="width: 100%;">
                                        <tr>
                                            <td >
                                                <h3> Giám đốc bệnh viện</h3> 
                                                <p>Họ và tên : ... </p>
                                            </td>
                                            <td>
                                                <h3>Trưởng khoa</h3>
                                                <p>Họ và tên : ...</p>
                                            </td>
                                        </tr>
                                        </table>
                                        <h3>A-BỆNH ÁN</h3>
                                        <h3>I. Lý do vào viện : ... Vào ngày thứ ... của bệnh.</h3>
                                        <h3>II. Hỏi bệnh</h3>
                                        <p>1. Quá trình bệnh lý : <i>(khởi phát, diễn biến, chẩn đoán, điều trị của tuyến dưới ...)</i>.</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>2. Tiền sử bệnh : </p>
                                        <p>+ Bản thân : </i>(phát triển thể lực từ nhỏ đến lớn, những bệnh đã mắc, phương pháp điều trị, tiêm phòng, ăn uống, sinh hoạt v.v ...)</i></p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <P>Đặc điểm liên quan bệnh</p>
                                        <table style="width: 100%;"> 
                                        <tr>
                                            <td>TT</td>
                                            <td>Ký hiệu</td>
                                            <td>Thời gian (tính theo tháng)</td>
                                            <td>TT</td>
                                            <td>Ký hiệu</td>
                                            <td>thời gian (tính theo tháng)</td>
                                        </tr>
                                        <tr>
                                            <td>01</td>
                                            <td>- Dị ứng ...</td>
                                            <td>(dị nguyên)</td>
                                            <td>04</td>
                                            <td>- Thuốc lá ... </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>- Ma túy ...</td>
                                            <td></td>
                                            <td>05</td>
                                            <td>- Thuốc lào ... </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>- Rượu bia ...</td>
                                            <td></td>
                                            <td>06</td>
                                            <td>- Khác ... </td>
                                            <td></td>
                                        </tr>
                                        </table>      
                                        <p>+ Gia đình :<i>(Những người trong gia đình : bệnh đã mắc, đời sống, tinh thần, vật chất, v.v...)</i></p>                                 
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <h3>III-Khám bệnh</h3>
                                        <p>1. Toàn thân : (ý thức, da niêm mạc, hệ thống hạch, tuyến giáp, vị trí, kích thước, số lượng, di động v.v ...)</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Mạch ...... lần/phút</p>
                                        <p>Nhiệt độ .... độ C</p>
                                        <p>Hyết áp .... / .... </p>
                                        <p>mmHg .... </p>
                                        <p>Nhịp thở .... </p>
                                        <p>2. Cơ quan</p>
                                        <p>Tuần hoàn :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Hô hấp :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Tiêu hóa :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Thận - Tiết niệu - Sinh dục :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Thần kinh :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Cơ - Xương - Khớp :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Tai - Mũi - Họng :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Răng - Hàm - Mặt :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Mắt :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Nội tiết, dinh dưỡng, các bệnh lý khác :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p><strong>3. Các xét nghiệm cận lâm sàng cần làm : </strong></p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p><strong>4. Tóm tắt bệnh án : </strong></p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <h3>IV. Chẩn đoán khi vào khoa điều trị :</h3>
                                        <p>+ Bệnh chính : ... </p>
                                        <p>+ Bệnh kèm theo (nếu có) : ... </p>
                                        <p>+ Phân biệt : ... </p>
                                        <h3>V. Tiên lượng </h3>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <h3>VI. Hướng điều trị</h3>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p style="margin-left: 500px;">Ngày ... tháng ... năm ... </p>
                                        <p style="margin-left: 500px;">Bác sỹ làm bệnh án</p>
                                        <p style="margin-left: 500px;">Họ và tên ....</p>
                                        <h3>B. TỔNG KẾT BỆNH ÁN</h3>
                                        <p>1. Quá trình bệnh lý và diễn biến lâm sàng :</p> 
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>2. Tóm tắt kết quả xét nghiệm cận lâm sàng có giá trị chẩn đoán : </p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>3. Phương pháp điều trị</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>4. Tình trạng người bệnh ra viện</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>5. Hướng điều trị và các chế độ tiếp theo</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td colspan="2"> Hồ sơ, phim, ảnh</td>
                                                <td> Người giao hồ sơ</td>
                                                <td> Ngày ... tháng ... năm ... </td>
                                            </tr>
                                            <tr>
                                                <td>Loại</td>
                                                <td>Số tờ</td>
                                                <td></td>
                                                <td>Bác sỹ điều trị</td>
                                            </tr>
                                            <tr>
                                                <td>- X - quang</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- CT Scanner</td>
                                                <td></td>
                                                <td>Họ tên : ...</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Siêu âm</td>
                                                <td></td>
                                                <td>Người nhận hồ sơ</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Xét nghiệm</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Khác ...</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Toàn bộ hồ sơ</td>
                                                <td></td>
                                                <td>Họ tên ... </td>
                                                <td>Họ tên ... </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <!-- Modal bệnh án nhi khoa -->
                    <div class="modal fade" id="nhikhoa" role="dialog" style="margin-left: -350px;">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bệnh án nhi khoa</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="col-sm-12">                    
                                        <table style="width: 100%;">
                                        <tr>
                                            <td >
                                            <p>Sở y tế :</p> 
                                            <p>Bệnh viện :</p> 
                                            <p>Khoa :</p> 
                                            <p>Giường :</p> 
                                            </td>
                                            <td>Bệnh án nhi khoa</td>
                                            <td>
                                            <p>Số lưu trữ : </p>
                                            <p>Mã YT : </p>
                                            </td>
                                        </tr>
                                        </table>
                                        <h3>I. HÀNH CHÍNH</h3>
                                            <p>1. Họ và tên <i>(In hoa)</i></p>
                                            <p>2. Ngày sinh      Tuổi   </p>
                                            <p>3. Giới tính :  </p>
                                            <p>4. Dân tộc : </p>
                                            <p>5. Ngoại kiều : </p>
                                            <p>6. Địa chỉ : </p>
                                            <p>7. Họ tên bố ... Trình độ văn hóa của Bố ... Họ tên mẹ ... trình độ văn hóa của mẹ ... </p>
                                            <p>Nghề nghiệp của bố ... Nghề nghiệp của mẹ ... </p>
                                            <p>8. Đối tượng : 1. BHYT 2. Thu phí 3. Miễn 4.Khác</p>
                                            <p>9. BHYT giá trị đến ngày ... tháng ... năm ...  : </p>
                                            <p>10. Họ tên địa chỉ người nhà khi cần báo tin : ... số điện thoại </p>
                                        <h3>II. QUẢN LÝ NGƯỜI BỆNH</h3>
                                            <p>12. Vào viện : giờ ... phút ... ngày ... </p>
                                            <p>13. Trực tiếp vào : </p>
                                            <p>14. Nơi giới thiệu : ... Vào viện do bệnh này lần thứ ... </p>
                                            <p>15. Vào khoa : ... giờ ... phút ... ngày ... </p>
                                            <p>16. Chuyển khoa : ... giờ ... phút ... ngày ... </p>
                                            <p>17. Chuyển viện : </p>
                                            <p>18. Ra viện : ... ngày ... giờ ... phút ... lý do ...</p>
                                            <p>19. Tổng số ngày điều trị : ... </p>
                                        <h3>III. CHẨN ĐOÁN</h3>                                        
                                            <p>20. Nơi chuyển đến : ...</p>
                                            <p>21. KKB, Cấp cứu : ... </p>
                                            <p>22. Khi vào khoa điều trị : </p>
                                            <p>+ Thủ thuật : ... </p>
                                            <p>+ Phẫu thuật : ... </p>
                                            <p>23. Ra viện : </p>
                                            <p>+ Bệnh chính : ...</p>
                                            <p>+ Bệnh kèm theo : ...</p>
                                            <p>+ Tai biến : ...</p>
                                            <p>+ Biến chứng : ...</p>
                                        <h3>IV. TÌNH TRẠNG RA VIỆN</h3>
                                            <p>24. Kết quả điều trị</p>
                                            <p><i>1. Khỏi : ...</i></p>
                                            <p><i>2. Đỡ, giảm : ...</i></p>
                                            <p><i>3. Không thay đổi : ...</i></p>
                                            <p><i>4. Nặng hơn : ... </i></p>
                                            <p><i>5. Tử vong : ... </i></p>
                                            <p>25. Giải phẫu bệnh <i>khi có sinh thiết</i></p>
                                            <p><i>1. Lành tính : ... </i></p>
                                            <p><i>2. Nghi ngờ : ... </i></p>
                                            <p><i>3. Ác tính : ... </i></p>
                                            <p>26. Tình hình tử vong : ... giờ ... phút ... ngày ... tháng ... năm</p>
                                            <p><i>1. Do bệnh : ...</i></p>
                                            <p><i>2. Do tái biến điều trị : ...</i></p>
                                            <p><i>3. Trong 24 giờ vào viện : ...</i></p>
                                            <p><i>4. Sau 24 giờ vào viện : ...</i></p>
                                            <p><i>5. Khác : ... </i></p>
                                            <p>27. Nguyên nhân chính tử vong : ... </p>
                                            <p>28. Khám nghiệm tử thi : ...</p>
                                            <p>29. Chẩn đoán giải phẫu tử thi : ... </p>
                                        <table style="width: 100%;">
                                        <tr>
                                            <td >
                                                <h3> Giám đốc bệnh viện</h3> 
                                                <p>Họ và tên : ... </p>
                                            </td>
                                            <td>
                                                <h3>Trưởng khoa</h3>
                                                <p>Họ và tên : ...</p>
                                            </td>
                                        </tr>
                                        </table>
                                        <h3>A-BỆNH ÁN</h3>
                                        <h3>I. Lý do vào viện : ... Vào ngày thứ ... của bệnh.</h3>
                                        <h3>II. Hỏi bệnh</h3>
                                        <p>1. Quá trình bệnh lý : <i>(khởi phát, diễn biến, chẩn đoán, điều trị của tuyến dưới ...)</i>.</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>2. Tiền sử bệnh : </p>
                                        <p>+ Bản thân : </i>(phát triển thể lực từ nhỏ đến lớn, những bệnh đã mắc, phương pháp điều trị, tiêm phòng, ăn uống, sinh hoạt v.v ...)</i></p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>+ Gia đình</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <P>3. Quá trình sinh trưởng</p>
                                        <p>- Con thứ mấy .... - Tiền thai (Para) ... (sinh(đủ tháng), Sớm(đẻ non), Sẩy(nạo, hút), Sống)</p>
                                        <p>- Tình trạng khi sinh : 1.Đẻ thường ... 2.Forcerps ... 3.Giác hút ... 4.Đẻ phẫu thuật ... 5.Đẻ chỉ huy ... 6.Khác</p>
                                        <p>- Cân nặng lúc sinh : ... kg. Dị tật bẩm sinh : ... Cụ thể tật bẩm sinh : ......</p>
                                        <p>- Phát triển về tinh thần : ........... </p>
                                        <p>- Phát triển về vận động : ...... </p>
                                        <p>- Các bệnh lý khác : ....... </p>
                                        <p>- Nuôi dưỡng : 1.Sữa mẹ ... 2.Nuôi nhân tạo ... 3.Hỗn hợp ... </p>
                                        <p>- Cai sữa tháng thứ : ....</p>
                                        <p>- Chăm sóc : 1.Tại vườn trẻ ... 2.Tại nhà ...</p>
                                        <p>- Đã tiêm chủng : 1.Lao ... 2.Bại liệt ... 3.Sởi ... 4.Ho gà ... 5. Uốn ván ... 6.Bạch cầu ... 7.Tiêm chủng ... 8.Khác ...</p>
                                        <p>- Cụ thể những bệnh khác được tiêm chủng ... </p>
                                        <h3>III-Khám bệnh</h3>
                                        <p>1. Toàn thân : (ý thức, da niêm mạc, hệ thống hạch, tuyến giáp, vị trí, kích thước, số lượng, di động v.v ...)</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Mạch ...... lần/phút</p>
                                        <p>Nhiệt độ .... độ C</p>
                                        <p>Hyết áp .... / .... </p>
                                        <p>mmHg .... </p>
                                        <p>Nhịp thở .... </p>
                                        <p>2. Cơ quan</p>
                                        <p>Tuần hoàn :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Hô hấp :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Tiêu hóa :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Thận - Tiết niệu - Sinh dục :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Thần kinh :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Cơ - Xương - Khớp :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Tai - Mũi - Họng :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Răng - Hàm - Mặt :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Mắt :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>Nội tiết, dinh dưỡng, các bệnh lý khác :</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p><strong>3. Các xét nghiệm cận lâm sàng cần làm : </strong></p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p><strong>4. Tóm tắt bệnh án : </strong></p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <h3>IV. Chẩn đoán khi vào khoa điều trị :</h3>
                                        <p>+ Bệnh chính : ... </p>
                                        <p>+ Bệnh kèm theo (nếu có) : ... </p>
                                        <p>+ Phân biệt : ... </p>
                                        <h3>V. Tiên lượng </h3>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <h3>VI. Hướng điều trị</h3>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p style="margin-left: 500px;">Ngày ... tháng ... năm ... </p>
                                        <p style="margin-left: 500px;">Bác sỹ làm bệnh án</p>
                                        <p style="margin-left: 500px;">Họ và tên ....</p>
                                        <h3>B. TỔNG KẾT BỆNH ÁN</h3>
                                        <p>1. Quá trình bệnh lý và diễn biến lâm sàng :</p> 
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>2. Tóm tắt kết quả xét nghiệm cận lâm sàng có giá trị chẩn đoán : </p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>3. Phương pháp điều trị</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>4. Tình trạng người bệnh ra viện</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>5. Hướng điều trị và các chế độ tiếp theo</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td colspan="2"> Hồ sơ, phim, ảnh</td>
                                                <td> Người giao hồ sơ</td>
                                                <td> Ngày ... tháng ... năm ... </td>
                                            </tr>
                                            <tr>
                                                <td>Loại</td>
                                                <td>Số tờ</td>
                                                <td></td>
                                                <td>Bác sỹ điều trị</td>
                                            </tr>
                                            <tr>
                                                <td>- X - quang</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- CT Scanner</td>
                                                <td></td>
                                                <td>Họ tên : ...</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Siêu âm</td>
                                                <td></td>
                                                <td>Người nhận hồ sơ</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Xét nghiệm</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Khác ...</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>- Toàn bộ hồ sơ</td>
                                                <td></td>
                                                <td>Họ tên ... </td>
                                                <td>Họ tên ... </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <!-- Modal bệnh án nhãn khoa -->
                    <div class="modal fade" id="nhankhoa" role="dialog" style="margin-left: -350px;">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bệnh án nhãn khoa</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="col-sm-12">                    
                                        <table style="width: 100%;">
                                        <tr>
                                            <td >
                                            <p>Sở y tế :</p> 
                                            <p>Bệnh viện :</p> 
                                            <p>Khoa :</p> 
                                            <p>Giường :</p> 
                                            </td>
                                            <td>Bệnh án mắt</td>
                                            <td>
                                            <p>Số lưu trữ : </p>
                                            <p>Mã YT : </p>
                                            </td>
                                        </tr>
                                        </table>
                                        <h3>I. HÀNH CHÍNH</h3>
                                            <p>1. Họ và tên <i>(In hoa)</i></p>
                                            <p>2. Ngày sinh      Tuổi   </p>
                                            <p>3. Giới tính :  </p>
                                            <p>4. Nghề nghiệp : </p>
                                            <p>5. Dân tộc : </p>
                                            <p>6. Ngoại kiều : </p>
                                            <p>7. Địa chỉ : </p>
                                            <p>8. Nơi làm việc :</p>
                                            <p>9. Đối tượng : 1. BHYT 2. Thu phí 3. Miễn 4.Khác</p>
                                            <p>10. BHYT giá trị đến ngày ... tháng ... năm ...  : </p>
                                            <p>11. Họ tên địa chỉ người nhà khi cần báo tin : ... số điện thoại </p>
                                        <h3>II. QUẢN LÝ NGƯỜI BỆNH</h3>
                                            <p>12. Vào viện : giờ ... phút ... ngày ... </p>
                                            <p>13. Trực tiếp vào : </p>
                                            <p>14. Nơi giới thiệu : ... Vào viện do bệnh này lần thứ ... </p>
                                            <p>15. Vào khoa : ... giờ ... phút ... ngày ... </p>
                                            <p>16. Chuyển khoa : ... giờ ... phút ... ngày ... </p>
                                            <p>17. Chuyển viện : </p>
                                            <p>18. Ra viện : ... ngày ... giờ ... phút ... lý do ...</p>
                                            <p>19. Tổng số ngày điều trị : ... </p>
                                        <h3>III. CHẨN ĐOÁN</h3>                                        
                                            <p>20. Nơi chuyển đến : ...</p>
                                            <p>21. KKB, Cấp cứu : ... </p>
                                            <p>22. Khi vào khoa điều trị : </p>
                                            <p>+ Tai biến : ... </p>
                                            <p>+ Biến chứng : ... </p>
                                            <p><i>1. Do phẫu thuật</i></p>
                                            <p><i>2. Do gây mê</i></p>
                                            <p><i>3. Do nhiễm khuẩn</i></p>
                                            <p><i>4. Khác </i></p>
                                            <p>23. Tổng số ngày điều trị sau phẫu thuật : ... </p>
                                            <p>24. Tổng số lần phẫu thuật : ... </p>
                                            <p>25. Ra viện</p>
                                            <p>+ Bệnh chính : <i>(tổn thương)</i> ... Nguyên nhân ... </p>
                                            <p>+ Bệnh kèm theo : ...</p>
                                            <p>+ Chẩn đoán trước phẫu thuật : ...</p>
                                            <p>+ Chẩn đoán sau phẫu thuật : ...</p>

                                        <h3>IV. TÌNH TRẠNG RA VIỆN</h3>
                                            <p>24. Kết quả điều trị</p>
                                            <p><i>1. Khỏi : ...</i></p>
                                            <p><i>2. Đỡ, giảm : ...</i></p>
                                            <p><i>3. Không thay đổi : ...</i></p>
                                            <p><i>4. Nặng hơn : ... </i></p>
                                            <p><i>5. Tử vong : ... </i></p>
                                            <p>25. Giải phẫu bệnh <i>khi có sinh thiết</i></p>
                                            <p><i>1. Lành tính : ... </i></p>
                                            <p><i>2. Nghi ngờ : ... </i></p>
                                            <p><i>3. Ác tính : ... </i></p>
                                            <p>26. Tình hình tử vong : ... giờ ... phút ... ngày ... tháng ... năm</p>
                                            <p><i>1. Do bệnh : ...</i></p>
                                            <p><i>2. Do tái biến điều trị : ...</i></p>
                                            <p><i>3. Trong 24 giờ vào viện : ...</i></p>
                                            <p><i>4. Sau 24 giờ vào viện : ...</i></p>
                                            <p><i>5. Khác : ... </i></p>
                                            <p>27. Nguyên nhân chính tử vong : ... </p>
                                            <p>28. Khám nghiệm tử thi : ...</p>
                                            <p>29. Chẩn đoán giải phẫu tử thi : ... </p>
                                        <table style="width: 100%;">
                                        <tr>
                                            <td >
                                                <h3> Giám đốc bệnh viện</h3> 
                                                <p>Họ và tên : ... </p>
                                            </td>
                                            <td>
                                                <h3>Trưởng khoa</h3>
                                                <p>Họ và tên : ...</p>
                                            </td>
                                        </tr>
                                        </table>
                                        <h3>A-BỆNH ÁN</h3>
                                        <h3>I. Lý do vào viện : ... Vào ngày thứ ... của bệnh.</h3>
                                        <h3>II. Hỏi bệnh</h3>
                                        <p>1. Quá trình bệnh lý : <i>(Nguyên nhân, thời gian chấn thương, các phương pháp đã điều trị, diễn biến sau điều trị)</i>.</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>2. Tiền sử bệnh : </p>
                                        <p>+ Bản thân : </p>
                                        <p>- Mắt--------------------------------------------------------------------------------</p>
                                        <p>- Toàn thân--------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>+ Gia đình</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <p>-------------------------------------------------------------------------------------</p>
                                        <h3>III-Khám bệnh</h3>
                                        <p>1. Khám chuyên khoa</p>
                                        <table style="width: 100%;">
                                        <tr>
                                            <td>Thị lực vào viện : Không kính : MP ... MT ... </td>
                                            <td>Nhãn áp vào viện </td>
                                            <td>MP ... </td>
                                            <td>MT ... </td>
                                        </tr>
                                        <tr>
                                            <td>Có kính : MP ... MT ... </td>
                                            <td>Thị trường </td>
                                            <td>MP ... </td>
                                            <td>MT ... </td>
                                        </tr>
                                        </table>
                                        <table style="width: 100%;">
                                        <tr>
                                            <td>Mắt phải</td>
                                            <td>Mắt trái</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>1. Mi mắt</p>
                                                <p>- Bình thường ... Tụ máu ... Sưng nề ... </p>
                                                <p>- Rách mi : Lớp ... Toàn bộ chiều dầy ... Bờ mi ... Mất tổ chức ... Chưa khâu ... Đã khâu</p>
                                                <p>Lệ quản : Bình thường ... Đứt lệ quản ... 1/3 ngoài ... 1/3 giữa ... 1/3 trong ... Đứt 2 lệ quản</p>
                                                <p>- Sẹo mi ... </p>
                                                <p>- Các tổn thương khác : ... </p>
                                            </td>
                                            <td>
                                                <p>1. Mi mắt</p>
                                                <p>- Bình thường ... Tụ máu ... Sưng nề ... </p>
                                                <p>- Rách mi : Lớp ... Toàn bộ chiều dầy ... Bờ mi ... Mất tổ chức ... Chưa khâu ... Đã khâu</p>
                                                <p>Lệ quản : Bình thường ... Đứt lệ quản ... 1/3 ngoài ... 1/3 giữa ... 1/3 trong ... Đứt 2 lệ quản</p>
                                                <p>- Sẹo mi ... </p>
                                                <p>- Các tổn thương khác : ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>2. Kết mạc</p>
                                                <p>- Bình thường ... Cương tụ ... </p>
                                                <p>- Xuất huyết ... Rách KM ... </p>
                                                <p>- Thiếu máu ... </p>
                                                <p>- Các tổn thương khác ... </p>
                                                <p>Hình vẽ mô tả tổn thương khi vào viện</p>
                                                <img src="/images/nhankhoas/matphai.jpg" style="width: 400px;">
                                            </td>
                                            <td>
                                                <p>2. Kết mạc</p>
                                                <p>- Bình thường ... Cương tụ ... </p>
                                                <p>- Xuất huyết ... Rách KM ... </p>
                                                <p>- Thiếu máu ... </p>
                                                <p>- Các tổn thương khác ... </p>
                                                <p>Hình vẽ mô tả tổn thương khi vào viện</p>
                                                <img src="/images/nhankhoas/mattrai.jpg" style="width: 400px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>3. Giác mạc</p>
                                                <p>- Trong ... Phù ... Sẹo ... Dị vật ... </p>
                                                <p>- Tủa mặt sau giác mạc : Tủa mới ... Tủa cũ ... </p>
                                                <p>- Ngấm máu ... Abces ... Trợt ... Loét ... </p>
                                                <p>- Rách ... kích thước ... vị trí ... </p>
                                                <p>Rách gọn ... Nham nhở ... Mất tổ chức ... Kẹt tổ chức nội nhãn ... </p>
                                                <p>Đã khâu ... Đúng giải phẫu ... Không đúng giải phẫu ...</p>
                                                <p>- Tổn thương khác ... </p>
                                            </td>
                                            <td>
                                                <p>3. Giác mạc</p>
                                                <p>- Trong ... Phù ... Sẹo ... Dị vật ... </p>
                                                <p>- Tủa mặt sau giác mạc : Tủa mới ... Tủa cũ ... </p>
                                                <p>- Ngấm máu ... Abces ... Trợt ... Loét ... </p>
                                                <p>- Rách ... kích thước ... vị trí ... </p>
                                                <p>Rách gọn ... Nham nhở ... Mất tổ chức ... Kẹt tổ chức nội nhãn ... </p>
                                                <p>Đã khâu ... Đúng giải phẫu ... Không đúng giải phẫu ...</p>
                                                <p>- Tổn thương khác ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>4. Củng mạc</p>
                                                <p>- Bình thường ... Giãn lồi ...</p>
                                                <p>- Rách ... Kích thước ... vị trí ... </p>
                                                <p>Đã khâu ... Chưa khâu ... Kẹt tổ chức</p>
                                                <p>- Tổn thương khác : ... </p>
                                            </td>
                                            <td>
                                                <p>4. Củng mạc</p>
                                                <p>- Bình thường ... Giãn lồi ...</p>
                                                <p>- Rách ... Kích thước ... vị trí ... </p>
                                                <p>Đã khâu ... Chưa khâu ... Kẹt tổ chức</p>
                                                <p>- Tổn thương khác : ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>5. Tiền phòng</p>
                                                <p>Bình thường ... Xẹp tiền phòng ... Chất thể thủy tinh ... </p>
                                                <p>Mủ ... Xuất tiết ... Tyndall ... </p>
                                                <p>Xuất huyết : Mức độ ... Dị vật ... </p>
                                                <p>Tổn thương khác : ... </p>
                                            </td>
                                            <td>
                                                <p>5. Tiền phòng</p>
                                                <p>Bình thường ... Xẹp tiền phòng ... Chất thể thủy tinh ... </p>
                                                <p>Mủ ... Xuất tiết ... Tyndall ... </p>
                                                <p>Xuất huyết : Mức độ ... Dị vật ... </p>
                                                <p>Tổn thương khác : ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>6. Mống mắt</p>
                                                <p>Bình thường ... Thóai hóa ... </p>
                                                <p>Đứt chân mống mắt ... Mất mống mắt ... Thủng mống mắt ... </p>
                                                <p><strong>Đồng tử</strong></p>
                                                <p>Kích thước ... mm. PXĐT: Có ... Không ... </p>
                                                <p>Tròn ... Méo ... Dính ... vị trí ... Giãn liệt ... </p>
                                                <p>Ánh đồng tử : .... Không quan sát được ... </p>
                                            </td>
                                            <td>
                                                <p>6. Mống mắt</p>
                                                <p>Bình thường ... Thóai hóa ... </p>
                                                <p>Đứt chân mống mắt ... Mất mống mắt ... Thủng mống mắt ... </p>
                                                <p><strong>Đồng tử</strong></p>
                                                <p>Kích thước ... mm. PXĐT: Có ... Không ... </p>
                                                <p>Tròn ... Méo ... Dính ... vị trí ... Giãn liệt ... </p>
                                                <p>Ánh đồng tử : .... Không quan sát được ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>7. Thủy tinh thể :</p>
                                                <p>Trong ... Đục ... Vỡ ... Dị vật ... </p>
                                                <p>Sa lệch ... Ra tiền phòng ... Vào buồng dịch kính ... </p>
                                                <p>Viêm mủ ... Đã đặt IOL ... </p>
                                                <p>Tổn thương khác : ... </p>
                                            </td>
                                            <td>
                                                <p>7. Thủy tinh thể :</p>
                                                <p>Trong ... Đục ... Vỡ ... Dị vật ... </p>
                                                <p>Sa lệch ... Ra tiền phòng ... Vào buồng dịch kính ... </p>
                                                <p>Viêm mủ ... Đã đặt IOL ... </p>
                                                <p>Tổn thương khác : ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>8. Dịch kính</p>
                                                <p>Đục dịch kính ... Viêm mủ ...</p>
                                                <p>Xuất huyết dịch kính ... Tổ chức hóa ... </p>
                                                <p>Bong dịch kính sau ... Dị vật ... </p>
                                                <p>Tổn thương khác : ... </p>
                                            </td>
                                            <td>
                                                <p>8. Dịch kính</p>
                                                <p>Đục dịch kính ... Viêm mủ ...</p>
                                                <p>Xuất huyết dịch kính ... Tổ chức hóa ... </p>
                                                <p>Bong dịch kính sau ... Dị vật ... </p>
                                                <p>Tổn thương khác : ... </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>9. Võng mạc</p>
                                                <p>Hệ mạch : ... Đĩa thị ... Phù ... Xuất huyết ...</p>
                                                <p>Bong võng mạc : Không ... Có ... mức độ ... </p>
                                                <p>Rách võng mạc : Không ... Có ... số lượng ... </p>
                                                <p>Vị trí vết rách ... Hình thái ...</p>
                                                <p>Dị vật ... kích thước ... vị trí ... </p>
                                                <p>Tổn thương khác : ... </p>
                                                <center><img src="/images/nhankhoas/connguoiphai.jpg" style="width: 400px;"></center>
                                            </td>
                                            <td>
                                                <p>9. Võng mạc</p>
                                                <p>Hệ mạch : ... Đĩa thị ... Phù ... Xuất huyết ...</p>
                                                <p>Bong võng mạc : Không ... Có ... mức độ ... </p>
                                                <p>Rách võng mạc : Không ... Có ... số lượng ... </p>
                                                <p>Vị trí vết rách ... Hình thái ...</p>
                                                <p>Dị vật ... kích thước ... vị trí ... </p>
                                                <p>Tổn thương khác : ... </p>
                                                <center><img src="/images/nhankhoas/connguoitrai.jpg" style="width: 400px;"></center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>10. Hốc mắt</p>
                                                <p>Bình thường ... Bệnh lý ... Dị vật ...</p>
                                                <p>Vận nhãn : Bình thường ... Bệnh lý ... </p>
                                                <p><strong>Nhãn cầu : </strong>Teo ... Lồi ... Độ lồi ... </p>
                                            </td>
                                            <td>
                                                <p>10. Hốc mắt</p>
                                                <p>Bình thường ... Bệnh lý ... Dị vật ...</p>
                                                <p>Vận nhãn : Bình thường ... Bệnh lý ... </p>
                                                <p><strong>Nhãn cầu : </strong>Teo ... Lồi ... Độ lồi ... </p>
                                            </td>
                                        </tr>
                                        </table>
                                        <p>2. Toàn thân</p>
                                        <p>- Chưa có bệnh lý : .... </p>
                                        <p>- Bệnh lý : ...</p>
                                        <p>Mạch ...... lần/phút</p>
                                        <p>Nhiệt độ .... độ C</p>
                                        <p>Hyết áp .... / .... </p>
                                        <p>mmHg .... </p>
                                        <p>Nhịp thở .... </p>
                                        <h3>IV. CÁC XÉT NGHIỆM CẦN LÀM</h3>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <h3>V. TÓM TẮT</h3>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <h3>VI. CHẨN ĐOÁN</h3>
                                        <p>Bệnh chính : </p>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <p>Bệnh kèm theo : </p>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <p>Phân biệt</p>
                                        <p>------------------------------------------------------</p>
                                        <h3>VII. TIÊN LƯỢNG</h3>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <h3>ĐIỀU TRỊ</h3>
                                        <p>Phương pháp</p>
                                        <p>------------------------------------------------------</p>
                                        <p>------------------------------------------------------</p>
                                        <p style="margin-left: 500px;">Ngày ... tháng ... năm ... </p>
                                        <p style="margin-left: 500px;">Bác sỹ làm bệnh án</p>
                                        <p style="margin-left: 500px;">Họ và tên ....</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    </div>
                </div>
                <!-- Ket thuc hien thi hs benh an  -->

                <!-- Hien thi dat lich kham -->
                <div id="Đặt lịch khám" class="tabcontent" style="display:none">
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
                    </div>
                </div>
                <!-- Ket thuc hien thi dat lich kham -->

                <!-- Hiển thị yêu cầu khám -->
                @if(Auth::user()->role == 'A')
                <div id="Yêu cầu khám bệnh" class="tabcontent" style="display:none">
                    <input type="text" id="myInputATND" onkeyup="myFunctionATND()" placeholder="Tìm kiếm Tên người dùng" style="width: 298px;">                
                    <input type="text" id="myInputATK" onkeyup="myFunctionATK()" placeholder="Tìm kiếm Tên khoa" style="width: 298px;">                
                    <input type="text" id="myInputATCM" onkeyup="myFunctionATCM()" placeholder="Tìm kiếm Tên chuyên môn" style="width: 298px;">  
                    <br>
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
                <div id="Yêu cầu khám bệnh" class="tabcontent" style="display:none">
                    <input type="text" id="myInputBTND" onkeyup="myFunctionBTND()" placeholder="Tìm kiếm Tên người dùng" style="width: 298px;">                
                    <input type="text" id="myInputBTK" onkeyup="myFunctionBTK()" placeholder="Tìm kiếm Tên khoa" style="width: 298px;">                
                    <input type="text" id="myInputBTCM" onkeyup="myFunctionBTCM()" placeholder="Tìm kiếm Tên chuyên môn" style="width: 298px;">  
                    <br>
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

                <!-- Hien thi trang thai cac khoa -->
                @if(Auth::user()->role == 'A' || Auth::user()->role == 'B')
                <div id="Trạng thái các khoa" class="tabcontent" style="display:none">
                    <input type="text" id="myInputCMK" onkeyup="myFunctionCMK()" placeholder="Tìm kiếm Mã khoa" style="width: 220px;">                
                    <input type="text" id="myInputCMCM" onkeyup="myFunctionCMCM()" placeholder="Tìm kiếm Mã chuyên môn" style="width: 220px;">                
                    <input type="text" id="myInputCTK" onkeyup="myFunctionCTK()" placeholder="Tìm kiếm Tên khoa" style="width: 220px;">                
                    <input type="text" id="myInputCTCM" onkeyup="myFunctionCTCM()" placeholder="Tìm kiếm Tên chuyên môn" style="width: 220px;">  
                    <br>            
                    <br>
                    <div class="ex1">
                    <table style="width: 100%;" id="myTableC">                    
                        <tr style="height: 30px;">
                            <th>Mã khoa</th>
                            <th>Tên khoa</th>
                            <th>Mã chuyên môn</th>
                            <th>Tên chuyên môn</th>
                            <th>Số lượng chờ</th>
                        </tr>
                    @if(Auth::user()->role == 'A')
                    @foreach($chuyenmons_a as $cm )
                        <tr style="height: 30px;">
                            <td>{{ $cm->ma_khoa }}</td>
                            <td>{{ $cm->ten_khoa }}</td>
                            <td>{{ $cm->ma_chuyen_mon }}</td>
                            <td>{{ $cm->ten_chuyen_mon }}</td>
                            <input type="hidden" value="{{ $dem = 0 }}"/>
                            @foreach($requests_a_all as $req)
                            @if($req->ma_chuyen_mon == $cm->ma_chuyen_mon)
                            <input type="hidden" value="{{ $dem = $dem + 1 }}"/>
                            @endif
                            @endforeach
                            <td>{{ $dem }}</td>
                        </tr>                    
                    @endforeach
                    @endif
                    @if(Auth::user()->role == 'B')
                    @foreach($chuyenmons_b as $cm )
                        <tr style="height: 30px;">
                            <td>{{ $cm->ma_khoa }}</td>
                            <td>{{ $cm->ten_khoa }}</td>
                            <td>{{ $cm->ma_chuyen_mon }}</td>
                            <td>{{ $cm->ten_chuyen_mon }}</td>
                            <input type="hidden" value="{{ $dem = 0 }}"/>
                            @foreach($requests_a_all as $req)
                            @if($req->ma_chuyen_mon == $cm->ma_chuyen_mon)
                            <input type="hidden" value="{{ $dem = $dem + 1 }}"/>
                            @endif
                            @endforeach
                            <td>{{ $dem }}</td>
                        </tr>                    
                    @endforeach
                    @endif
                    </table>
                    </div>
                </div>
                @endif
                <!-- End hien thi trang thai cac khoa -->

                <!-- display favarite post -->
                <div id="Bài viết yêu thích" class="tabcontent" style="display:none">
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
                            <th><a href="#" style="color: blue;" data-toggle="modal" data-target="#myFavoritePost{{ $like->post['id']}}"><u>chi tiết</u></a></th>  
                            <td></td>
                        </tr>
                        </table>
                        <br>
                    <!-- Modal bài viết yêu thích -->
                    <div class="modal fade" id="myFavoritePost{{ $like->post['id']}}" role="dialog" style="margin-left: -350px;">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bài viết yêu thích</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="col-sm-12">                    
                                            <div class="col-sm-8">
                                                <center><p><strong>Bài viết</strong></p></center>
                                                <table style="width:100%;">
                                                <tr style="height: 100px;">
                                                    <th>Tiếu đề : </th>
                                                    <td>{{ $like->post['title']}}</p>
                                                </tr>   
                                                <tr style="height: 100px;">
                                                    <th>Nội dung : </th>
                                                    <td> {{ $like->post['content']}} </td>
                                                </tr>
                                                </table>
                                            </div>
                                            <div class="col-sm-4">
                                                <br>
                                                <center><p>Ảnh đính kèm</p></center>
                                                <br>
                                                <img id="picture" src="/images/forums/{{ $like->post['picture']}}" style="width:100%;" >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    @endforeach
                    </div>
                </div>
                <!-- End display favarite post -->

                <!-- display favarite post -->
                <div id="Bài viết của tôi" class="tabcontent" style="display:none">
                    <div class="ex1">
                    @foreach($posts->sortBy('created_at') as $post)
                        <h2>Tiêu đề : {{ $post->title }}</h2>
                        <p>Thời gian : {{ $post->created_at }}</p> 
                        <p> <a href="#" data-toggle="modal" data-target="#myModalMyPost{{ $post->id }}" style="margin-left:90%; color: blue;"><u>chi tiết</u></a>
                    <!-- Modal bài viết của tôi -->
                    <div class="modal fade" id="myModalMyPost{{ $post->id }}" role="dialog" style="margin-left: -350px;">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bài viết </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="col-sm-12">                    
                                            <div class="col-sm-8">
                                                <center><p><strong>Bài viết</strong></p></center>
                                                <table style="width:100%;">
                                                <tr style="height: 100px;">
                                                    <th>Tiếu đề : </th>
                                                    <td>{{ $post->title }}</p>
                                                </tr>   
                                                <tr style="height: 100px;">
                                                    <th>Nội dung : </th>
                                                    <td> {{ $post->content }} </td>
                                                </tr>
                                                </table>
                                            </div>
                                            <div class="col-sm-4">
                                                <br>
                                                <center><p>Ảnh đính kèm</p></center>
                                                <br>
                                                <img id="picture" src="/images/forums/{{ $post->picture }}" style="width:100%;" >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" title="Xóa bài viết" id="XoaBai" value="{{ $post->id }}" onclick="deletePost(this.value);">Xóa</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
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
function myFunctionATND() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputATND");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableA");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
function myFunctionATK() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputATK");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableA");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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
function myFunctionATCM() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputATCM");
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
function myFunctionBTND() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputBTND");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableB");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
function myFunctionBTK() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputBTK");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableB");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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
function myFunctionBTCM() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputBTCM");
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
<script>
function myFunctionCMK() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputCMK");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableC");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
function myFunctionCTK() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputCTK");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableC");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
function myFunctionCMCM() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputCMCM");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableC");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
function myFunctionCTCM() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputCTCM");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTableC");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<script>
    function deletePost(clicked_value){
        var url = "{{route('posts.delete')}}";
        if(confirm("Ban co chac chan xoa ?")){
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token"        : '{{csrf_token()}}',
                    "post_id"        : clicked_value,
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