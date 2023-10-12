
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    >

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<div class="container mt-3">
        <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>

         
        @endif
            <div class="col-md-12">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <h4 class="text-center">Laravel 9 Ajax CRUD Tutorial using Datatable - MyWebTuts.com</h4>
                    </div> -->
                   
          
                    <div class="form-group">
                    <a class="btn btn-primary " href="{{ route('viewpdf') }}"> View PDF <i class="fa fa-eye"></i></a>
                    <a class="btn btn-primary " href="{{ route('exportpdf') }}"> PDF <i class="fa fa-download"></i></a>
			            <a class="btn btn-primary " href="{{ route('export-product') }}"> Excel <i class="fa fa-download"></i></a>
                        <a class="btn btn-primary " href="{{ route('exportcsv') }}"> CSV <i class="fa fa-download"></i></a>
                        <button id="exportButton" class="btn btn-primary" style=" margin-right:20px">Export<i class="fa fa-download"></i></button>

                       <div class="col-md-12 mb-4 text-right">
                          @can('product-create')
                            <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> 
                                <i class="fas fa-plus"></i></a>
                           @endcan
		               </div> 
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered data-table table-striped">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Details</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal" action="#">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                       
                        <ul></ul>
                    </div>
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" >
                         
                        </div>
                      

                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="" maxlength="50" >
                          
                        </div>
                      

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="details" name="details"  placeholder="Enter Details" class="form-control"></textarea>

                        </div>
                     
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                        <input type="file" class="form-control" name="image" />
                        
                        </div>
                     
                    </div> -->
                  
      
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

     
        var t = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns : [
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'name',name:'name'},
                {data:'price',name:'price'},
                {data:'details',name:'details'},
       
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('product.index') }}" +'/' + product_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Product");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#product_id').val(data.id);
            $('#name').val(data.name);
            $('#price').val(data.price);
            $('#details').val(data.details);
            })
        });


        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
      
        $.ajax({
            data: $('#productForm').serialize(),
            url: "{{ route('product.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
        
                if(data.errors)
                        {
                            printErrorMsg(data.errors); 
                            // location.reload();
                            alert(data.errors);
                          
                        }
                        else{
                            $('#productForm').trigger("reset");
                            $(".print-error-msg").css('display','none');
                            $('#ajaxModel').modal('hide');
                            table.draw();
                            alert("Data Added sucessfully");

                        }
                   
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                    alert(2);
                }
        });
    });



      
        function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

         $('body').on('click', '.deleteProduct', function () {    
            if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            alert(id);
        
          // ajax
          $.ajax({
            type:"POST",
            url: "{{ url('delete-product') }}",
            data: { id: id},
            dataType: 'json',
            success: function(res){

                var oTable = $('.data-table').dataTable();
                oTable.fnDraw(false);
            }
        });
        }

        });
    });


    $(document).ready(function() {
       $('#exportButton').click(function() {
           fetch('/export', { //This line uses the fetch API to make a GET request to the "/export" URL on your server. It starts the process of requesting data from the server.                    method: 'GET',
                    headers: {                       
                        'Content-Type': 'application/json',                  
                      },
               })
                .then((response) => response.blob())
                .then((blob) => {
                    // Create a blob URL and trigger download
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'product.xlsx';
                  document.body.appendChild(a);
                   a.click();
                   window.URL.revokeObjectURL(url);
               })
                .catch((error) => {
                   console.error('Export failed:', error);
                   alert('Export failed.');
                });

        });
   });



  
</script>


    

@endsection 
  




