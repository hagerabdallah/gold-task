@extends('dashboard.admin.layout')
@section('content')
                         

                      
  {{-- fetch data table --}}
  <div class="right_col" role="main">
    <div class="">
      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input id="keyword" type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
            </span>
          </div>
        </div>
      </div>
      <div>
        <button type="button" value="" class="btn btn-primary createbtn btn-sm">Create</button>
          </div> 
        <div class="row" style="display: block;">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th class="column-title"> Safe Type</th>
                <th class="column-title">Action</th>
              </tr>
            </thead>

            <tbody id="all">

            </tbody>
          </table>
        </div>
                
            
      </div>
    </div>
  </div>
        </div>
    </div>
</div>

{{-- end fetch data table --}}

{{-- create Modal --}}
<div class="modal fade" id="addbartype" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="AddStudentModalLabel">Add safetype Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="storesafetype" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
              @csrf
          <div class="modal-body">

              <ul id="save_msgList"></ul>
              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

              <div class="form-group mb-3">
                  <label for="">Types</label>
                  <input type="text" required class="types form-control" name="types" id="types">
              </div>
          </div><div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              <button type="submit" class="btn btn-primary add_country">Save</button>
          </div>
          </form>
          

      </div>
  </div>
</div>

{{-- end create Modal --}}

{{-- edit Modal --}}
<div class="modal fade" id="editsafetype" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="AddStudentModalLabel">update safe type Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="updatesafetybe" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
              @csrf
          <div class="modal-body">

              <ul id="save_msgList"></ul>
              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="id" id="safetype_id"> 

              <div class="form-group mb-3">
                  <label for="">types</label>
                  <input type="text" required class="safetype form-control" name="safetype" id="safetype">
              </div>
          </div><div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              <button type="submit" class="btn btn-primary add_country">Save</button>
          </div>
          </form>
          

      </div>
  </div>
</div>

{{-- end edit Modal --}}

    
@endsection
@section('script')
  <script>
    $(document).ready(function(){
      fetchsafetype();
        ///////////////fetch data//////////////////
        function fetchsafetype(){
            $.ajax({
                type: "GET",
                url: "fetch-safetype",
                dataType: "json",
                success: function (response) {
                    // console.log(response.countries);
                    $('tbody').html("");
                    $.each(response.safetype, function (key, item) {
                        $('tbody').append(
                            '<tr>\
                            <td>' + item.types + '</td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button>\
                            <button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                        

                    });
              
              
                }


            });
        }

      
      ////////////////////////////end fetch data/////////////////////
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            ////////////////////// show create form/////////////////
$(document).on('click','.createbtn',function(e)
{
e.preventDefault();
$('#addbartype').modal('show');

});

////////////////////// end show create form/////////////////
////////////////////// store country/////////////////

$(document).on('submit', '#storesafetype', function (e) {
            e.preventDefault();
            var xhr = new XMLHttpRequest(),
            method = "POST",
    url="safetype/store";

xhr.open(method, url, true);
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE) {
    var status = xhr.status;
    if (status === 0 || (status >= 200 && status < 400)) {
    //   The request has been completed successfully
      console.log(xhr.responseText);
    } 
}};
                    
            var data = {
                "_token": "{{ csrf_token() }}",

                'types': $('#types').val(),
                
            }

            $.ajax({
                type: "POST",
                url: "safetype/store",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 400) {
                        alert(response.errors);

                    } else {
                        $('#addbartype').modal('hide');
                        alert(response.message);  
                        fetchsafetype();
                    }
                },
                error: function (xhr) {
        console.log(xhr.responseText);
    }
   
            });

        });

//////////////////////  end store country/////////////////
//////////////////////  end store country/////////////////

$(document).on('click','.editbtn',function(e)
{
e.preventDefault();
var id=$(this).val();

$('#editsafetype').modal('show');

$.ajax({
    type:"GET",
   
   url:"safetype/edit/"+id,
    
   success: function (response)

   {
    // console.log(response.status);

     if(response.status==404)
     {
       alert(response.errors);
       $('#editsafetype').modal('hide');
     }
     else
     {
        $('#safetype_id').val(response.safetype.id);

       $('#safetype').val(response.safetype.types);
    
     }

}

});
});
//////////////////////////end edit/////////////////
///////////////////////update/////////////

$(document).on('submit','#updatesafetybe',function(e)
{
e.preventDefault();
var safetype_id=$('#safetype_id').val();
// console.log(country_id);

var xhr = new XMLHttpRequest(),
    method = "POST",
    url="safetype/update/"+safetype_id;


xhr.open(method, url, true);
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE) {
    var status = xhr.status;
    if (status === 0 || (status >= 200 && status < 400)) {
      // The request has been completed successfully
      console.log(xhr.responseText);
    } 
}};
       
var data = {
                "_token": "{{ csrf_token() }}",

                'types': $('#safetype').val(),}
                
$.ajax(
  {
  
   type:"POST",

  url:"safetype/update/"+safetype_id,
  data:data,
  dataType: "json",
  

  success: function (response){
  
  if (response.status==404)
  {
   
    alert(response.errors);
       $('#updatesafetybe').modal('hide');
  }
  else
  {
 $('#updatesafetybe').modal('hide');
 alert(response.message);
 $('#editsafetype').modal('hide');

 fetchsafetype();

  }
  
  },
error: function (xhr) {
        console.log(xhr.responseText);
    }



});
});
  
///////////////////////////////end update////////////////////
$(document).on('click', '.deletebtn', function (e) {

e.preventDefault();

var id = $(this).val();
var xhr = new XMLHttpRequest(),

 method = "get",
  url="safetype/delete/"+ id;


xhr.open(method, url, true);
xhr.onreadystatechange = function () {
if(xhr.readyState === XMLHttpRequest.DONE) {
var status = xhr.status;
if (status === 0 || (status >= 200 && status < 400)) {
// The request has been completed successfully
console.log(xhr.responseText);
} 
}};
$.ajax({
    type: "get",
    url: "safetype/delete/"+ id,
    dataType: "json",
    success: function (response) {
   console.log(response.status);
      if (response.status == 404) {

                alert(response.errors);

        } else {
          
          fetchsafetype();
        }
        },
error: function (xhr) {
console.log(xhr.responseText);
}
  });
});
 //////////////////////////////////////// end delete//////////////////////////

$('#keyword').keyup(function()
{
    let keyword=$(this).val()
   let url ="{{route('admin.safetybe.search')}}"+"?keyword="+keyword
    console.log(url);
   
    $.ajax(
        {
            type:"GET",
            url:url,
            contentType:false,
            processData:false,
            success: function ( data)
             {
                $('#all').empty()
     
                for (safetype of data){

                    $('tbody').append(
               
                    `
                   <tr>
                    <td>${safetype.types}</td>
                    <td><button type="button" value="` + safetype.id + `" class="btn btn-primary editbtn btn-sm">Edit</button>\
                            <button type="button" value="` + safetype.id + `" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                   
                
               </tr>
    

                    `

                )

            } 
          }
        });
        });
        ///////////////////end search/////////////////



});







      </script>
      @endsection
