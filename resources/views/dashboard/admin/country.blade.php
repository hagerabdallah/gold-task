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
      <br>
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
                <th class="column-title">Country Name </th>
                <th class="column-title">Action</th>

                {{-- <th class="column-title no-link last"><span class="nobr">Action</span>
                </th> --}}
                {{-- <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th> --}}
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
<div class="modal fade" id="addcountry" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Add country Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storecountry" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="modal-body">

                <ul id="save_msgList"></ul>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                <div class="form-group mb-3">
                    <label for="">Country Name</label>
                    <input type="text" required class="CountryName form-control" name="CountryName">
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
<div class="modal fade" id="editcountry" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatecountry" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="modal-body">

                <ul id="save_msgList"></ul>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="country_id"> 

                <div class="form-group mb-3">
                    <label for="">Country Name</label>
                    <input type="text" required class="CountryName form-control" name="CountryName" id="Country_Name">
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
        FetchCountry();
        ///////////////fetch data//////////////////
        function FetchCountry(){
            $.ajax({
                type: "GET",
                url: "fetchcountry",
                dataType: "json",
                success: function (response) {
                    // console.log(response.countries);
                    $('tbody').html("");
                    $.each(response.country, function (key, item) {
                        $('tbody').append(
                            '<tr>\
                            <td>' + item.CountryName + '</td>\
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
$('#addcountry').modal('show');

});

////////////////////// end show create form/////////////////



////////////////////// store country/////////////////

$(document).on('submit', '#storecountry', function (e) {
            e.preventDefault();
            var xhr = new XMLHttpRequest(),
            method = "POST",
    url="country/store";

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

                'CountryName': $('.CountryName').val(),
                
            }

            $.ajax({
                type: "POST",
                url: "country/store",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 400) {
                        alert(response.errors);

                    } else {
                        $('#addcountry').modal('hide');
                        alert(response.message);  
                        FetchCountry();
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
var country_id=$(this).val();

$('#editcountry').modal('show');

$.ajax({
    type:"GET",
   
   url:"country/edit/"+country_id,
    
   success: function (response)

   {
    // console.log(response.status);

     if(response.status==404)
     {
       alert(response.errors);
       $('#editcountry').modal('hide');
     }
     else
     {
        $('#country_id').val(response.countries.id);

       $('#Country_Name').val(response.countries.CountryName);
    
     }

}

});
});
//////////////////////////end edit/////////////////

///////////////////////update/////////////



$(document).on('submit','#updatecountry',function(e)
{
e.preventDefault();
var country_id=$('#country_id').val();
// console.log(country_id);

var xhr = new XMLHttpRequest(),
    method = "POST",
    url="country/update/"+country_id;


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

                'CountryName': $('#Country_Name').val(),}
                
$.ajax(
  {
  
   type:"POST",

  url:"country/update/"+country_id,
  data:data,
  dataType: "json",
  

  success: function (response){
  
  if (response.status==404)
  {
   
    alert(response.errors);
       $('#updatecountry').modal('hide');
  }
  else
  {
 $('#updatecountry').modal('hide');
 alert(response.message);
 $('#editcountry').modal('hide');

 FetchCountry();

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
              url="country/delete/"+ id;


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
                url: "country/delete/"+ id,
                dataType: "json",
                success: function (response) {
               console.log(response.status);
                  if (response.status == 404) {

                            alert(response.errors);

                    } else {
                      
                        FetchCountry();
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
   let url ="{{route('admin.country.search')}}"+"?keyword="+keyword
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
     
                for (country of data){

                    $('tbody').append(
               
                    `
                   <tr>
                    <td>${country.CountryName}</td>
                    <td><button type="button" value="` + country.id + `" class="btn btn-primary editbtn btn-sm">Edit</button>\
                            <button type="button" value="` + country.id + `" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                   
                
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