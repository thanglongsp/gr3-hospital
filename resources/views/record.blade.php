@extends('layouts.master')
@include('layouts.header')
@section('content')
<div style="margin-top: 100px;">
    @foreach($records as $record)
    <div class="row" style="text-align: center;">
        <div class="col-sm-2"></div>
        <div class="col-sm-8" style="background-color: antiquewhite">
            <br>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="/w3images/lights.jpg">
                        <img src="images/avatars/{{ $record->avatar }}"
                             style="background: #F0FFFF; border-radius: 50%; border: 2px solid #1E90FF; height: 50px; text-align: center; width: 50px;">
                        <div class="caption">
                            <p>{{ $record->full_name }}</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-9" style="margin-top: 6px;">
                <div class="col-sm-4">{{ $record->created_at }}</div>
                <div class="col-sm-4">{{ $record->mota }}</div>
                @if($record->status == 1)
                <div class="col-sm-2"><a data-toggle="modal"
                                         data-target="#{{ $record->recordId }}">Chi tiết</a></div>
                <div class="col-sm-2"><a data-toggle="modal"
                                         data-target="#note{{ $record->recordId }}">Ghi chú</a></div>
                <!-- modal ghi chú -->
                <div class="modal fade" id="note{{ $record->recordId }}" role="dialog"
                     style="margin-left: 0px;">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Ghi chú</h4>
                            </div>
                            <br>
                            <div class="row">
                                <form method="post" action="{{ route('note') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="col-sm-10">
                                    <input type="hidden" value="{{ $record->recordId }}" name="recordId"/>
                                    <textarea rows="4" cols="100" name="note"></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary">Ghi chú</button>
                                </div>
                                </form>
                            </div>
                            <br>
                            <div style=" text-align: left;">
                                <p style="color: dodgerblue;"><span class="glyphicon glyphicon-star-empty"><strong> Note :</strong></span></p>
                                @foreach(explode('|',$record->note) as $note)
                                <div class="col-sm-1"></div>
                                <p>{{ $note }}</p>
                                @endforeach
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal chi tiết-->
                <div class="modal fade" id="{{ $record->recordId }}" role="dialog"
                     style="margin-left: 0px;">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ $record->mota }}</h4>
                            </div>
                            <embed src="/records/{{ $record->recordName }}.pdf" type="application/pdf"
                                   style="width:100%; height:600px;"
                                   frameborder="0">
                            <div class="modal-body">
                                <div class="card">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($record->status == 0 )
                <input type="hidden" value="{{ $check = 0 }}"/>
                    @foreach($reqs as $req)
                        @if($req->recordId == $record->recordId)
                        <input type="hidden" value="{{ $check = 1 }}"/>
                        @endif
                    @endforeach
                        @if($check == 1)
                        <div class="col-sm-4"><p>Đã gửi yêu cầu chia sẻ</p></div>
                        @else
                        <div class="col-sm-4"><a href="{{ route('reqShare', $record->recordId) }}">Yêu cầu chia sẻ</a></div>
                        @endif
                @endif
            </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
<center>{{ $records->links() }}</center>
</div>
</div>

<script>
    function confirm() {
        var reason = prompt("Nhập khóa bảo mật của hồ sơ : ");
    }
</script>
