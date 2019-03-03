@extends('layouts.master')
@include('layouts.header')
@section('content')
<div class="col-sm-12" style="margin-top: 50px; margin-left:60px;">
    <div class="col-sm-1"></div>
    <!-- Link left -->
    <div class="col-sm-2" style="background-color: #978ea7;">
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
                @if(Auth::user()->avatar == NULL && Auth::user()->gender == 1)
                <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 70px; text-align: center; width: 70px;">
                @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 2)
                <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 70px; text-align: center; width: 70px;">
                @else
                <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 70px; text-align: center; width: 70px;">
                @endif
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
                    <img src="/images/forums/{{ $post->picture }}" style="width:100%;">
                @endif      
                </div>          
                <div class="divPostUserFooter">
                @if($count_like != 0)
                <p type="hidden" value="{{ $dem = 0 }}"></p>
                    @foreach($likes as $like)
                        @if($like->user_id == Auth::user()->id && $like->post_id == $post->id)
                        <p type="hidden" value="{{ $dem = 1 }}"></p>
                        @endif
                    @endforeach
                        @if($dem == 1)
                            <form method="post" action="{{ route('posts.like', $post->id) }}" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="value" value="0">
                                <input type="hidden" name="like_id" value="{{ $like->id }}">
                                <button type="submit" style="background-color: Transparent;border: none;"><span class="glyphicon glyphicon-heart" style="font-size:25px; color:red;"></span></button>
                                <a data-toggle="collapse" data-parent="#accordion" href="#comment{{ $post->id }}"><span class="glyphicon glyphicon-envelope" style="font-size:25px; color:blue;"></span></a>
                            </form>                            
                        @endif
                        @if($dem == 0)
                            <form method="post" action="{{ route('posts.like', $post->id) }}" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="value" value="1">
                                <button type="submit" style="background-color: Transparent;border: none;"><span class="glyphicon glyphicon-heart" style="font-size:25px; color:blue;" name="value" value="1"></span></button>
                                <a data-toggle="collapse" data-parent="#accordion" href="#comment{{ $post->id }}"><span class="glyphicon glyphicon-envelope" style="font-size:25px; color:blue;"></span></a>
                            </form>                    
                        @endif
                @else
                        <form method="post" action="{{ route('posts.like', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="value" value="1">
                            <button type="submit" style="background-color: Transparent;border: none;"><span class="glyphicon glyphicon-heart" style="font-size:25px; color:blue;" name="value" value="1"></span></button>
                            <a data-toggle="collapse" data-parent="#accordion" href="#comment{{ $post->id }}"><span class="glyphicon glyphicon-envelope" style="font-size:25px; color:blue;"></span></a>
                        </form>                    
                @endif
                </div>

                <!-- Bình luận -->
                <div id="comment{{ $post->id }}" class="panel-collapse collapse">
                    <div>
                        <div class="col-sm-2">
                            <a class="pr-3">
                            @if(Auth::user()->avatar == NULL && Auth::user()->gender == 1)
                            <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                            @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 2)
                            <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                            @else
                            <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                            @endif
                            <!-- <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;"> -->
                            </a>
                        </div>
                        <form action="{{ route('post_comment', [Auth::user()->id, $post->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" value="0" name="parent_id">
                            <div class="col-sm-7">
                                <input type="text" style="margin-top:10px; margin-left:-45px;" name="content" placeholder="Bình luận ... ">
                            </div>
                            <div class="col-sm-2" style="margin-left:-50px;">
                                <a href="#" data-toggle="modal" data-target="#picture_comment_{{ $post->id }}" ><span style="margin-top:10px; font-size: 25px;" class="glyphicon glyphicon-picture"></span></a>
                                <a href="#" data-toggle="modal" data-target="#picture_comment_{{ $post->id }}" ><span style="margin-top:10px; font-size: 25px;" class="glyphicon glyphicon-camera"></span></a>
                            </div>
                            <!-- Modal post or catch picture-->
                            <div class="modal fade" id="picture_comment_{{ $post->id }}" role="dialog" style="margin-left: 100px;">
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
                                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#myModal" onclick="takePicture(this.value)" value="comment">Take photo</a>
                                                    <div>
                                                        <canvas id="canvasComment" width=320 height=240></canvas>
                                                    </div>
                                                    <input type="hidden" name="srcImage" id="srcImage"></intput>                                                    
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
                    <br>
                    <br>
                    <br>
                    <!-- show bình luận -->
                    <div>
                    @foreach($comments->sortByDesc('created_at') as $cmt)
                        @if($cmt->post_id == $post->id && $cmt->parent_id == 0)
                            <div class="row">
                                <div class="col-sm-2 col-xs-3">
                                    <a class="pr-3" >
                                    @if(Auth::user()->id == $cmt->user['id'])
                                        @if(Auth::user()->avatar == NULL && Auth::user()->gender == 1)
                                        <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                                        @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 2)
                                        <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                                        @else
                                        <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                                        @endif
                                    <!--  -->
                                    @else
                                        @if($cmt->user['avatar'] == NULL && $cmt->user['gender'] == 1)
                                        <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                                        @elseif($cmt->user['avatar'] == NULL && $cmt->user['gender'] == 2)
                                        <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                                        @else
                                        <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.$cmt->user['avatar'])}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                                        @endif
                                    @endif
                                    </a>
                                </div>
                                <div class="col-sm-4 col-xs-6" style="margin-left: -50px; margin-top: 5px;">
                                    <a href="{{ route('users.profile', $cmt->user['id']) }}"><strong>{{ $cmt->user['name'] }}</strong></a>
                                    <p><i>{{ $cmt->created_at }}</i></p>
                                </div>
                            </div>
                            <div>
                                <p><span class="glyphicon glyphicon-hand-right"></span> {{ $cmt->content }}</p>
                                <div class="row">
                                @if($cmt->picture != NULL)
                                @foreach(explode(',',$cmt->picture) as $picture)
                                    <div class="col-sm-5 col-xs-4">
                                        <img class="mr-3 img-responsive" src="{{asset('images/comments/'.$picture)}}" alt="Generic placeholder image" style="background: #dddddd; border-radius: 5%; border: 2px solid #a1a1a1; height: 150px; text-align: center; width: 230px;">
                                    </div>
                                @endforeach
                                @endif
                                </div>
                                <!-- Edit and delete comment -->
                                @if(Auth::user()->id == $cmt->user_id)
                                    <div class="row">
                                        <div class="col-sm-2 col-xs-3">
                                            <a href="#" data-toggle="modal" title="Sửa bình luận" data-target="#modalEditComment{{ $cmt->id }}" style="margin-left: 510px;"><span class="glyphicon glyphicon-pencil" style="font-size:15px; color:blue; margin-left: 0px;"></span></a>
                                        </div> 
                                        <div class="col-sm-10 col-xs-3">                                        
                                            <a href="{{ route('comments.delete', $cmt->id) }}" data-toggle="tooltip" title="Xóa bình luận"><span class="glyphicon glyphicon-remove-circle" style="font-size:15px; color:red; margin-left: 380px;"></span></a>
                                        </div>
                                    </div>
                                @endif
                                <!-- End edit and delete comment -->
                            </div>
                            <!-- Reply -->
                            <div class="row">
                            <form method="post" action="{{ route('comments.reply') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="col-sm-1 col-xs-3">
                                </div>
                                <div class="col-sm-2 col-xs-3">
                                    <a class="pr-3">
                                    @if(Auth::user()->avatar == NULL && Auth::user()->gender == 1)
                                    <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                    @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 2)
                                    <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                    @else
                                    <img type="hidden" class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                    @endif
                                    <!-- <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;"> -->
                                    </a>
                                </div>
                                <div class="col-sm-2 col-xs-3">
                                    <input type="hidden" value="{{ $cmt->id }}" name="parent_id">
                                    <input type="text" name="content" placeholder="Trả lời ... " style="margin-left: -70px; width:300px;">
                                </div>
                                <div class="col-sm-2 col-xs-3" style="margin-left:150px;margin-top:-10px;">
                                    <a href="#" data-toggle="modal" data-target="#picture_reply_{{ $cmt->id }}" ><span style="margin-top:10px; font-size: 25px;" class="glyphicon glyphicon-picture"></span></a>
                                    <a href="#" data-toggle="modal" data-target="#picture_reply_{{ $cmt->id }}" ><span style="margin-top:10px; font-size: 25px;" class="glyphicon glyphicon-camera"></span></a>
                                </div>
                                <div class="col-sm-2 col-xs-3">
                                    <button class="btn btn-primary" type="submit" style="margin-left:-40px;">Trả lời</button>
                                </div>
                                <!-- Modal post or catch picture-->
                                <div class="modal fade" id="picture_reply_{{ $cmt->id }}" role="dialog" style="margin-left: 100px;">
                                    <div class="modal-dialog">
                                    <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Trả lời bình luận </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="col-sm-12">                    
                                                        <div class="col-sm-8">
                                                        <center><p>Chụp ảnh ? <i>(nếu muốn)</i></p></center>
                                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#myModal" onclick="takePicture(this.value)" value="{{ $cmt->id }}">Take photo</a>
                                                        <div>
                                                            <canvas id="canvasReply{{ $cmt->id }}" width=320 height=240></canvas>
                                                        </div>
                                                        <input type="hidden" name="srcImage" id="srcImage"></intput>                                                    
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <br>
                                                            <center><p>Ảnh đính kèm <i>(nếu có)</i></p></center>
                                                            <br>
                                                            <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                                                            <input type="hidden" name="new_name_reply{{ $cmt->id }}" id="new_name_reply{{ $cmt->id }}" value="#">
                                                            <img id="picture_reply{{ $cmt->id }}" src="/images/forums/default_image.jpg" style="width:200px;" >
                                                            <input accept="image/*" id="{{ $cmt->id }}" name="file_reply{{ $cmt->id }}" title="thêm ảnh" type="file" onchange="displayReplyImage(this.id)">                            
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
                            </form>
                            </div>
                            <br>
                            <!-- End reply -->
                            <!-- show reply -->
                            @foreach($comments->sortByDesc('created_at') as $cmt_reply)
                            @if($cmt_reply->parent_id != NULL && $cmt_reply->parent_id == $cmt->id)
                            <div >
                                <div class="row">
                                    <div class="col-sm-1 col-xs-3">
                                    </div>
                                    <div class="col-sm-2 col-xs-3">
                                        <a class="pr-3">
                                        @if(Auth::user()->id == $cmt->user['id'])
                                            @if(Auth::user()->avatar == NULL && Auth::user()->gender == 1)
                                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                            @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 2)
                                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                            @else
                                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.Auth::user()->avatar)}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                            @endif
                                        <!--  -->
                                        @else
                                            @if($cmt->user['avatar'] == NULL && $cmt->user['gender'] == 1)
                                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_man.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                            @elseif($cmt->user['avatar'] == NULL && $cmt->user['gender'] == 2)
                                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/user_girl.png')}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                            @else
                                            <img class="mr-3 img-responsive" src="{{asset('images/avatars/'.$cmt->user['avatar'])}}" alt="Generic placeholder image" style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 30px; text-align: center; width: 30px;">
                                            @endif
                                        @endif
                                        </a>
                                    </div>
                                    <div class="col-sm-4 col-xs-6" style="margin-left: -70px; margin-top: 0px;font-size: 10px;">
                                        <a href="{{ route('users.profile', $cmt->user['id']) }}"><strong>{{ $cmt_reply->user['name'] }}</strong></a>
                                        <p><i>{{ $cmt_reply->created_at }}</i></p>
                                    </div>
                                </div>
                                <div>
                                    <p><span class="glyphicon glyphicon-hand-right" style="margin-left: 50px;"></span> {{ $cmt_reply->content }}</p>
                                    <div class="row" style="margin-left: 50px;">
                                    @if($cmt_reply->picture != NULL)
                                    @foreach(explode(',',$cmt_reply->picture) as $picture)
                                        <div class="col-sm-4 col-xs-4">
                                            <img class="mr-3 img-responsive" src="{{asset('images/comments/'.$picture)}}" alt="Generic placeholder image" style="background: #dddddd; border-radius: 5%; border: 2px solid #a1a1a1; height: 100px; text-align: center; width: 150px;">
                                        </div>
                                    @endforeach
                                    @endif
                                    </div>
                                    <!-- Edit and delete comment -->
                                    @if(Auth::user()->id == $cmt->user_id)
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-3">
                                                <a href="#" data-toggle="modal" title="Sửa bình luận" data-target="#modalEditReply{{ $cmt_reply->id }}" style="margin-left: 510px;"><span class="glyphicon glyphicon-pencil" style="font-size:15px; color:blue; margin-left: 0px;"></span></a>
                                            </div> 
                                            <div class="col-sm-10 col-xs-3">                                        
                                                <a href="{{ route('comments.delete', $cmt_reply->id) }}" data-toggle="tooltip" title="Xóa bình luận"><span class="glyphicon glyphicon-remove-circle" style="font-size:15px; color:red; margin-left: 380px;"></span></a>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- End edit and delete comment -->
                                </div>
                            </div>
                            <!-- Modal edit reply -->
                            <div id="modalEditReply{{ $cmt_reply->id }}" class="modal fade" role="dialog" style="margin-left: 100px;">
                                <div class="modal-dialog">
                                <!-- Modal content-->
                                    <form method="post" action="{{ route('comments.edit') }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Sửa bình luận</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" value="{{ $cmt_reply->id }}" name="comment_id">
                                            <input type="text" name="comment_content" value="{{ $cmt_reply->content }}"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>    
                            <!-- End modal edit reply -->
                            @endif
                            @endforeach
                            <!-- end show reply -->
                            <br>
                        @endif
                        <!-- Modal edit comment -->
                        <div id="modalEditComment{{ $cmt->id }}" class="modal fade" role="dialog" style="margin-left: 100px;">
                            <div class="modal-dialog">
                            <!-- Modal content-->
                                <form method="post" action="{{ route('comments.edit') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Sửa bình luận</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" value="{{ $cmt->id }}" name="comment_id">
                                        <input type="text" name="comment_content" value="{{ $cmt->content }}"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>    
                        <!-- End modal edit comment -->
                    @endforeach
                    </div>                                     
                </div>
                <!-- end bình luận -->
            </div>
            <!-- end Bài viết -->
        @endforeach
        </div>
    </div>
    <!-- Link right -->
    <div class="col-sm-2" style="background-color: #978ea7;">
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
<div class="modal fade" id="myModalMyPost" role="dialog" style="margin-left: 100px;">
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
<!-- Modal came computer -->
<div id="myModal" class="modal fade" role="dialog" style="margin-left: 100px;">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bạn có thể chụp ảnh</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <video id="player" autoplay width=320 height=240></video>
                <button id="capture">Capture</button>
                <!-- <canvas id="canvas" width=320 height=240></canvas> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
var check =  1;
$(document).ready(function(){
    $("#heart_1").on({
        click: function(){
            if(check == 2)
            {
                $(this).css("color", "red");
                check = 1;
            }
            else 
            {
                $(this).css("color", "blue");
                check = 2;
            }
        }
    });
});
</script>
@endsection
