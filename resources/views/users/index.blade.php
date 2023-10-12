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
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Users Management</h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-success" href="{{ route('users.create') }}"> <i class="fas fa-plus"></i></a>
          </div>
      </div>
  </div>


  @if ($message = Session::get('success'))
  <div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    <p>{{ $message }}</p>
  </div>
  @endif

  <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered  table-striped user-table" >
                <thead class="bg-secondary text-white">
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
     </div>
    </div>


  <!--  -->
</div>


<script>

$(document).ready( function () {
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });  
         var table = $('.user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns : [
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'name',name:'name'},  
                {data:'email',name:'email'}, 
                {data:'roles',name:'roles.name' ,orderable: false, render: function(data) {
                        return data.map(role => role.name).join(', ');
                    } },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.deleteUser', function () {
 
          if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            alert(id);
              
            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('delete-User') }}",
                data: { id: id},
                dataType: 'json',
                success: function(res){

                  var oTable = $('.user-table').dataTable();
                  oTable.fnDraw(false);
              }
            });
          }

          });
 });        
        
   
</script>

@endsection