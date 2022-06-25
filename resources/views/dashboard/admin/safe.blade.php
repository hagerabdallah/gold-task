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
                <th class="column-title"> Safe name</th>
                <th class="column-title"> countryName</th>
                <th class="column-title"> safe type</th>
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
<div class="modal fade" id="addsafe" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Add safe Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storesafe" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="modal-body">
  
                <ul id="save_msgList"></ul>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <ul class="alert alert-danger d-none" id="updateerrors"></ul>
                <div class="form-group mb-3">
                    <label for="">safe name</label>
                    <input type="text" required class="name form-control" name="name" id="name">
                </div>
                <div class="form-group mb-3">
                    <label for="">safe type</label>
                    {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                    <select class="form-control safetype_id" name='safetype_id' id="safetype_id" >
                        @foreach ($safetybes as $safetybe)
                        <option  value="{{$safetybe->id}}" >{{$safetybe->types}}</option> 
                        @endforeach
                        
                      </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">country</label>
                    {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                    <select class="form-control country_id" name='country_id'  id="country_id" >
                        @foreach ($countries as $country)
                        <option  value="{{$country->id}}" >{{$country->CountryName}}</option> 
                        @endforeach
                        
                      </select>
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
<div class="modal fade" id="editsafe" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">update safe Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatesafe" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="modal-body">
                 
                <ul id="save_msgList"></ul>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id"> 
                <ul class="alert alert-danger d-none" id="updateerror"></ul>

                <div class="form-group mb-3">
                    <label for="">safe name</label>
                    <input type="text" required class="name form-control" name="name" id="name1">
                </div>
                <div class="form-group mb-3">
                    <label for="">safe type</label>
                    {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                    <select class="form-control safetype_id" name='safetype_id' id="safetype_id1" >
                        @foreach ($safetybes as $safetybe)
                        <option  value="{{$safetybe->id}}" >{{$safetybe->types}}</option> 
                        @endforeach
                        
                      </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">country</label>
                    {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                    <select class="form-control country_id" name='country_id'  id="country_id1" >
                        @foreach ($countries as $country)
                        <option  value="{{$country->id}}" >{{$country->CountryName}}</option> 
                        @endforeach
                        
                      </select>
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
    fetchsafe();
      ///////////////fetch data//////////////////
      function fetchsafe(){
            var xhr = new XMLHttpRequest(),
            method = "GET",
    url="fetch-safe";

xhr.open(method, url, true);
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE) {
    var status = xhr.status;
    if (status === 0 || (status >= 200 && status < 400)) {
    //   The request has been completed successfully
      console.log(xhr.responseText);
    } 
}};
          $.ajax({
              type: "GET",
              url: "fetch-safe",
              dataType: "json",
              success: function (response) {
                  // console.log(response.countries);
                  if(response.status == 500){
                    alert(response.errors);
                //   console.log(response.errors);

                  }else{
                    $('tbody').html("");
                  $.each(response.safe, function (key, item) {
                      $('tbody').append(
                          '<tr>\
                          <td>' + item.name + '</td>\
                          <td>' + item.country.CountryName + '</td>\
                          <td>' + item.safetype.types + '</td>\
                          <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button>\
                          <button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                      \</tr>');
                      

                  });
                  }
                
            
            
              },
                error: function (xhr) {
        console.log(xhr.responseText);
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
$('#addsafe').modal('show');

});
////////////////////// end show create form/////////////////
////////////////////// store country/////////////////

$(document).on('submit', '#storesafe', function (e) {
            e.preventDefault();
            var xhr = new XMLHttpRequest(),
            method = "POST",
    url="safes/store";

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
                'name': $('.name').val(),
                'safetype_id': $('.safetype_id').val(),
                'country_id': $('.country_id').val(),
            }
            console.log(data);
            // let edit =new FormData($('#storesafe')[0]);         


            $.ajax({
                type: "POST",
                url: "safes/store",
                data: data,
                dataType: "json",
            //     contentType:false,
            //   processData:false,
                success: function (response) {
                    if (response.status == 400) {
                      $('#updateerrors').html("");
    $('#updateerrors').removeClass('d-none');
    $.each(response.errors,function(key,err_value)
    {   
      $('#updateerrors').append(`<li>`+err_value+`</li>`);
    })           
    
                    } else if(response.status == 404) {
                        alert(response.errors);

                    }
                    
                    else {
                        $('#addsafe').modal('hide');
                        alert(response.message); 
                        // console.log(response.message);

                        fetchsafe();
                    }
                },
                error: function (xhr) {
        console.log(xhr.responseText);
    }
   
            });

        });

//////////////////////  end store country/////////////////

$(document).on('click','.editbtn',function(e)
{
e.preventDefault();
var id=$(this).val();

$('#editsafe').modal('show');

$.ajax({
    type:"GET",
   
   url:"safes/edit/"+id,
    
   success: function (response)

   {
    // console.log(response.status);

     if(response.status==404)
     {
       alert(response.errors);
       $('#editsafe').modal('hide');
     }
     else
     {
        // console.log(response.safes);
        $('#id').val(response.safes.id);
        $('#name1').val(response.safes.name);
       $('#country_id1').val(response.safes.country_id);
       $('#safetype_id1').val(response.safes.safetype_id);

    // alert(response.message);

     }

}

});
});
//////////////////////////end edit/////////////////

$(document).on('submit','#updatesafe',function(e)
{
e.preventDefault();
var id_safe=$('#id').val();
// console.log(id_safe);

var xhr = new XMLHttpRequest(),
    method = "POST",
    url="safes/update/"+id_safe;
// console.log(country_id);

xhr.open(method, url, true);
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE) {
    var status = xhr.status;
    if (status === 0 || (status >= 200 && status < 400)) {
      // The request has been completed successfully
      console.log(xhr.responseText);
    } 
}};
       
var datax = {
                "_token": "{{ csrf_token() }}",
                'name': $('#name1').val(),
                'safetype_id': $('#safetype_id1').val(),
                'country_id': $('#country_id1').val(),            
            
            }

                
$.ajax(
  {
  
   type:"POST",
//    url:"{{url('safes/update')}}/" + safe_id,
url:"safes/update/"+id_safe,
  data:datax,
  dataType: "json",
  

  success: function (response){
  
  if (response.status==404)
  {
    $('#updateerror').removeClass('d-none');
    $.each(response.errors,function(key,err_value)
    {   
      $('#updateerror').append(`<li>`+err_value+`</li>`);
    })   
  }
  else
  {
 $('#updatesafe').modal('hide');
 alert(response.message);
 
 fetchsafe();

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
  url="safes/delete/"+ id;


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
    url: "safes/delete/"+ id,
    dataType: "json",
    success: function (response) {
   console.log(response.status);
      if (response.status == 404) {

                alert(response.errors);

        } else {
          alert(response.message);

          fetchsafe();
        }
        },
error: function (xhr) {
console.log(xhr.responseText);
}
  });
});

    ////////////////////end delete///////////////////
    $('#keyword').keyup(function()
{
    let keyword=$(this).val()
   let url ="{{route('admin.safes.search')}}"+"?keyword="+keyword
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
     
                for (safe of data){

                    $('tbody').append(
               
                    `
                   <tr>
                    <td>${safe.name}</td>
                    <td>${safe.country.CountryName}</td>
                    <td>${safe.safetype.types}</td>
                    <td><button type="button" value="` + safe.id + `" class="btn btn-primary editbtn btn-sm">Edit</button>\
                            <button type="button" value="` + safe.id + `" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                   
                
               </tr>
    

                    `

                )

            } 
          }
        });
        });

            /////////////////end search//////////////////






























});

</script>
@endsection