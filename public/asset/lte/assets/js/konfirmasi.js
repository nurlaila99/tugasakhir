
    window.addEventListener('load', function () {
      let selectedDeviceId;
      const codeReader = new ZXing.BrowserMultiFormatReader()
      console.log('ZXing code reader initialized')
      codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
          const sourceSelect = document.getElementById('sourceSelect')
          selectedDeviceId = videoInputDevices[0].deviceId
          if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
              const sourceOption = document.createElement('option')
              sourceOption.text = element.label
              sourceOption.value = element.deviceId
              sourceSelect.appendChild(sourceOption)
            })

            sourceSelect.onchange = () => {
              selectedDeviceId = sourceSelect.value;
            };

            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
          }

          document.getElementById('startButton').addEventListener('click', () => {
            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
              if (result) {
                console.log(result)
                document.getElementById('result').textContent = result.text

                var id_toko = document.getElementById('result').innerHTML;
                console.log(id_toko);
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                  type: 'GET',
                  headers: {
                      'X-CSRF-TOKEN': token
                  },
                  url: '/Toko/req-nama-toko/' +id_toko,
                  dataType: 'json',
                  success: function(data){
                    $('#nama').html(data.data[0].nama_toko);
                    $('#lat1').html(data.data[0].latitude);
                    $('#lon1').html(data.data[0].longitude);
                    $('#acc1').html(data.data[0].accuracy);

                  }
                });
              }
              if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err)
                document.getElementById('result').textContent = err
              }
            })
            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
          })

          document.getElementById('resetButton').addEventListener('click', () => {
            codeReader.reset()
            document.getElementById('result').textContent = '';
            document.getElementById('nama').textContent = '';
            document.getElementById('lat1').textContent = '';
            document.getElementById('lon1').textContent = '';
            document.getElementById('acc1').textContent = '';

            console.log('Reset.')
          })

        })
        .catch((err) => {
          console.error(err)
        })
    })

    var lat = document.getElementById("lat2");
    var lon = document.getElementById("lon2");
    var acc = document.getElementById("acc2");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
      } else { 
        lat.innerHTML = "Geolocation is not supported by this browser.";
        lon.innerHTML = "Geolocation is not supported by this browser.";
        acc.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    var options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0
    };
        
    function showPosition(position) {
        lat.innerHTML=position.coords.latitude;
        lon.innerHTML=position.coords.longitude;
        acc.innerHTML=position.coords.accuracy;
    }

    function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
     var R = 6371; // Radius of the earth in km
     var dLat = deg2rad(lat2-lat1); // deg2rad below
     var dLon = deg2rad(lon2-lon1);
     var a =
     Math.sin(dLat/2) * Math.sin(dLat/2) +
     Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
     Math.sin(dLon/2) * Math.sin(dLon/2)
     ;
     var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
     var d = R * c; // Distance in km
     return d;
    }

    function deg2rad(deg) {
     return deg * (Math.PI/180)
    }


    function konfirmasi(){
      var lat1 = document.getElementById("lat1").innerHTML;
      var lon1 = document.getElementById("lon1").innerHTML;
      var acc1 = document.getElementById("acc1").innerHTML;
      var lat2 = document.getElementById("lat2").innerHTML;
      var lon2 = document.getElementById("lon2").innerHTML;
      var acc2 = document.getElementById("acc2").innerHTML;
      var jarak = getDistanceFromLatLonInKm(lat1,lon1,lat1,lon2);
      console.log(jarak);
      acc1 = parseInt(acc1);
      acc2 = parseInt(acc2);
      var rataAcc = (acc1+acc2)/2;
      console.log(rataAcc);
      if (jarak <= rataAcc)
        window.alert("Anda berada dalam toko");
      else
        window.alert("Anda tidak berada dalam toko");
    }