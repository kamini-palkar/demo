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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
 
        if ($request->ajax()) {
  
            $data = Product::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($product) {
                        return '<img src="' . $product->image . '" width="100" height="100">';
                    })
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class=" editProduct"><i class="fa fa-edit" style="font-size:24px"></i></a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class=" deleteProduct"><i class="fa fa-trash-o" style="font-size:24px;color:red"></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
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
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        // 'details' => 'required',
           
        // ]);
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'details' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
       
      
        Product::updateOrCreate([
          
            'id' => $request->product_id
        ],
        [
            
            'name' => $request->name, 
            'price' => $request->price,
            'details' => $request->details,
           
        ]);        

        return response()->json(['success'=>'Product saved successfully.']);
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
    public function destroy($id)
    {


        Product::find($id)->delete();
        
     
        return response()->json(['success'=>'Product deleted successfully.']);
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
