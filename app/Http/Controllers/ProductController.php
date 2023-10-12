<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exports\ProductExport;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Symfony\Component\HttpFoundation\Response;
use App\Image;

class ProductController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
 
        if ($request->ajax()) {
  
            $data = Product::latest()->get();
            $user = auth()->user();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row)use ($user){
                        $btn = '';
                        if ($user->can('product-edit'))
                         {
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class=" editProduct"><i class="fa fa-edit" style="font-size:24px"></i></a>';

                        }
                        if ($user->can('product-delete'))
                        {
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class=" deleteProduct"><i class="fa fa-trash-o" style="font-size:24px;color:red"></a>';
                        }
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
       
      
        Product::updateOrCreate([
            'id' => $request->product_id,
        ],
        [
            'name' => $request->name, 
            'price' => $request->price, 
            'details' => $request->details
        ]);        

return response()->json(['success'=>'Record saved successfully.']);
        // return response()->json(['success'=>'Product saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {

        $com = Product::where('id',$request->id)->delete();
      
        return Response()->json($com);
    }

    public function export() 
    {
    
        return Excel::download(new ProductExport, 'product.xlsx');

    } 

    public function generatePDF()
   {
        $products = product::all();
        // $pdf = PDF::loadView('table-pdf', $data);
        $pdf = PDF::loadView('product', array('products' =>  $products))
            ->setPaper('a4', 'portrait');
        // $pdf = PDF::loadView('product', ['users' => $data]);
        
        return $pdf->download('products.pdf');

   }

   public function viewPDF()
   {
    $products = product::all();

    $pdf = PDF::loadView('product', ['products' => $products]);

    return $pdf->setPaper('a4')->stream();

   }
   public function exportCSVFile() 
   {
    //    return (new ProductExport)->download('product.csv', \Maatwebsite\Excel\Excel::CSV);
    return Excel::download(new ProductExport, 'product.csv.csv');


   } 
}
