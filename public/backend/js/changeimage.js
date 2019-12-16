$(document).ready(function(){
    function readURL(input) {
        console.log('blabla');
        if (input.files && input.files[0]) {
            console.log('blabla');
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgChange").change(function(){
        console.log('balbaf');
        readURL(this);
    });

 });