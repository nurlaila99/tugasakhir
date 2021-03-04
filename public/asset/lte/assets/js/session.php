<!-- Modal
Nama    : Nur Laila Rahmadani
NIM     : 151811513007
 -->


<!-- Modal -->

<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" class="modal fade text-left" style="display: none;" aria-hidden="true">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p>Sesi akan berakhir, apakah anda ingin memperpanjang sesi?</p>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" onclick="stop()" class="btn btn-secondary">No</button>
          <button type="button" data-dismiss="modal" onclick="reload()" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
    <script type="text/javascript">
        var idleTime = 0;
        $(document).ready(function () {
            //Increment the idle time counter every minute.
            var idleInterval = setInterval(timerIncrement, 1000); // 1 second

            //Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                idleTime = 0;
            });
            $(this).keypress(function (e) {
                idleTime = 0;
            });
        });

        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 1799) { // 30 minutes
                $('#myModal').modal('show');
                if (idleTime > 1809){
                    $('#myModal').modal('hide');
                    window.alert("Waktu sesi anda telah habis");
                }
            }
        }

        function reload(){
            window.location.reload();
        }

        function stop(){
            $('#myModal').modal('hide');
            window.alert("Waktu sesi anda telah habis");
        }

    </script>