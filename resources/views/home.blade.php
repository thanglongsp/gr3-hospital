@extends('layouts.master')
@include('layouts.slider')
@include('layouts.header')
@section('content')
<br>
<br>
<div class="col-sm-12">
    <div class="col-sm-4">
        <div class="condition">
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn bệnh viện</p>
                </div>
                <select id="benh_vien">
                    <option value="ALL">Tất cả</option>
                    <option value="A">Bệnh viện A</option>
                    <option value="B">Bệnh viện B</option>
                </select>
            </div>
            <br>
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn Khoa</p>
                </div>
                <select id="khoa">
                    <option value="ALL">Tất cả</option>
                    <option value="#" disabled>Bệnh viện A</option>                        
                    <option value="K001"> Nội Khoa</option>
                    <option value="K002"> Ngoại Khoa</option>
                    <option value="K003"> Nhãn Khoa</option>
                    <option value="#" disabled>Bệnh viện B</option>                                                
                    <option value="K001"> Nội Khoa</option>
                    <option value="K002"> Ngoại Khoa</option>
                    <option value="K003"> Nhi Khoa</option>
                </select>
            </div>
            <br>
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn chuyên môn</p>
                </div>
                <select id="chuyen_mon">
                    <option value="ALL">Tất cả</option>
                    <option value="#" disabled>Nội khoa</option>                        
                    <option value="CM001"> Hô hấp</option>
                    <option value="CM002"> Tiêu hóa</option>
                    <option value="CM003"> Cơ - xương - khớp</option>
                    <option value="CM004"> Nội tiết - Dinh dưỡng</option>
                    <option value="#" disabled> Ngoại Khoa</option>
                    <option value="CM005"> Phẫu thuật chỉnh hình</option>
                    <option value="CM006"> Phẫu thuật thần kinh</option>
                    <option value="CM007"> Phẫu thuật tim - Lồng ngực</option>
                    <option value="CM008"> Phẫu thuật tổng quát</option>
                    <option value="#" disabled> Nhi khoa ( bệnh viện B )</option>
                    <option value="CM009"> Sơ sinh</option>
                    <option value="CM010"> Dị tật tim mạch</option>
                    <option value="CM011"> Virus</option>
                    <option value="CM012"> Bạch cầu - máu</option>
                    <option value="#" disabled>Bệnh án mắt ( bệnh viện A )</option>                                                
                    <option value="CM009"> Chấn thương</option>
                    <option value="CM010"> Bán phần trước</option>
                    <option value="CM011"> Mắt tật</option>
                    <option value="CM012"> Đáy mắt</option>
                </select>
            </div>
            <br>
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn ngày giờ</p>
                </div>
                <p id="thong_bao" style="color:red"></p>
                <p> Chọn ngày :</p><input class="input" type="date" id="date">
                <p> Chọn giờ : <input type="time" id="time">
                </div>
                <br>
                <center><button id="findBtn" class="btn btn-success" style="width: 100%;">Xem kết quả</button></center>
            </div>
        </div>
        <div  class="col-sm-8">
            <div class="myDivResult">
                <br>
                <h2> Kết quả tìm kiếm : </h2>
                <p style = "color: blue">{{ $search_info }}</p>
                <br>
                @if($bv == 'ALL' && $khoa == 'ALL' && $ma_chuyen_mon == 'ALL')            
                <div class="col-sm-6">
                    @foreach($chuyenmons_a as $test)
                    <p type="hidden" value="{{ $dem = 1 }}">
                        <div class="myDivResultChild">
                            <ul>
                                <li>Bệnh viện : A </li>
                                <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                    <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                    <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                    <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                    <li>Quy trình : {{ $test->quy_trinh }} </li>
                                    @foreach( $requests_a as $rq )
                                    @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                    @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                    @endif 
                                    @endif
                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                    @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                    @endif 
                                    @endif
                                    @endif
                                    @endforeach
                                    @if( $dem == 1 )
                                    <li>Trạng thái : Có thể đặt lịch </li>
                                    @else
                                    <li>Trạng thái : Không thể đặt lịch </li>
                                    @endif

                                    @if($test->ma_cach_thuc == 'BT')
                                    <li>Chế độ : Bình thường</li>
                                    @else
                                    <li>Chế độ : Chuyên gia</li>
                                    @endif
                                </ul>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-3">
                                        <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                    </div>
                                    <div class="col-sm-6 col-xs-3">
                                        <a href="#"  data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Đặt lịch -->
                            <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Đặt lịch </h4>
                                        </div>
                                        <div>
                                            <div class="card">
                                                <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-sm-12">
                                                        <input type="hidden" value="A" name="benh_vien" >
                                                        <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                        <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                        <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                        <table style="width:100%;">
                                                            <tr>
                                                                <th> Bệnh viện </th>
                                                                <td> A </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tên khoa</th>
                                                                    <td>{{ $test->ten_khoa }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tên chuyên môn</th>
                                                                    <td>{{ $test->ten_chuyen_mon }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Ngày</th>
                                                                    <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Giờ</th>
                                                                    <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;" >
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Chi tiết </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="col-sm-12">                    
                                                        <table style="width:100%">
                                                            <tr> 
                                                                <th style="width:5%">Phòng </th>
                                                                <td style="width:15%;" >Bác sĩ </td>
                                                                <td style="width:10%;" >Chức danh </td>
                                                                <td style="width:70%;" >Mô tả </td>
                                                            </tr>
                                                            @foreach(explode(',',$test->quy_trinh) as $t)
                                                            <tr>
                                                                <th>{{ $t }} </th>
                                                                @foreach( $motas_a as $mta )
                                                                @if( $t == $mta->ma_quy_trinh )
                                                                <td>{{ $mta->hoten_bs }} </td>
                                                                <td>{{ $mta->chuc_danh }} </td>
                                                                <td>{{ $mta->mo_ta }} </td>
                                                                @endif
                                                                @endforeach
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                            @endforeach
                        </div>

                        <div class="col-sm-6">
                            @foreach($chuyenmons_b as $test)
                            <p type="hidden" value="{{ $dem = 1 }}">
                                <div class="myDivResultChild">
                                    <ul>
                                        <li>Bệnh viện : B </li>
                                        <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                        <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                            <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                            <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                            <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                            <li>Quy trình : {{ $test->quy_trinh }} </li>
                                            @foreach( $requests_b as $rq )
                                            @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                            @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                            @endif 
                                            @endif
                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                            @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                            @endif 
                                            @endif
                                            @endif
                                            @endforeach
                                            @if( $dem == 1 )
                                            <li>Trạng thái : Có thể đặt lịch </li>
                                            @else
                                            <li>Trạng thái : Không thể đặt lịch </li>
                                            @endif
                                            @if($test->ma_cach_thuc == 'BT')
                                            <li>Chế độ : Bình thường</li>
                                            @else
                                            <li>Chế độ : Chuyên gia</li>
                                            @endif
                                        </ul>
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-3">
                                                <p> <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                </div>
                                                <div class="col-sm-6 col-xs-3">
                                                    <a href="#"  data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>                                
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Đặt lịch -->
                                        <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Chi tiết </h4>
                                                    </div>
                                                    <div>
                                                        <div class="card">
                                                            <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="col-sm-12">
                                                                    <input type="hidden" value="B" name="benh_vien" >
                                                                    <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                    <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                    <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                    <table style="width:100%;">
                                                                        <tr>
                                                                            <th> Bệnh viện </th>
                                                                            <td> A </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Tên khoa</th>
                                                                                <td>{{ $test->ten_khoa }} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Tên chuyên môn</th>
                                                                                <td>{{ $test->ten_chuyen_mon }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Ngày</th>
                                                                                <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Giờ</th>
                                                                                <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Chi tiết </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="col-sm-12">                    
                                                                    <table style="width:100%">
                                                                        <tr>
                                                                            <th style="width:5%">Phòng </th>
                                                                            <td style="width:15%;" >Bác sĩ </td>
                                                                            <td style="width:10%;" >Chức danh </td>
                                                                            <td style="width:70%;" >Mô tả </td>
                                                                        </tr>
                                                                        @foreach(explode(',',$test->quy_trinh) as $t)
                                                                        <tr>
                                                                            <th>{{ $t }} </th>
                                                                            @foreach( $motas_a as $mta )
                                                                            @if( $t == $mta->ma_quy_trinh )
                                                                            <td>{{ $mta->hoten_bs }} </td>
                                                                            <td>{{ $mta->chuc_danh }} </td>
                                                                            <td>{{ $mta->mo_ta }} </td>
                                                                            @endif
                                                                            @endforeach
                                                                        </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
                                        @endforeach
                                    </div>
                                    {{ $chuyenmons_a->links() }}
                                </div>
                                @endif
                                @if($bv == 'ALL' && $khoa != 'ALL' && $ma_chuyen_mon != 'ALL')
                                <div class="col-sm-6">
                                    @foreach($chuyenmons_a as $test)
                                    <p type="hidden" value="{{ $dem = 1 }}">
                                        <div class="myDivResultChild">
                                            <ul>
                                                <li>Bệnh viện : A </li>
                                                <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                    <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                    <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                    <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                    <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                    @foreach( $requests_a as $rq )
                                                    @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                    @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                    @endif 
                                                    @endif
                                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                    @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                    @endif 
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                    @if( $dem == 1 )
                                                    <li>Trạng thái : Có thể đặt lịch </li>
                                                    @else
                                                    <li>Trạng thái : Không thể đặt lịch </li>
                                                    @endif

                                                    @if($test->ma_cach_thuc == 'BT')
                                                    <li>Chế độ : Bình thường</li>
                                                    @else
                                                    <li>Chế độ : Chuyên gia</li>
                                                    @endif
                                                </ul>
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-3">
                                                        <p> <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                        </div>
                                                        <div class="col-sm-6 col-xs-3">
                                                            <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Đặt lịch -->
                                                <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Chi tiết </h4>
                                                            </div>
                                                            <div>
                                                                <div class="card">
                                                                    <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="col-sm-12">
                                                                            <input type="hidden" value="A" name="benh_vien" >
                                                                            <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                            <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                            <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                            <table style="width:100%;">
                                                                                <tr>
                                                                                    <th> Bệnh viện </th>
                                                                                    <td> A </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tên khoa</th>
                                                                                        <td>{{ $test->ten_khoa }} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tên chuyên môn</th>
                                                                                        <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Ngày</th>
                                                                                        <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Giờ</th>
                                                                                        <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end modal -->
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Chi tiết </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card">
                                                                        <div class="col-sm-12">                    
                                                                            <table style="width:100%">
                                                                                <tr>
                                                                                    <th style="width:5%">Phòng </th>
                                                                                    <td style="width:15%;" >Bác sĩ </td>
                                                                                    <td style="width:10%;" >Chức danh </td>
                                                                                    <td style="width:70%;" >Mô tả </td>
                                                                                </tr>
                                                                                @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                <tr>
                                                                                    <th>{{ $t }} </th>
                                                                                    @foreach( $motas_a as $mta )
                                                                                    @if( $t == $mta->ma_quy_trinh )
                                                                                    <td>{{ $mta->hoten_bs }} </td>
                                                                                    <td>{{ $mta->chuc_danh }} </td>
                                                                                    <td>{{ $mta->mo_ta }} </td>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->
                                                @endforeach
                                            </div>

                                            <div class="col-sm-6">
                                                @foreach($chuyenmons_b as $test)
                                                <p type="hidden" value="{{ $dem = 1 }}">
                                                    <div class="myDivResultChild">
                                                        <ul>
                                                            <li>Bệnh viện : B </li>
                                                            <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                            <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                @foreach( $requests_b as $rq )
                                                                @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                @endif 
                                                                @endif
                                                                @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                @endif 
                                                                @endif
                                                                @endif
                                                                @endforeach
                                                                @if( $dem == 1 )
                                                                <li>Trạng thái : Có thể đặt lịch </li>
                                                                @else
                                                                <li>Trạng thái : Không thể đặt lịch </li>
                                                                @endif
                                                                @if($test->ma_cach_thuc == 'BT')
                                                                <li>Chế độ : Bình thường</li>
                                                                @else
                                                                <li>Chế độ : Chuyên gia</li>
                                                                @endif
                                                            </ul>
                                                            <div class="row">
                                                                <div class="col-sm-6 col-xs-3">
                                                                    <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                </div>
                                                                <div class="col-sm-6 col-xs-3">
                                                                    <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Đặt lịch -->
                                                        <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Chi tiết </h4>
                                                                    </div>
                                                                    <div>
                                                                        <div class="card">
                                                                            <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="col-sm-12">
                                                                                    <input type="hidden" value="B" name="benh_vien" >
                                                                                    <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                    <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                    <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                    <table style="width:100%;">
                                                                                        <tr>
                                                                                            <th> Bệnh viện </th>
                                                                                            <td> B </th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Tên khoa</th>
                                                                                                <td>{{ $test->ten_khoa }} </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Tên chuyên môn</th>
                                                                                                <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Ngày</th>
                                                                                                <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Giờ</th>
                                                                                                <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end modal -->
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Chi tiết </h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="card">
                                                                                <div class="col-sm-12">                    
                                                                                    <table style="width:100%">
                                                                                        <tr>
                                                                                            <th style="width:5%">Phòng </th>
                                                                                            <td style="width:15%;" >Bác sĩ </td>
                                                                                            <td style="width:10%;" >Chức danh </td>
                                                                                            <td style="width:70%;" >Mô tả </td>
                                                                                        </tr>
                                                                                        @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                        <tr>
                                                                                            <th>{{ $t }} </th>
                                                                                            @foreach( $motas_a as $mta )
                                                                                            @if( $t == $mta->ma_quy_trinh )
                                                                                            <td>{{ $mta->hoten_bs }} </td>
                                                                                            <td>{{ $mta->chuc_danh }} </td>
                                                                                            <td>{{ $mta->mo_ta }} </td>
                                                                                            @endif
                                                                                            @endforeach
                                                                                        </tr>
                                                                                        @endforeach
                                                                                    </table>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end modal -->
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                                @if($bv == 'ALL' && $khoa != "ALL" && $ma_chuyen_mon == 'ALL')
                                                <div class="col-sm-6">
                                                    @foreach($chuyenmons_a as $test)
                                                    <p type="hidden" value="{{ $dem = 1 }}">
                                                        <div class="myDivResultChild">
                                                            <ul>
                                                                <li>Bệnh viện : A </li>
                                                                <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                    <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                    <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                    <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                    <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                    @foreach( $requests_a as $rq )
                                                                    @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                    @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                    @endif 
                                                                    @endif
                                                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                    @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                    @endif 
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                    @if($test->ma_cach_thuc == 'BT')
                                                                    <li>Chế độ : Bình thường</li>
                                                                    @else
                                                                    <li>Chế độ : Chuyên gia</li>
                                                                    @endif
                                                                </ul>
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-xs-3">
                                                                        <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                    </div>
                                                                    <div class="col-sm-6 col-xs-3">
                                                                        <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal Đặt lịch -->
                                                            <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Chi tiết </h4>
                                                                        </div>
                                                                        <div>
                                                                            <div class="card">
                                                                                <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="col-sm-12">
                                                                                        <input type="hidden" value="A" name="benh_vien" >
                                                                                        <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                        <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                        <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                        <table style="width:100%;">
                                                                                            <tr>
                                                                                                <th> Bệnh viện </th>
                                                                                                <td> A </th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Tên khoa</th>
                                                                                                    <td>{{ $test->ten_khoa }} </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Tên chuyên môn</th>
                                                                                                    <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Ngày</th>
                                                                                                    <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Giờ</th>
                                                                                                    <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end modal -->
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Chi tiết </h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="card">
                                                                                    <div class="col-sm-12">                    
                                                                                        <table style="width:100%">
                                                                                            <tr>
                                                                                                <th style="width:5%">Phòng </th>
                                                                                                <td style="width:15%;" >Bác sĩ </td>
                                                                                                <td style="width:10%;" >Chức danh </td>
                                                                                                <td style="width:70%;" >Mô tả </td>
                                                                                            </tr>
                                                                                            @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                            <tr>
                                                                                                <th>{{ $t }} </th>
                                                                                                @foreach( $motas_a as $mta )
                                                                                                @if( $t == $mta->ma_quy_trinh )
                                                                                                <td>{{ $mta->hoten_bs }} </td>
                                                                                                <td>{{ $mta->chuc_danh }} </td>
                                                                                                <td>{{ $mta->mo_ta }} </td>
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end modal -->
                                                            @endforeach
                                                        </div>

                                                        <div class="col-sm-6">
                                                            @foreach($chuyenmons_b as $test)
                                                            <p type="hidden" value="{{ $dem = 1 }}">
                                                                <div class="myDivResultChild">
                                                                    <ul>
                                                                        <li>Bệnh viện : B </li>
                                                                        <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                        <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                            <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                            <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                            <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                            <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                            @foreach( $requests_b as $rq )
                                                                            @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                            @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                            @endif 
                                                                            @endif
                                                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                            @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                            @endif 
                                                                            @endif
                                                                            @endif
                                                                            @endforeach

                                                                            @if( $dem == 1 )
                                                                            <li>Trạng thái : Có thể đặt lịch </li>
                                                                            @else
                                                                            <li>Trạng thái : Không thể đặt lịch </li>
                                                                            @endif

                                                                            @if($test->ma_cach_thuc == 'BT')
                                                                            <li>Chế độ : Bình thường</li>
                                                                            @else
                                                                            <li>Chế độ : Chuyên gia</li>
                                                                            @endif
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-sm-6 col-xs-3">
                                                                                <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                            </div>
                                                                            <div class="col-sm-6 col-xs-3">
                                                                                <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal Đặt lịch -->
                                                                    <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                        <div class="modal-dialog">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Chi tiết </h4>
                                                                                </div>
                                                                                <div>
                                                                                    <div class="card">
                                                                                        <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <div class="col-sm-12">
                                                                                                <input type="hidden" value="B" name="benh_vien" >
                                                                                                <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                <table style="width:100%;">
                                                                                                    <tr>
                                                                                                        <th> Bệnh viện </th>
                                                                                                        <td> B </th>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>Tên khoa</th>
                                                                                                            <td>{{ $test->ten_khoa }} </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>Tên chuyên môn</th>
                                                                                                            <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>Ngày</th>
                                                                                                            <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>Giờ</th>
                                                                                                            <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end modal -->
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                            <div class="modal-dialog">
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                        <h4 class="modal-title">Chi tiết </h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="card">
                                                                                            <div class="col-sm-12">                    
                                                                                                <table style="width:100%">
                                                                                                    <tr>
                                                                                                        <th style="width:5%">Phòng </th>
                                                                                                        <td style="width:15%;" >Bác sĩ </td>
                                                                                                        <td style="width:10%;" >Chức danh </td>
                                                                                                        <td style="width:70%;" >Mô tả </td>
                                                                                                    </tr>
                                                                                                    @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                    <tr>
                                                                                                        <th>{{ $t }} </th>
                                                                                                        @foreach( $motas_a as $mta )
                                                                                                        @if( $t == $mta->ma_quy_trinh )
                                                                                                        <td>{{ $mta->hoten_bs }} </td>
                                                                                                        <td>{{ $mta->chuc_danh }} </td>
                                                                                                        <td>{{ $mta->mo_ta }} </td>
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    </tr>
                                                                                                    @endforeach
                                                                                                </table>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end modal -->
                                                                    @endforeach
                                                                </div>
                                                                {{ $chuyenmons_a->links() }}
                                                            </div>
                                                            @endif
                                                            @if($bv == 'ALL' && $khoa == "ALL" && $ma_chuyen_mon != 'ALL')
                                                            <div class="col-sm-6">
                                                                @foreach($chuyenmons_a as $test)
                                                                <p type="hidden" value="{{ $dem = 1 }}">
                                                                    <div class="myDivResultChild">
                                                                        <ul>
                                                                            <li>Bệnh viện : A </li>
                                                                            <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                            <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                @foreach( $requests_a as $rq )
                                                                                @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                @endif 
                                                                                @endif
                                                                                @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                @endif 
                                                                                @endif
                                                                                @endif
                                                                                @endforeach
                                                                                @if($test->ma_cach_thuc == 'BT')
                                                                                <li>Chế độ : Bình thường</li>
                                                                                @else
                                                                                <li>Chế độ : Chuyên gia</li>
                                                                                @endif
                                                                            </ul>
                                                                            <div class="row">
                                                                                <div class="col-sm-6 col-xs-3">
                                                                                    <a href="#"  data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                </div>
                                                                                <div class="col-sm-6 col-xs-3">
                                                                                    <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Modal Đặt lịch -->
                                                                        <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                            <div class="modal-dialog">
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                        <h4 class="modal-title">Chi tiết </h4>
                                                                                    </div>
                                                                                    <div>
                                                                                        <div class="card">
                                                                                            <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                @csrf
                                                                                                <div class="col-sm-12">
                                                                                                    <input type="hidden" value="A" name="benh_vien" >
                                                                                                    <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                    <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                    <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                    <table style="width:100%;">
                                                                                                        <tr>
                                                                                                            <th> Bệnh viện </th>
                                                                                                            <td> A </th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th>Tên khoa</th>
                                                                                                                <td>{{ $test->ten_khoa }} </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th>Tên chuyên môn</th>
                                                                                                                <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th>Ngày</th>
                                                                                                                <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <th>Giờ</th>
                                                                                                                <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- end modal -->
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                <div class="modal-dialog">
                                                                                    <!-- Modal content-->
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                            <h4 class="modal-title">Chi tiết </h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="card">
                                                                                                <div class="col-sm-12">                    
                                                                                                    <table style="width:100%">
                                                                                                        <tr>
                                                                                                            <th style="width:5%">Phòng </th>
                                                                                                            <td style="width:15%;" >Bác sĩ </td>
                                                                                                            <td style="width:10%;" >Chức danh </td>
                                                                                                            <td style="width:70%;" >Mô tả </td>
                                                                                                        </tr>
                                                                                                        @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                        <tr>
                                                                                                            <th>{{ $t }} </th>
                                                                                                            @foreach( $motas_a as $mta )
                                                                                                            @if( $t == $mta->ma_quy_trinh )
                                                                                                            <td>{{ $mta->hoten_bs }} </td>
                                                                                                            <td>{{ $mta->chuc_danh }} </td>
                                                                                                            <td>{{ $mta->mo_ta }} </td>
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                        </tr>
                                                                                                        @endforeach
                                                                                                    </table>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end modal -->
                                                                        @endforeach
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        @foreach($chuyenmons_b as $test)
                                                                        <p type="hidden" value="{{ $dem = 1 }}">
                                                                            <div class="myDivResultChild">
                                                                                <ul>
                                                                                    <li>Bệnh viện : B </li>
                                                                                    <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                    <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                        <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                        <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                        <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                        <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                        @foreach( $requests_b as $rq )
                                                                                        @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                        @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                        @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                        <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                        @endif 
                                                                                        @endif
                                                                                        @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                        @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                        <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                        @endif 
                                                                                        @endif
                                                                                        @endif
                                                                                        @endforeach

                                                                                        @if( $dem == 1 )
                                                                                        <li>Trạng thái : Có thể đặt lịch </li>
                                                                                        @else
                                                                                        <li>Trạng thái : Không thể đặt lịch </li>
                                                                                        @endif

                                                                                        @if($test->ma_cach_thuc == 'BT')
                                                                                        <li>Chế độ : Bình thường</li>
                                                                                        @else
                                                                                        <li>Chế độ : Chuyên gia</li>
                                                                                        @endif
                                                                                    </ul>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6 col-xs-3">
                                                                                            <a href="#"  data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                        </div>
                                                                                        <div class="col-sm-6 col-xs-3">
                                                                                            <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal Đặt lịch -->
                                                                                <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                    <div class="modal-dialog">
                                                                                        <!-- Modal content-->
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                <h4 class="modal-title">Chi tiết </h4>
                                                                                            </div>
                                                                                            <div>
                                                                                                <div class="card">
                                                                                                    <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                        @csrf
                                                                                                        <div class="col-sm-12">
                                                                                                            <input type="hidden" value="B" name="benh_vien" >
                                                                                                            <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                            <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                            <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                            <table style="width:100%;">
                                                                                                                <tr>
                                                                                                                    <th> Bệnh viện </th>
                                                                                                                    <td> B </th>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Tên khoa</th>
                                                                                                                        <td>{{ $test->ten_khoa }} </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Tên chuyên môn</th>
                                                                                                                        <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Ngày</th>
                                                                                                                        <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Giờ</th>
                                                                                                                        <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </div>
                                                                                                            <div class="modal-footer">
                                                                                                                <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end modal -->
                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                        <div class="modal-dialog">
                                                                                            <!-- Modal content-->
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                    <h4 class="modal-title">Chi tiết </h4>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <div class="card">
                                                                                                        <div class="col-sm-12">                    
                                                                                                            <table style="width:100%">
                                                                                                                <tr>
                                                                                                                    <th style="width:5%">Phòng </th>
                                                                                                                    <td style="width:15%;" >Bác sĩ </td>
                                                                                                                    <td style="width:10%;" >Chức danh </td>
                                                                                                                    <td style="width:70%;" >Mô tả </td>
                                                                                                                </tr>
                                                                                                                @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                <tr>
                                                                                                                    <th>{{ $t }} </th>
                                                                                                                    @foreach( $motas_a as $mta )
                                                                                                                    @if( $t == $mta->ma_quy_trinh )
                                                                                                                    <td>{{ $mta->hoten_bs }} </td>
                                                                                                                    <td>{{ $mta->chuc_danh }} </td>
                                                                                                                    <td>{{ $mta->mo_ta }} </td>
                                                                                                                    @endif
                                                                                                                    @endforeach
                                                                                                                </tr>
                                                                                                                @endforeach
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end modal -->
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @if($bv == "A" && $khoa == "ALL" && $ma_chuyen_mon == 'ALL')
                                                                        @foreach($chuyenmons_a as $test)
                                                                        <p type="hidden" value="{{ $dem = 1 }}">                
                                                                            <div class="myDivResultChild">
                                                                                <ul>
                                                                                    <li>Bệnh viện : A </li>
                                                                                    <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                    <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                        <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                        <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                        <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                        <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                        @foreach( $requests_a as $rq )
                                                                                        @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                        @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                        @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                        <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                        @endif 
                                                                                        @endif
                                                                                        @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                        @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                        <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                        @endif 
                                                                                        @endif
                                                                                        @endif
                                                                                        @endforeach

                                                                                        @if( $dem == 1 )
                                                                                        <li>Trạng thái : Có thể đặt lịch </li>
                                                                                        @else
                                                                                        <li>Trạng thái : Không thể đặt lịch </li>
                                                                                        @endif
                                                                                        @if($test->ma_cach_thuc == 'BT')
                                                                                        <li>Chế độ : Bình thường</li>
                                                                                        @else
                                                                                        <li>Chế độ : Chuyên gia</li>
                                                                                        @endif
                                                                                    </ul>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6 col-xs-3">
                                                                                            <a href="#"  data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                        </div>
                                                                                        <div class="col-sm-6 col-xs-3">
                                                                                            <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal Đặt lịch -->
                                                                                <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                    <div class="modal-dialog">
                                                                                        <!-- Modal content-->
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                <h4 class="modal-title">Chi tiết </h4>
                                                                                            </div>
                                                                                            <div>
                                                                                                <div class="card">
                                                                                                    <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                        @csrf
                                                                                                        <div class="col-sm-12">
                                                                                                            <input type="hidden" value="A" name="benh_vien" >
                                                                                                            <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                            <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                            <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                            <table style="width:100%;">
                                                                                                                <tr>
                                                                                                                    <th> Bệnh viện </th>
                                                                                                                    <td> A </th>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Tên khoa</th>
                                                                                                                        <td>{{ $test->ten_khoa }} </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Tên chuyên môn</th>
                                                                                                                        <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Ngày</th>
                                                                                                                        <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <th>Giờ</th>
                                                                                                                        <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </div>
                                                                                                            <div class="modal-footer">
                                                                                                                <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end modal -->
                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                        <div class="modal-dialog">
                                                                                            <!-- Modal content-->
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                    <h4 class="modal-title">Chi tiết </h4>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <div class="card">
                                                                                                        <div class="col-sm-12">                    
                                                                                                            <table style="width:100%">
                                                                                                                <tr>
                                                                                                                    <th style="width:5%">Phòng </th>
                                                                                                                    <td style="width:15%;" >Bác sĩ </td>
                                                                                                                    <td style="width:10%;" >Chức danh </td>
                                                                                                                    <td style="width:70%;" >Mô tả </td>
                                                                                                                </tr>
                                                                                                                @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                <tr>
                                                                                                                    <th>{{ $t }} </th>
                                                                                                                    @foreach( $motas_a as $mta )
                                                                                                                    @if( $t == $mta->ma_quy_trinh )
                                                                                                                    <td>{{ $mta->hoten_bs }} </td>
                                                                                                                    <td>{{ $mta->chuc_danh }} </td>
                                                                                                                    <td>{{ $mta->mo_ta }} </td>
                                                                                                                    @endif
                                                                                                                    @endforeach
                                                                                                                </tr>
                                                                                                                @endforeach
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end modal -->
                                                                                @endforeach
                                                                                {{ $chuyenmons_a->links() }}
                                                                                @endif
                                                                                @if($bv == "A" && $khoa != "ALL" && $ma_chuyen_mon == 'ALL')
                                                                                @foreach($chuyenmons_a as $test)
                                                                                <p type="hidden" value="{{ $dem = 1 }}">                
                                                                                    <div class="myDivResultChild">
                                                                                        <ul>
                                                                                            <li>Bệnh viện : A </li>
                                                                                            <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                            <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                                <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                                <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                                <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                                <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                                @foreach( $requests_a as $rq )
                                                                                                @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                                @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                                @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                                <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                @endif 
                                                                                                @endif
                                                                                                @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                                @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                                <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                @endif 
                                                                                                @endif
                                                                                                @endif
                                                                                                @endforeach

                                                                                                @if( $dem == 1 )
                                                                                                <li>Trạng thái : Có thể đặt lịch </li>
                                                                                                @else
                                                                                                <li>Trạng thái : Không thể đặt lịch </li>
                                                                                                @endif
                                                                                                @if($test->ma_cach_thuc == 'BT')
                                                                                                <li>Chế độ : Bình thường</li>
                                                                                                @else
                                                                                                <li>Chế độ : Chuyên gia</li>
                                                                                                @endif
                                                                                            </ul>
                                                                                            <div class="row">
                                                                                                <div class="col-sm-6 col-xs-3">
                                                                                                    <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                                </div>
                                                                                                <div class="col-sm-6 col-xs-3">
                                                                                                    <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- Modal Đặt lịch -->
                                                                                        <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                            <div class="modal-dialog">
                                                                                                <!-- Modal content-->
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                        <h4 class="modal-title">Chi tiết </h4>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <div class="card">
                                                                                                            <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                                @csrf
                                                                                                                <div class="col-sm-12">
                                                                                                                    <input type="hidden" value="A" name="benh_vien" >
                                                                                                                    <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                                    <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                                    <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                                    <table style="width:100%;">
                                                                                                                        <tr>
                                                                                                                            <th> Bệnh viện </th>
                                                                                                                            <td> A </th>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <th>Tên khoa</th>
                                                                                                                                <td>{{ $test->ten_khoa }} </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <th>Tên chuyên môn</th>
                                                                                                                                <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <th>Ngày</th>
                                                                                                                                <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <th>Giờ</th>
                                                                                                                                <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                            </tr>
                                                                                                                        </table>
                                                                                                                    </div>
                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- end modal -->
                                                                                            <!-- Modal -->
                                                                                            <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                <div class="modal-dialog">
                                                                                                    <!-- Modal content-->
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                            <h4 class="modal-title">Chi tiết </h4>
                                                                                                        </div>
                                                                                                        <div class="modal-body">
                                                                                                            <div class="card">
                                                                                                                <div class="col-sm-12">                    
                                                                                                                    <table style="width:100%">
                                                                                                                        <tr>
                                                                                                                            <th style="width:5%">Phòng </th>
                                                                                                                            <td style="width:15%;" >Bác sĩ </td>
                                                                                                                            <td style="width:10%;" >Chức danh </td>
                                                                                                                            <td style="width:70%;" >Mô tả </td>
                                                                                                                        </tr>
                                                                                                                        @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                        <tr>
                                                                                                                            <th>{{ $t }} </th>
                                                                                                                            @foreach( $motas_a as $mta )
                                                                                                                            @if( $t == $mta->ma_quy_trinh )
                                                                                                                            <td>{{ $mta->hoten_bs }} </td>
                                                                                                                            <td>{{ $mta->chuc_danh }} </td>
                                                                                                                            <td>{{ $mta->mo_ta }} </td>
                                                                                                                            @endif
                                                                                                                            @endforeach
                                                                                                                        </tr>
                                                                                                                        @endforeach
                                                                                                                    </table>
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- end modal -->
                                                                                        @endforeach
                                                                                        {{ $chuyenmons_a->links() }}
                                                                                        @endif
                                                                                        @if($bv == "A" && $ma_chuyen_mon != "ALL")
                                                                                        @foreach($chuyenmons_a as $test)
                                                                                        <p type="hidden" value="{{ $dem = 1 }}">                
                                                                                            <div class="myDivResultChild">
                                                                                                <ul>
                                                                                                    <li>Bệnh viện : A </li>
                                                                                                    <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                                    <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                                        <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                                        <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                                        <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                                        <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                                        @foreach( $requests_a as $rq )
                                                                                                        @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                                        @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                                        @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                                        <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                        @endif 
                                                                                                        @endif
                                                                                                        @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                                        @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                                        <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                        @endif 
                                                                                                        @endif
                                                                                                        @endif
                                                                                                        @endforeach

                                                                                                        @if( $dem == 1 )
                                                                                                        <li>Trạng thái : Có thể đặt lịch </li>
                                                                                                        @else
                                                                                                        <li>Trạng thái : Không thể đặt lịch </li>
                                                                                                        @endif
                                                                                                        @if($test->ma_cach_thuc == 'BT')
                                                                                                        <li>Chế độ : Bình thường</li>
                                                                                                        @else
                                                                                                        <li>Chế độ : Chuyên gia</li>
                                                                                                        @endif
                                                                                                    </ul>
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-6 col-xs-3">
                                                                                                            <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                                        </div>
                                                                                                        <div class="col-sm-6 col-xs-3">
                                                                                                            <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Modal Đặt lịch -->
                                                                                                <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                    <div class="modal-dialog">
                                                                                                        <!-- Modal content-->
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                <h4 class="modal-title">Chi tiết </h4>
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <div class="card">
                                                                                                                    <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                                        @csrf
                                                                                                                        <div class="col-sm-12">
                                                                                                                            <input type="hidden" value="A" name="benh_vien" >
                                                                                                                            <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                                            <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                                            <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                                            <table style="width:100%;">
                                                                                                                                <tr>
                                                                                                                                    <th> Bệnh viện </th>
                                                                                                                                    <td> A </th>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <th>Tên khoa</th>
                                                                                                                                        <td>{{ $test->ten_khoa }} </td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <th>Tên chuyên môn</th>
                                                                                                                                        <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <th>Ngày</th>
                                                                                                                                        <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <th>Giờ</th>
                                                                                                                                        <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </div>e" value="{{ $input_time }}" name="time"/>
                                                                                                                        </div>
                                                                                                                        <div class="modal-footer">
                                                                                                                            <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                                        </div>
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- end modal -->
                                                                                                <!-- Modal -->
                                                                                                <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                    <div class="modal-dialog">
                                                                                                        <!-- Modal content-->
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                <h4 class="modal-title">Chi tiết </h4>
                                                                                                            </div>
                                                                                                            <div class="modal-body">
                                                                                                                <div class="card">
                                                                                                                    <div class="col-sm-12">                    
                                                                                                                        <table style="width:100%">
                                                                                                                            <tr>
                                                                                                                                <th style="width:5%">Phòng </th>
                                                                                                                                <td style="width:15%;" >Bác sĩ </td>
                                                                                                                                <td style="width:10%;" >Chức danh </td>
                                                                                                                                <td style="width:70%;" >Mô tả </td>
                                                                                                                            </tr>
                                                                                                                            @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                            <tr>
                                                                                                                                <th>{{ $t }} </th>
                                                                                                                                @foreach( $motas_a as $mta )
                                                                                                                                @if( $t == $mta->ma_quy_trinh )
                                                                                                                                <td>{{ $mta->hoten_bs }} </td>
                                                                                                                                <td>{{ $mta->chuc_danh }} </td>
                                                                                                                                <td>{{ $mta->mo_ta }} </td>
                                                                                                                                @endif
                                                                                                                                @endforeach
                                                                                                                            </tr>
                                                                                                                            @endforeach
                                                                                                                        </table>
                                                                                                                    </div>
                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- end modal -->
                                                                                            @endforeach
                                                                                            @endif
                                                                                            @if($bv == "B" && $khoa != "ALL" && $ma_chuyen_mon == 'ALL')
                                                                                            @foreach($chuyenmons_b as $test)
                                                                                            <p type="hidden" value="{{ $dem = 1 }}">                
                                                                                                <div class="myDivResultChild">
                                                                                                    <ul>
                                                                                                        <li>Bệnh viện : B </li>
                                                                                                        <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                                        <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                                            <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                                            <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                                            <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                                            <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                                            @foreach( $requests_a as $rq )
                                                                                                            @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                                            @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                            @endif 
                                                                                                            @endif
                                                                                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                                            @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                            @endif 
                                                                                                            @endif
                                                                                                            @endif
                                                                                                            @endforeach

                                                                                                            @if( $dem == 1 )
                                                                                                            <li>Trạng thái : Có thể đặt lịch </li>
                                                                                                            @else
                                                                                                            <li>Trạng thái : Không thể đặt lịch </li>
                                                                                                            @endif
                                                                                                            @if($test->ma_cach_thuc == 'BT')
                                                                                                            <li>Chế độ : Bình thường</li>
                                                                                                            @else
                                                                                                            <li>Chế độ : Chuyên gia</li>
                                                                                                            @endif
                                                                                                        </ul>
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-6 col-xs-3">
                                                                                                                <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                                            </div>
                                                                                                            <div class="col-sm-6 col-xs-3">
                                                                                                                <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- Modal Đặt lịch -->
                                                                                                    <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                        <div class="modal-dialog">
                                                                                                            <!-- Modal content-->
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                    <h4 class="modal-title">Chi tiết </h4>
                                                                                                                </div>
                                                                                                                <div>
                                                                                                                    <div class="card">
                                                                                                                        <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                                            @csrf
                                                                                                                            <div class="col-sm-12">
                                                                                                                                <input type="hidden" value="B" name="benh_vien" >
                                                                                                                                <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                                                <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                                                <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                                                <table style="width:100%;">
                                                                                                                                    <tr>
                                                                                                                                        <th> Bệnh viện </th>
                                                                                                                                        <td> B </th>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <th>Tên khoa</th>
                                                                                                                                            <td>{{ $test->ten_khoa }} </td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <th>Tên chuyên môn</th>
                                                                                                                                            <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <th>Ngày</th>
                                                                                                                                            <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <th>Giờ</th>
                                                                                                                                            <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                                        </tr>
                                                                                                                                    </table>
                                                                                                                                </div>
                                                                                                                                <div class="modal-footer">
                                                                                                                                    <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                                                </div>
                                                                                                                            </form>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <!-- end modal -->
                                                                                                        <!-- Modal -->
                                                                                                        <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                            <div class="modal-dialog">
                                                                                                                <!-- Modal content-->
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                        <h4 class="modal-title">Chi tiết </h4>
                                                                                                                    </div>
                                                                                                                    <div class="modal-body">
                                                                                                                        <div class="card">
                                                                                                                            <div class="col-sm-12">                    
                                                                                                                                <table style="width:100%">
                                                                                                                                    <tr>
                                                                                                                                        <th style="width:5%">Phòng </th>
                                                                                                                                        <td style="width:15%;" >Bác sĩ </td>
                                                                                                                                        <td style="width:10%;" >Chức danh </td>
                                                                                                                                        <td style="width:70%;" >Mô tả </td>
                                                                                                                                    </tr>
                                                                                                                                    @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                                    <tr>
                                                                                                                                        <th>{{ $t }} </th>
                                                                                                                                        @foreach( $motas_a as $mta )
                                                                                                                                        @if( $t == $mta->ma_quy_trinh )
                                                                                                                                        <td>{{ $mta->hoten_bs }} </td>
                                                                                                                                        <td>{{ $mta->chuc_danh }} </td>
                                                                                                                                        <td>{{ $mta->mo_ta }} </td>
                                                                                                                                        @endif
                                                                                                                                        @endforeach
                                                                                                                                    </tr>
                                                                                                                                    @endforeach
                                                                                                                                </table>
                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                            </div>
                                                                                                                        </form>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- end modal -->
                                                                                                    @endforeach
                                                                                                    {{ $chuyenmons_b->links() }}
                                                                                                    @endif
                                                                                                    @if($bv == "B" && $khoa == "ALL" && $ma_chuyen_mon == 'ALL')
                                                                                                    @foreach($chuyenmons_b as $test)
                                                                                                    <p type="hidden" value="{{ $dem = 1 }}">                
                                                                                                        <div class="myDivResultChild">
                                                                                                            <ul>
                                                                                                                <li>Bệnh viện : B </li>
                                                                                                                <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                                                <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                                                    <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                                                    <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                                                    <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                                                    <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                                                    @foreach( $requests_a as $rq )
                                                                                                                    @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                                                    @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                                    @endif 
                                                                                                                    @endif
                                                                                                                    @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                                                    @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                                                    <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                                    @endif 
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                    @endforeach

                                                                                                                    @if( $dem == 1 )
                                                                                                                    <li>Trạng thái : Có thể đặt lịch </li>
                                                                                                                    @else
                                                                                                                    <li>Trạng thái : Không thể đặt lịch </li>
                                                                                                                    @endif
                                                                                                                    @if($test->ma_cach_thuc == 'BT')
                                                                                                                    <li>Chế độ : Bình thường</li>
                                                                                                                    @else
                                                                                                                    <li>Chế độ : Chuyên gia</li>
                                                                                                                    @endif
                                                                                                                </ul>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-6 col-xs-3">
                                                                                                                        <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-6 col-xs-3">
                                                                                                                        <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!-- Modal Đặt lịch -->
                                                                                                            <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                                <div class="modal-dialog">
                                                                                                                    <!-- Modal content-->
                                                                                                                    <div class="modal-content">
                                                                                                                        <div class="modal-header">
                                                                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                            <h4 class="modal-title">Chi tiết </h4>
                                                                                                                        </div>
                                                                                                                        <div>
                                                                                                                            <div class="card">
                                                                                                                                <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                                                    @csrf
                                                                                                                                    <div class="col-sm-12">
                                                                                                                                        <input type="hidden" value="B" name="benh_vien" >
                                                                                                                                        <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                                                        <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                                                        <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                                                        <table style="width:100%;">
                                                                                                                                            <tr>
                                                                                                                                                <th> Bệnh viện </th>
                                                                                                                                                <td> B </th>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <th>Tên khoa</th>
                                                                                                                                                    <td>{{ $test->ten_khoa }} </td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <th>Tên chuyên môn</th>
                                                                                                                                                    <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <th>Ngày</th>
                                                                                                                                                    <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <th>Giờ</th>
                                                                                                                                                    <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                                                </tr>
                                                                                                                                            </table>
                                                                                                                                        </div>
                                                                                                                                        <div class="modal-footer">
                                                                                                                                            <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                                                        </div>
                                                                                                                                    </form>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <!-- end modal -->
                                                                                                                <!-- Modal -->
                                                                                                                <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                                    <div class="modal-dialog">
                                                                                                                        <!-- Modal content-->
                                                                                                                        <div class="modal-content">
                                                                                                                            <div class="modal-header">
                                                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                                <h4 class="modal-title">Chi tiết </h4>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                                <div class="card">
                                                                                                                                    <div class="col-sm-12">                    
                                                                                                                                        <table style="width:100%">
                                                                                                                                            <tr>
                                                                                                                                                <th style="width:5%">Phòng </th>
                                                                                                                                                <td style="width:15%;" >Bác sĩ </td>
                                                                                                                                                <td style="width:10%;" >Chức danh </td>
                                                                                                                                                <td style="width:70%;" >Mô tả </td>
                                                                                                                                            </tr>
                                                                                                                                            @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                                            <tr>
                                                                                                                                                <th>{{ $t }} </th>
                                                                                                                                                @foreach( $motas_a as $mta )
                                                                                                                                                @if( $t == $mta->ma_quy_trinh )
                                                                                                                                                <td>{{ $mta->hoten_bs }} </td>
                                                                                                                                                <td>{{ $mta->chuc_danh }} </td>
                                                                                                                                                <td>{{ $mta->mo_ta }} </td>
                                                                                                                                                @endif
                                                                                                                                                @endforeach
                                                                                                                                            </tr>
                                                                                                                                            @endforeach
                                                                                                                                        </table>
                                                                                                                                    </div>
                                                                                                                                    <div class="modal-footer">
                                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                                    </div>
                                                                                                                                </form>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!-- end modal -->
                                                                                                            @endforeach
                                                                                                            {{ $chuyenmons_b->links() }}
                                                                                                            @endif
                                                                                                            @if($bv == "B" && $ma_chuyen_mon != "ALL")
                                                                                                            @foreach($chuyenmons_b as $test)
                                                                                                            <p type="hidden" value="{{ $dem = 1 }}">
                                                                                                                <div class="myDivResultChild">
                                                                                                                    <ul>
                                                                                                                        <li>Bệnh viện : B </li>
                                                                                                                        <li>Tên khoa : {{ $test->ten_khoa }} </li>
                                                                                                                        <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                                                                                                                            <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                                                                                                                            <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                                                                                                                            <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                                                                                                                            <li>Quy trình : {{ $test->quy_trinh }} </li>
                                                                                                                            @foreach( $requests_b as $rq )
                                                                                                                            @if( $rq->ma_chuyen_mon == $test->ma_chuyen_mon && $rq->ngay_thu == $date && $rq->cach_thuc == $test->ma_cach_thuc)
                                                                                                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio + 1))
                                                                                                                            @if(explode(':',$rq->thoi_gian)[1] < $time_phut)
                                                                                                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                                            @endif 
                                                                                                                            @endif
                                                                                                                            @if(explode(':',$rq->thoi_gian)[0] == ($time_gio - 1))
                                                                                                                            @if(explode(':',$rq->thoi_gian)[1] > $time_phut)
                                                                                                                            <p type="hidden" value="{{ $dem = 0 }}"></p>
                                                                                                                            @endif 
                                                                                                                            @endif
                                                                                                                            @endif
                                                                                                                            @endforeach

                                                                                                                            @if( $dem == 1 )
                                                                                                                            <li>Trạng thái : Có thể đặt lịch </li>
                                                                                                                            @else
                                                                                                                            <li>Trạng thái : Không thể đặt lịch </li>
                                                                                                                            @endif
                                                                                                                            @if($test->ma_cach_thuc == 'BT')
                                                                                                                            <li>Chế độ : Bình thường</li>
                                                                                                                            @else
                                                                                                                            <li>Chế độ : Chuyên gia</li>
                                                                                                                            @endif
                                                                                                                        </ul>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-6 col-xs-3">
                                                                                                                                <a href="#" data-toggle="modal" data-target="#dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:40%;">Đặt lịch</a>
                                                                                                                            </div>
                                                                                                                            <div class="col-sm-6 col-xs-3">
                                                                                                                                <a href="#" data-toggle="modal" data-target="#{{ $test->ma_chuyen_mon.$test->ma_cach_thuc}}" style="margin-left:50%;">Chi tiết</a>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <!-- Modal Đặt lịch -->
                                                                                                                    <div class="modal fade" id="dat_lich{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                                        <div class="modal-dialog">
                                                                                                                            <!-- Modal content-->
                                                                                                                            <div class="modal-content">
                                                                                                                                <div class="modal-header">
                                                                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                                    <h4 class="modal-title">Chi tiết </h4>
                                                                                                                                </div>
                                                                                                                                <div>
                                                                                                                                    <div class="card">
                                                                                                                                        <form method="post" action="{{ route('users.datlich') }}" enctype="multipart/form-data">
                                                                                                                                            @csrf
                                                                                                                                            <div class="col-sm-12">
                                                                                                                                                <input type="hidden" value="B" name="benh_vien" >
                                                                                                                                                <input type="hidden" value="{{ $test->ma_khoa }}" name="khoa" >
                                                                                                                                                <input type="hidden" value="{{ $test->ma_chuyen_mon }}" name="chuyen_mon">
                                                                                                                                                <input type="hidden" value="{{ $test->ma_cach_thuc }}" name="cach_thuc">
                                                                                                                                                <table style="width:100%;">
                                                                                                                                                    <tr>
                                                                                                                                                        <th> Bệnh viện </th>
                                                                                                                                                        <td> B </th>
                                                                                                                                                        </tr>
                                                                                                                                                        <tr>
                                                                                                                                                            <th>Tên khoa</th>
                                                                                                                                                            <td>{{ $test->ten_khoa }} </td>
                                                                                                                                                        </tr>
                                                                                                                                                        <tr>
                                                                                                                                                            <th>Tên chuyên môn</th>
                                                                                                                                                            <td>{{ $test->ten_chuyen_mon }}</td>
                                                                                                                                                        </tr>
                                                                                                                                                        <tr>
                                                                                                                                                            <th>Ngày</th>
                                                                                                                                                            <td><input type="date" value="{{ $date }}" name="ngay"/></td>
                                                                                                                                                        </tr>
                                                                                                                                                        <tr>
                                                                                                                                                            <th>Giờ</th>
                                                                                                                                                            <td><input type="time" value="{{ $input_time }}" name="time"/></td>
                                                                                                                                                        </tr>
                                                                                                                                                    </table>
                                                                                                                                                </div>
                                                                                                                                                <div class="modal-footer">
                                                                                                                                                    <button type="submit" class="btn btn-success">Đặt lịch</button>
                                                                                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                                                                                </div>
                                                                                                                                            </form>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <!-- end modal -->
                                                                                                                        <!-- Modal -->
                                                                                                                        <div class="modal fade" id="{{ $test->ma_chuyen_mon.$test->ma_cach_thuc }}" role="dialog" style="margin-left: 100px;">
                                                                                                                            <div class="modal-dialog">
                                                                                                                                <!-- Modal content-->
                                                                                                                                <div class="modal-content">
                                                                                                                                    <div class="modal-header">
                                                                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                                        <h4 class="modal-title">Chi tiết </h4>
                                                                                                                                    </div>
                                                                                                                                    <div class="modal-body">
                                                                                                                                        <div class="card">
                                                                                                                                            <div class="col-sm-12">                    
                                                                                                                                                <table style="width:100%">
                                                                                                                                                    <tr>
                                                                                                                                                        <th style="width:5%">Phòng </th>
                                                                                                                                                        <td style="width:15%;" >Bác sĩ </td>
                                                                                                                                                        <td style="width:10%;" >Chức danh </td>
                                                                                                                                                        <td style="width:70%;" >Mô tả </td>
                                                                                                                                                    </tr>
                                                                                                                                                    @foreach(explode(',',$test->quy_trinh) as $t)
                                                                                                                                                    <tr>
                                                                                                                                                        <th>{{ $t }} </th>
                                                                                                                                                        @foreach( $motas_a as $mta )
                                                                                                                                                        @if( $t == $mta->ma_quy_trinh )
                                                                                                                                                        <td>{{ $mta->hoten_bs }} </td>
                                                                                                                                                        <td>{{ $mta->chuc_danh }} </td>
                                                                                                                                                        <td>{{ $mta->mo_ta }} </td>
                                                                                                                                                        @endif
                                                                                                                                                        @endforeach
                                                                                                                                                    </tr>
                                                                                                                                                    @endforeach
                                                                                                                                                </table>
                                                                                                                                            </div>
                                                                                                                                            <div class="modal-footer">
                                                                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                                            </div>
                                                                                                                                        </form>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <!-- end modal -->
                                                                                                                    @endforeach
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <!-- js -->

                                                                                                            <script>
                                                                                                            $(document).ready(function(){
                                                                                                                
                                                                                                                $("#findBtn").click(function(){
                                                                                                                    var bv    = document.getElementById('benh_vien').value;
                                                                                                                    var khoa  = document.getElementById('khoa').value;
                                                                                                                    var cm    = document.getElementById('chuyen_mon').value;
                                                                                                                    var date  = document.getElementById('date').value;
                                                                                                                    var time  = document.getElementById('time').value;
                                                                                                                    if(time == '')
                                                                                                                        time = 'ALL';
                                                                                                                    if(date == '')
                                                                                                                        date = 'ALL';
                                                                                                                    var cc = window.location.origin + "/home/"+bv+"/"+khoa+"/"+cm+"/"+date+"/"+time;
                                                                                                                    window.location = cc;
                                                                                                                });

$("#date").change(function(){
    var date  = document.getElementById('date').value;
    var today = new Date();
    var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            if(0 < mm < 10)
                mm = "0"+ mm;
            var current_date = yyyy+"-"+mm+"-"+dd;
            var input_year = date.split('-', 3)[0];
            var input_month = date.split('-', 3)[1];
            var input_day = date.split('-', 3)[2];
            if( input_year < yyyy )
                document.getElementById('thong_bao').innerHTML = 'Năm không hợp lệ';
            if( input_month < mm )
                document.getElementById('thong_bao').innerHTML = 'Tháng không hợp lệ';
            if( input_year == yyyy && input_month == mm && input_day < dd )
                document.getElementById('thong_bao').innerHTML = 'Ngày không hợp lệ';
        });
$("#time").change(function(){
    var time  = document.getElementById('time').value;
    var date  = document.getElementById('date').value;
    var input_gio = time.split(':', 2)[0];
    var input_phut = time.split(':', 2)[1];
    if( input_gio < 8 || input_gio > 17)
        document.getElementById('thong_bao').innerHTML = 'Không phải giờ làm việc, xin đặt lại ! (Từ 8h30 - 17h15)';
    if( input_gio == 8 && input_phut < 30)
        document.getElementById('thong_bao').innerHTML = 'Chưa đến giờ làm việc, xin đặt lại ! (Từ 8h30 - 17h15)';
    if( input_gio == 17 && input_phut > 15)
        document.getElementById('thong_bao').innerHTML = 'Đã hết giờ làm việc, xin đặt lại ! (Từ 8h30 - 17h15)';
    if( date == "" )
        document.getElementById('thong_bao').innerHTML = "Mời bạn chọn ngày !";
});
});
</script>
<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
}
myIndex++;
if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 5000); // Change image every 2 seconds
      }
      </script>             
      @endsection