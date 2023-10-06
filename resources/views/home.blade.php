
@extends('layouts.app')

@section('content')
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
                           <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> <i class="fas fa-plus"></i></a>
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


     <!-- Container (Contact Section) -->
     <div id="contact" class="container">
        <h1 class="text-center" style="margin-top: 100px">Image Upload</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>

            <img src="{{ asset('images/'.Session::get('image')) }}" />
        @endif

        <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="image" />

            <button type="submit" class="btn btn-sm">Upload</button>
        </form>

    </div>

@endsection
  




