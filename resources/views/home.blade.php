@extends('layouts.master')
@section('content')
@include('layouts.slide')
@include('layouts.header')
<div class="col-sm-12">
        <div class="col-sm-4">
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn bệnh viện</p>
                </div>
                <select>
                    <option value="#">Tất cả</option>
                    <option value="#">Bệnh viện A</option>
                    <option value="#">Bệnh viện B</option>
                </select>
            </div>
            <br>
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn Khoa</p>
                </div>
                <select>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                </select>
            </div>
            <br>
            <div class="myDiv">
                <div class="myDivChild">
                    <p>Chọn chế độ khám</p>
                </div>
                <select>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
                    <option value="#">X</option>
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
        </div>
        @include('layouts.result')
    </div>            