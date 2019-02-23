@extends('layouts.master')
@include('layouts.header')
@section('content')
@include('layouts.slide')
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
                        @foreach($chuyenmons as $cm)
                        <option id="{{ $cm->ma_chuyen_mon }}" value="{{ $cm->ma_chuyen_mon }}"> {{ $cm->ten_chuyen_mon }} </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="myDiv">
                    <div class="myDivChild">
                        <p>Chọn ngày giờ</p>
                    </div>
                    <p> Chọn ngày :</p><input class="input" type="date">
                    <p> Chọn giờ : <input type="time">
                </div>
                <br>
                <center><button id="findBtn" class="btn btn-success">Xem kết quả </button></center>
            </div>
        </div>
        <div  class="col-sm-8">
        <div class="myDivResult">
            <br>
            <h2> Kết quả tìm kiếm :</h2>
            <br>
            <div class="col-sm-6">
            @foreach($tests as $test)
            <div class="myDivResultChild">
                <ul>
                    <li>Bệnh viện : A </li>
                    <li>Tên khoa : {{ $test->ten_khoa }} </li>
                    <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                    <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                    <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                    <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                    <li>Quy trình : {{ $test->quy_trinh }} </li>
                    <li>Trạng thái : </li>
                    @if($test->ma_cach_thuc == 'BT')
                    <li>Chế độ : Bình thường</li>
                    @else
                    <li>Chế độ : Chuyên gia</li>
                    @endif
                </ul>
                <p> <a href="#" style="margin-left:80%;">Chi tiết</a>
            </div>
            @endforeach
            </div>
            <div class="col-sm-6">
            @foreach($tests as $test)
            <div class="myDivResultChild">
                <ul>
                    <li>Bệnh viện : A </li>
                    <li>Tên khoa : {{ $test->ten_khoa }} </li>
                    <li>Tên chuyên môn : {{ $test->ten_chuyen_mon }}
                    <li>Tổng thời gian : {{ $test->tg_tren_ca }} phút</li>
                    <li>thời gian bắt đầu : {{ $test->thoi_gian_bd}}</li>
                    <li>Thời gian kết thúc : {{ $test->thoi_gian_kt}}</li>
                    <li>Quy trình : {{ $test->quy_trinh }} </li>
                    <li>Trạng thái : </li>
                    @if($test->ma_cach_thuc == 'BT')
                    <li>Chế độ : Bình thường</li>
                    @else
                    <li>Chế độ : Chuyên gia</li>
                    @endif
                </ul>
                <p> <a href="#" style="margin-left:80%;">Chi tiết</a>
            </div>
            @endforeach
            </div>
        </div>
        {{ $tests->links() }}
    </div>
    </div>

    <!-- js -->

    <script>
    $(document).ready(function(){
        
        $("#findBtn").click(function(){
            var bv    = document.getElementById('benh_vien').value;
            var khoa  = document.getElementById('khoa').value;
            var cm    = document.getElementById('chuyen_mon').value;
            var date  = 'ALL';
            var time  = 'ALL';
            // alert(window.location);
            // document.getElementById('findBtn').value = bv+"/"+khoa+"/"+cm+"/"+date+"/"+time;
            // alert(bv+"/"+khoa+"/"+cm+"/"+date+"/"+time);
            var cc = window.location.origin + "/home/"+bv+"/"+khoa+"/"+cm+"/"+date+"/"+time;
            window.location = cc;
            // alert(cc);
        });
    });
    </script>             
@endsection