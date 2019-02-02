@extends('layouts.master')
@include('layouts.header')
@section('content')
<div class="col-sm-12" style="margin-top: 50px;">
    <div class="col-sm-2" style="background-color: red;">
        <div class="divForum">
            <div class="divForumChild"> 
                <br>
                <p>Bài viết được quan tâm</p>
            </div>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
            <a href="">link ... </a><br>
        </div>
    </div>
    <div class="col-sm-10">

        <!-- Đăng bài -->
        <div class="col-sm-12">        
            <div class="col-sm-1">
                <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 70px; text-align: center; width: 70px;">
            </div> 
            <div class="col-sm-10" style="margin-top: 20px;">
                <a href="#" data-toggle="modal" data-target="#myModalMyPost"><u><i>{{ Auth::user()->full_name }} bạn có muốn đăng bài ?</i></u></a> 
            </div>
        </div>
        <!-- end Đăng bài -->
        
        <!-- Bài viết -->
        <div class="divPostUser">
            <div class="divPostUserHeader">
                <p>ccc</p>
            </div>
            <div class="divPostUserContent">
                <p>ccc</p>
                <p>ccc</p>
                <p>ccc</p>
                <p>ccc</p>
            </div>
            <div class="divPostUserFooter">
                <p>sss</p>
            </div>
        </div>
        <!-- end Bài viết -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalMyPost" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đăng bài </h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12">                    
                        <div class="col-sm-8">
                            <center><p><strong>Bài viết</strong></p></center>
                            <textarea rows="10" cols="60">
                            </textarea>
                        </div>
                        <div class="col-sm-4">
                            <center><p>Ảnh đính kèm <i>(nếu có)</i></p></center>
                            <img src="#">
                            <input accept="image/*" name="#" title="thêm ảnh" type="file">                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Post</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection