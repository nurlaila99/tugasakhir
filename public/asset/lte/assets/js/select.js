
jQuery(document).ready(function ()
{
        jQuery('select[name="provinsi"]').on('change',function(){
           var countryID = jQuery(this).val();
           if(countryID)
           {
              jQuery.ajax({
                 url : '../customer/tambah1/getstates/' +countryID,
                 type : "GET",
                 dataType : "json",
                 success:function(data)
                 {
                    console.log(data);
                    jQuery('select[name="kota"]').empty();
                    jQuery.each(data, function(key,value){
                       $('select[name="kota"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                 }
              });
           }
           else
           {
              $('select[name="kota"]').empty();
           }
        });
});
jQuery(document).ready(function ()
{
        jQuery('select[name="kota"]').on('change',function(){
           var id_kota = jQuery(this).val();
           if(id_kota)
           {
              jQuery.ajax({
                 url : '../customer/tambah1/kecamatan/' +id_kota,
                 type : "GET",
                 dataType : "json",
                 success:function(data)
                 {
                    console.log(data);
                    jQuery('select[name="kecamatan"]').empty();
                    jQuery.each(data, function(key,value){
                       $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                 }
              });
           }
           else
           {
              $('select[name="kecamatan"]').empty();
           }
        });
});
jQuery(document).ready(function ()
{
        jQuery('select[name="kecamatan"]').on('change',function(){
           var id_kec = jQuery(this).val();
           if(id_kec)
           {
              jQuery.ajax({
                 url : '../customer/tambah1/kelurahan/' +id_kec,
                 type : "GET",
                 dataType : "json",
                 success:function(data)
                 {
                    console.log(data);
                    jQuery('select[name="kelurahan"]').empty();
                    jQuery.each(data, function(key,value){
                       $('select[name="kelurahan"]').append('<option value="'+ value.ID_KELURAHAN +'">'+ value.KODEPOS +' - ' + value.NAMA_KELURAHAN +'</option>');
                    });
                 }
              });
           }
           else
           {
              $('select[name="kelurahan"]').empty();
           }
        });
});