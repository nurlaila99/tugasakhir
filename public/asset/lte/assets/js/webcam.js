Webcam.set({
    width: 350,
    height: 240,
    image_format: 'png',
    jpeg_quality: 90
  })

  function btn_ambilFoto(){
    Webcam.attach("#kamera")
  }

  function take_snapshot(){
    Webcam.snap(function (data_uri){
      document.getElementById('results').innerHTML =
      '<img id="hasil" src="'+data_uri+'"/>';
    });

    var hasil = $('#hasil').attr('src');
    $('#save').click(function(){
      $('#img').attr('src', hasil);
      $('#foto').val(hasil);
    });
  }