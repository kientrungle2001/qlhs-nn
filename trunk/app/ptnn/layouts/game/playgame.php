<strong><center>Chọn các từ phù hợp miêu tả đúng với bức tranh dưới đây:<strong><br>

<canvas id="rainword" onclick="alert(     Ban vua nhap len canvas )" width=890" height="800" style="float:left; border: 1px solid red;"></canvas>
<script>

window.onload = function(){ 
    var canvas = document.getElementById("rainword"); 
    var context = canvas.getContext("2d"); 
    var destX = 0; 
    var destY = 0; 
    var imageObj = new Image(); 
    imageObj.onload = function(){ 
        context.drawImage(imageObj, destX, destY); 
    }; 
    imageObj.src = "/3rdparty/uploads/images/b6530a254ba4a1b82575f9ed7e3000a7.jpg"; 
};
</script>