@extends('layouts.app')
 @section('styles')
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

 @endsection
@section('content')
<!--   code chnage into master branch  -->
<div class="container">
	<div class="col-md-12">
    <div  style="width: 400px;">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."  class="form-control" title="Type in a name">
  </div>
<table id="myTable" class="table table-striped table-bordered" style="width:50%">
        <thead>
            <tr>
                <th>FunctionName</th>
                <!-- <th>TimeOut</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    @php
            $i = 0;
        @endphp
        @foreach ($students as $student)

            <tr>   
                <td >{{$student->FunctionName}}</td>  
                <!-- <td>{{$student->Timeout}}</td>  -->
                <td> <button type="button" class=" btn btn-success" onclick="invokeNow('{{$student->FunctionName}}','{{$student->Timeout}}')">Run Now</button>  
                </td>
            </tr> 
 @endforeach
    <div class="loading" style="display:none;">
  <img src="img-svg/Loading_2.gif">
   
 </div>

        </tbody> 
    </table>
    
</div> 
</div> 
<div class="modal" tabindex="-1" role="dialog" id="showModal">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title">Invoke Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         
          <span aria-hidden="true">&times;</span>


        </button>
      </div>
      <div class="modal-body">
               

        <p class="text-success">Function is Invoke Successfully!</p>
      </div>
    </div>
  </div>
</div>
@endsection
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

<script>

// $('#loading-image').show()
  function invokeNow(functionName,Timeout)
      { 
      	
      	alert(Timeout);
 $(".loading").show();
 
      	$.ajax({    
            
          'url':"http://dev.perimattic.com/namrata/oauth/public/amazon-lamda/invoke-aws-lambda.php",
          'type':"GET", 
          'data':{'functionName':functionName},
          success:function(data)
          {  

           /* var url = window.location.href;    
            if (url.indexOf('?') > -1){
               url += '&mode=1'
            }else{
               url += '?mode=4'
            } 
            window.location.href = url;*/
            if(data=="Success")
            {   
         
          // setTimeout(function () { test(); }, Timeout);
           $('.loading').hide();
            console.log(data);    
            	$("#showModal").modal();
             	//alert('ddd');   

            }
          }
          

        }); 

      } 

</script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

@section('javascripts')




@endsection
