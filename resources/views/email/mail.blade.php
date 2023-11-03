@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="pull-right">
        
          <a class="btn btn-danger " href="{{ route('send-mail') }}"> Send Mail <i class="fa fa-envelope"></i></a>
         
         </div>
       
         <br> <br>
            <div class="card bg-light mt-3">
                <div class="card-header">
                    EMail Attachment
                </div>
                <div class="card-body">
                    <form action="{{ route('User_Mail') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="email" name="email"
                            class="form-control" placeholder="Email id" required><br>
                        <input type="file" name="user_file"
                            class="form-control" required>
                        <br>
                       
                        <button class="btn btn-danger">
                        Send Mail <i class="fa fa-envelope"></i>
                        </button>
                
                    </form>
                </div>
            </div>
        </div>

@endsection 