function openCity(evt, cityName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); 
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " w3-red";
    }

// Update avatar
function reupAvatar() {
    var preview = document.getElementById('img_avatar'); //selects the query named img
    var file = document.querySelector('input[type=file]').files[0]; //sames as here
    var reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
    }
    if (file != null) {
        document.getElementById('new_name').value = file['name'];
        //alert(document.getElementById('new_name').value);
    }
    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
    } else {
        preview.src = "";
    }
}

// display post's picture
function displayPostImage() {
    var preview = document.getElementById('picture'); //selects the query named img
    var file = document.querySelector('input[name=post_image]').files[0]; //sames as here
    var reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
    }
    if (file != null) {
        document.getElementById('new_name').value = file['name'];
        //alert(document.getElementById('new_name').value);
    }
    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
    } else {
        preview.src = "";
    }
}

// display comment's picture
function displayCommentImage(clicked_id) {
    // alert(clicked_id);
    var preview = document.getElementById('picture_comment'+clicked_id); //selects the query named img
    var file = document.querySelector("input[name=file_comment"+ clicked_id +"]").files[0]; //sames as here
    // alert(file);
    var reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
    }
    if (file != null) {
        document.getElementById('new_name_comment'+clicked_id).value = file['name'];
        //alert(document.getElementById('new_name').value);
    }
    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
    } else {
        preview.src = "";
    }
}

// Lấy ảnh từ cam máy tính.
function takePicture(clicked_value){
    //alert(clicked_value);
    if(clicked_value == 'comment'){
        var player = document.getElementById('player');
        var canvas = document.getElementById('canvasComment');
        var context = canvas.getContext('2d');
        var captureButton = document.getElementById('capture');
        var constraints = {
            video: true,
        };
        captureButton.addEventListener('click', () => {
            // Draw the video frame to the canvas.
            context.drawImage(player, 0, 0, canvas.width, canvas.height);
            var img = new Image();
            img.src = canvas.toDataURL("image/jpeg");

            var xyz = document.getElementsByName("srcImage"); 
            for(i = 0; i < xyz.length; i++ )
                xyz[i].value = img.src;
            //alert(img.src);
        });
        // Attach the video stream to the video element and autoplay.
        navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
            player.srcObject = stream;
        });
    }else{
        var player = document.getElementById('player');
        var canvas = document.getElementById('canvasReply'+clicked_value);
        //alert(canvas);
        var context = canvas.getContext('2d');
        var captureButton = document.getElementById('capture');
        var constraints = {
            video: true,
        };
        captureButton.addEventListener('click', () => {
            // Draw the video frame to the canvas.
            context.drawImage(player, 0, 0, canvas.width, canvas.height);
            var img = new Image();
            img.src = canvas.toDataURL("image/jpeg");
            
            var xyz = document.getElementsByName("srcImage"); 
            for(i = 0; i < xyz.length; i++ )
                xyz[i].value = img.src;
        });
        // Attach the video stream to the video element and autoplay.
        navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
            player.srcObject = stream;
        });
    }
};
