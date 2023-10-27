@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="pull-right">
          <a class="btn btn-success " href="{{ route('ANU_DANAMICDATA') }}"> AN_University <i class="fa fa-download"></i></a>
         
         </div>
         <br> <br>
            <div class="card bg-light mt-3">
                <div class="card-header">
                    Import Marksheet data 
                </div>
                <div class="card-body">
                    <form action="{{ route('upload-excel') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="excel_file"
                            class="form-control">
                        <br>
                        <button class="btn btn-success">
                            Import Student Data
                        </button>
                     
                    </form>
                </div>
            </div>
        </div>

@endsection 