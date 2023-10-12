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
    <div class="bg-light p-4 rounded">
       
       
        <div class="row">
        <div class="col-lg-12 margin-tb">
            <!-- <div class="pull-left">
                <h2><b>Role Management</b></h2>
            </div> -->
            <h2>Manage your permissions here.</h2>
            <div class="col-md-12 mb-4 text-right">
                <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></a>
            </div>
        </div>
      </div>
        
      

        <table class="table table-hover table-bordered  table-striped mt-2 permission-table"> 
            <thead>
            <tr>
                <th scope="col" width="">#</th>
                <th scope="col" width="">Name</th>
                <th scope="col">Guard</th> 
                <th scope="col"  width="">Action</th> 
            </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

    </div>
</div> 

<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.permission-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('permissions.index') }}",
            columns : [
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'name',name:'name'},  
                {data:'guard_name',name:'guard_name'}, 
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
      

    });    
   
</script>

@endsection