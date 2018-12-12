$('#input-file').change(function () {
  var input = $(this)[0];
  if (input.files && input.files[0]) {
    if(input.files[0].type.match('image')) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img-preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
    else {
      console.log('Что-то не так!');
    }
  }
  else {
    console.log('Ошибка');
  }
});

$('#post_form').bind('reset', function () {
  $('#img-preview').attr('src','/post/no-photo.png');

});