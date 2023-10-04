
@extends('layouts.app')

@section('content')
<div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <h4 class="text-center">Laravel 9 Ajax CRUD Tutorial using Datatable - MyWebTuts.com</h4>
                    </div> -->
          
                    <div class="form-group">
                    <a class="btn btn-primary " href="{{ route('viewpdf') }}"> View PDF <i class="fa fa-eye"></i></a>
                    <a class="btn btn-primary " href="{{ route('exportpdf') }}"> PDF <i class="fa fa-download"></i></a>
			            <a class="btn btn-primary " href="{{ route('export-product') }}"> Excel <i class="fa fa-download"></i></a>
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
                    <form id="productForm" name="productForm" class="form-horizontal">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <!-- <ul>The name is required</ul>
                        <ul> The price is required</ul>
                        <ul> The price is required</ul> -->
                        <ul></ul>
                    </div>
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" >
                            <!-- <small class="text-danger">
                                    @if ($errors->has('name'))
                                        <strong>The name is required.</strong>
                                    @endif
                                </small> -->
                        </div>
                      

                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="" maxlength="50" >
                            <!-- <small class="text-danger">
                                    @if ($errors->has('price'))
                                        <strong>The price is required.</strong>
                                    @endif
                                </small> -->
                        </div>
                      

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="details" name="details"  placeholder="Enter Details" class="form-control"></textarea>
                            <!-- <small class="text-danger">
                                    @if ($errors->has('details'))
                                        <strong>The details are required.</strong>
                                    @endif
                                </small> -->

                        </div>
                     
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" name="image" class="form control">
                            <!-- <small class="text-danger">
                                    @if ($errors->has('details'))
                                        <strong>The details are required.</strong>
                                    @endif
                                </small> -->

                        </div>
                     
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection
  




</html>

