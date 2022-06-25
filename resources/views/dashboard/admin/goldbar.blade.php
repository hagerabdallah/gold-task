@extends('dashboard.admin.layout')
@section('content')

  {{-- fetch data table --}}
  <div class="right_col" role="main">
    <div class="">
      <div class="title_right ">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input id="keyword" type="text" class="form-control " placeholder="Search for...">
            <span class="input-group-btn">
            </span>
          </div>
        </div>
      </div>
      <div>
        <button type="button" value="" class="btn btn-primary createbtn btn-sm ">Create</button>
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
                <th class="column-title"> SerialNumber</th>
                <th class="column-title"> weight</th>
                <th class="column-title"> SafeType</th>
                <th class="column-title"> safeName</th>
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
                <h5 class="modal-title" id="AddStudentModalLabel">Add gold bar Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storesafe" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="modal-body">
  
                <ul id="save_msgList"></ul>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <ul class="alert alert-danger d-none" id="updateerrors"></ul>

                <div class="form-group mb-3">
                    <label for="">srial number</label>
                    <input type="text" required class="name form-control" name="name" id="name">
                </div>
                <div class="form-group mb-3">
                    <label for="">weight</label>
                    {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                     <select class="form-control country_id" name="weight"  id="country_id" >
                        @foreach ($weights as $weight)
                        <option  value="{{$weight->id}}" >{{$weight->weight}}</option> 
                        @endforeach
                        
                      </select>
                </div> 

                <div class="form-group mb-3">
                    <label for="">safe type</label>

                    <select class="form-control safetype_id" name='safetype_id' id="safetype_id" >
                        @foreach ($safetypes as $safetybe)
                        <option  value="{{$safetybe->id}}" >{{$safetybe->types}}</option> 
                        @endforeach
                        
                      </select>
                </div>
                <span>safe name</span>
	<select   class="safename form-control" name="safename" id="safe_name">

		<option value="0" disabled="true" selected="true">safe Name</option>
	</select>

            </div><div class="modal-footer">
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
              <h5 class="modal-title" id="AddStudentModalLabel">update gold Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="updatesafe" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
              @csrf
          <div class="modal-body">

              <ul id="save_msgList"></ul>
              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="id" id="id1"> 
{{-- 
              <div class="form-group mb-3">
                  <label for="">safe name</label>
                  <input type="text" required class="name form-control" name="name" id="name1">
              </div> --}}
              {{-- <div class="form-group mb-3">
                  <label for="">safe type</label>
                  <input type="text" required class="safename form-control" name="safename" id="safe_name">

                  <select class="form-control safetype_id" name='safetype_id' id="safetype_id1" >
                      @foreach ($safetybes as $safetybe)
                      <option  value="{{$safetybe->id}}" >{{$safetybe->types}}</option> 
                      @endforeach
                      
                    </select>
              </div> --}}
              {{-- <div class="form-group mb-3">
                  <label for="">country</label>
                  <input type="text" required class="safename form-control" name="safename" id="safe_name">

                  <select class="form-control country_id" name='country_id'  id="country_id1" >
                      @foreach ($countries as $country)
                      <option  value="{{$country->id}}" >{{$country->CountryName}}</option> 
                      @endforeach
                      
                    </select>
              </div> --}}

              <ul class="alert alert-danger d-none" id="updateerror"></ul>

              <div class="form-group mb-3">
                <label for="">srial number</label>
                <input type="text" required class="name form-control" name="name" id="name1">
            </div>
            <div class="form-group mb-3">
                <label for="">weight</label>
                {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                 <select class="form-control country_id" name="weight"  id="country_id1" >
                    @foreach ($weights as $weight)
                    <option  value="{{$weight->id}}" >{{$weight->weight}}</option> 
                    @endforeach
                    
                  </select>
            </div> 

            <div class="form-group mb-3">
                <label for="">safe type</label>
                {{-- <input type="text" required class="safename form-control" name="safename" id="safe_name"> --}}

                <select class="form-control safetype_id" name='safetype_id' id="safetype_id1" >
                    @foreach ($safetypes as $safetybe)
                    <option  value="{{$safetybe->id}}" >{{$safetybe->types}}</option> 
                    @endforeach
                    
                  </select>
            </div>
            <span>safe name</span>
<select   class="safename form-control" name="safename" id="safe_name1">

<option value="0" disabled="true" selected="true">safe Name</option>
</select>
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

 src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"


    fetchgoldbar();
      ///////////////fetch data//////////////////
      function fetchgoldbar(){
            var xhr = new XMLHttpRequest(),
            method = "GET",
    url="fetch-goldbar";

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
              url: "fetch-goldbar",
              dataType: "json",
              success: function (response) {
                  // console.log(response.countries);
                  if(response.status == 500){
                    alert(response.errors);
                //   console.log(response.errors);

                  }else{
                    $('tbody').html("");
                  $.each(response.goldbar, function (key, item) {
                      $('tbody').append(
                          '<tr>\
                          <td>' + item.SerialNumber + '</td>\
                          <td>' + item.weight.weight + '</td>\
                          <td>' + item.safetype.types + '</td>\
                          <td>' + item.safe.name + '</td>\
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
////////////////////////////////////////////////////
$(document).on('change','.safetype_id',function(){
			// console.log("hmm its change");

			var safetype_id=$(this).val();
			// console.log(cat_id);
			var div=$(this).parent();

			var option=" ";
           

			$.ajax({
				type:'get',
                url: "catchsafe",

				data:{'id':safetype_id},
                // data:data,

				success:function(data){
					//console.log('success');

					// console.log(data);

					//console.log(data.length);
					option+='<option value="0" selected disabled>choose safe</option>';
					for(var i=0;i<data.length;i++){
                        option+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				   }

				   $('.safename').html(" ");
				   $('.safename').append(option);
				},
				error:function(){

				}
			});
		});
    ///////////////////////////end catch//////////////////
////////////////////// store goldbar/////////////////

$(document).on('submit', '#storesafe', function (e) {
            e.preventDefault();
            var xhr = new XMLHttpRequest(),
            method = "POST",
    url="goldbar/store";

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
                'name': $('#name').val(),
                'weight': $('#country_id').val(),
                'safetype_id': $('#safetype_id').val(),
                'safename': $('#safe_name').val(),

            }
            console.log(data);
            // let edit =new FormData($('#storesafe')[0]);         


            $.ajax({
                type: "POST",
                url: "goldbar/store",
                data: data,
                dataType: "json",
            //     contentType:false,
            //   processData:false,
                success: function (response) {
                    if (response.status == 400) {
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

                        fetchgoldbar();
                    }
                },
                error: function (xhr) {
        console.log(xhr.responseText);
    }
   
            });

        });

///////////////////////end gold bar///////////////////////
$(document).on('click','.editbtn',function(e)
{
e.preventDefault();
var id=$(this).val();

$('#editsafe').modal('show');

$.ajax({
    type:"GET",
   
   url:"goldbar/edit/"+id,
    
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
        $('#id1').val(response.goldbar.id);
        $('#name1').val(response.goldbar.SerialNumber);
       $('#country_id1').val(response.goldbar.weight_id);
       $('#safetype_id1').val(response.goldbar.safetype_id);
       $('#safe_name1').val(response.goldbar.safe_id);


    // alert(response.message);
}
   }
});
});
////////////////////////////////////////////////end edit/////////////////////
$(document).on('submit','#updatesafe',function(e)
{
e.preventDefault();
var id_safe=$('#id1').val();
// console.log(id_safe);

var xhr = new XMLHttpRequest(),
    method = "POST",
    url="goldbar/update/"+id_safe;
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
       

            var data = {
                "_token": "{{ csrf_token() }}",
                'id': $('#id1').val(),
                'name': $('#name1').val(),
                'weight': $('#country_id1').val(),
                'safetype_id': $('#safetype_id1').val(),
                'safename': $('#safe_name1').val(),

            }

                
$.ajax(
  {
  
   type:"POST",
//    url:"{{url('safes/update')}}/" + safe_id,
url:"goldbar/update/"+id_safe,
  data:data,
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
    $('#editsafe').modal('hide');
 alert(response.message);
 fetchgoldbar();

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
  url="goldbar/delete/"+ id;


xhr.open(method, url, true);
xhr.onreadystatechange = function () {
if(xhr.readyState === XMLHttpRequest.DONE) {
var status = xhr.status;
if (status === 0 || (status >= 200 && status < 400)) {
console.log(xhr.responseText);
} 
}};
$.ajax({
    type: "get",
    url: "goldbar/delete/"+ id,
    dataType: "json",
    success: function (response) {
   console.log(response.status);
      if (response.status == 404) {

                alert(response.errors);

        } else {
          alert(response.message);

          fetchgoldbar();
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
   let url ="{{route('admin.goldbar.search')}}"+"?keyword="+keyword
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
     
                for (goldbar of data){

                    $('tbody').append(
               
                    `
                   <tr>
                    <td>${goldbar.SerialNumber}</td>
                    <td>${goldbar.weight.weight}</td>
                    <td>${goldbar.safetype.types}</td>
                    <td>${goldbar.safe.name}</td>
                    <td><button type="button" value="` + goldbar.id + `" class="btn btn-primary editbtn btn-sm">Edit</button>\
                            <button type="button" value="` + goldbar.id + `" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                   
                
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