

<script
src="/assets/js/jquery-3.2.0.min.js">
</script>





<script type="text/javascript">
$(document).ready(function(){
  $('#selectlogement').change(function()
  {

    $.ajax({
      url: './fct/fetch_tarifs.php',                  //the script to call to get data
      type : 'GET',
      data: "lid=" + $(this).val(),                        //you can insert url argumnets here to pass to api.php
      //for example "id=5&parent=6"
      dataType: 'json',                //data format
      success: function(data)          //on recieve of reply
      {
        var loyer = data[0];
        var provision = data[1];
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
        $('#loyer').val(loyer); //Set output element
        $('#provision').val(provision); //Set output element
      }
    });


    });
  });

</script>



<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
