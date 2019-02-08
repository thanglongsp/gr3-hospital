@extends('layouts.master')
@include('layouts.header')
@section('content')
<div class="col-sm-12" style="margin-top: 50px; margin-left:60px;">
    <div class="col-sm-1"></div>
    <!-- Link left -->
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
    <!-- End link left -->
    <div class="col-sm-5">

        <!-- Đăng bài -->
        <div class="col-sm-12">        
            <div class="col-sm-4">
                <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 70px; text-align: center; width: 70px;">
            </div> 
            <div class="col-sm-8" style="margin-top: 20px;">
                <a href="#" data-toggle="modal" data-target="#myModalMyPost" style="margin-left:-100px;"><u><i>{{ Auth::user()->full_name }} bạn có muốn đăng bài ?</i></u></a> 
            </div>
        </div>
        <!-- end Đăng bài -->
        <div class="content">
        @foreach($posts as $post)
            <!-- Bài viết -->
            <div class="divPostUser">
                <div class="divPostUserHeader">
                    <p>{{ $post->title }}</p>
                </div>
                <div class="divPostUserContent">
                @if($post->content != NULL)
                    <p>{{ $post->content }}</p>
                @endif
                @if($post->picture != NULL)
                    <img src="/images/forums/{{ $post->picture }}" style="width:200px;">
                @endif      
                </div>          
                <div class="divPostUserFooter">
                    <a href="#"><span class="glyphicon glyphicon-heart" style="font-size:25px; color:red;"></span></a>
                    <a data-toggle="collapse" data-parent="#accordion" href="#comment{{ $post->id }}"><span class="glyphicon glyphicon-envelope" style="font-size:25px; color:blue;"></span></a>
                </div>

                <!-- Bình luận -->
                <div id="comment{{ $post->id }}" class="panel-collapse collapse">
                    @foreach($comments as $cmt)
                        @if($cmt->post_id == $post->id )
                            <div>
                                <p>{{ $cmt->content }}</p>
                            </div>
                        @endif
                    @endforeach
                    <div class="col-sm-2">
                        <a class="pr-3">
                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                        </a>
                    </div>
                    <form action="{{ route('post_comment', [Auth::user()->id, $post->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" value="0" name="parent_id">
                        <div class="col-sm-7">
                            <input type="text" style="margin-top:10px; margin-left:-45px;" name="content" placeholder="Bình luận ... ">
                        </div>
                        <div class="col-sm-2" style="margin-left:-50px;">
                            <a href="#" data-toggle="modal" data-target="#picture_comment_{{ $post->id }}" ><span style="margin-top:10px; font-size: 25px;" class="glyphicon glyphicon-picture"></span>                            </a>
                            <a href="#"><span style="margin-top:10px; font-size: 25px;" class="glyphicon glyphicon-camera"></span></a>
                        </div>
                        <!-- Modal post or catch picture-->
                        <div class="modal fade" id="picture_comment_{{ $post->id }}" role="dialog">
                            <div class="modal-dialog">
                            <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Đăng bài </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="col-sm-12">                    
                                                <div class="col-sm-8">
                                                <center><p>Chụp ảnh ? <i>(nếu muốn)</i></p></center>                                                    
                                                </div>
                                                <div class="col-sm-4">
                                                    <br>
                                                    <center><p>Ảnh đính kèm <i>(nếu có)</i></p></center>
                                                    <br>
                                                    <input type="hidden" name="new_name_comment{{ $post->id }}" id="new_name_comment{{ $post->id }}" value="#">
                                                    <img id="picture_comment{{ $post->id }}" src="/images/forums/default_image.jpg" style="width:200px;" >
                                                    <input accept="image/*" id="{{ $post->id }}" name="file_comment{{ $post->id }}" title="thêm ảnh" type="file" onchange="displayCommentImage(this.id)">                            
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
                        <div class="col-sm-1">
                            <button class="btn btn-primary" type="submit" style="margin-top:10px; margin-left:-30px;">Bình luận</button>
                        </div>
                    </form>                                     
                </div>
                <!-- end bình luận -->
            </div>
            <!-- end Bài viết -->
        @endforeach
        </div>
    </div>
    <!-- Link right -->
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
    <!-- end link right -->
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
                    <form method="post" action="{{ route('users.post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12">                    
                        <div class="col-sm-8">
                            <center><p><strong>Bài viết</strong></p></center>
                            <p>Tiếu đề : </p>
                            <input type="text" name="title" style="width:513px;">
                            <p>Nội dung : </p>
                            <textarea rows="10" cols="60" name="content">
                            </textarea>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <center><p>Ảnh đính kèm <i>(nếu có)</i></p></center>
                            <br>
                            <input type="hidden" name="new_name" id="new_name" value="#">
                            <img id="picture" src="/images/forums/default_image.jpg" style="width:200px;" >
                            <input accept="image/*" name="post_image" title="thêm ảnh" type="file" onchange="displayPostImage()">                            
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