<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hospital</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body> 
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
                    <p>Chọn thời gian</p>
                </div>
                <input class="input" type="date"  >
            </div>
        </div>
        <div  class="col-sm-8">
            <div class="myDivResult">
                <center>
                    <p>Result</p>
                </center>
            </div>
        </div>
    </div>
</body>
</html>