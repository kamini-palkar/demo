<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function marksheet()
    {
        return view('marksheet');
    }
    public function mail()
    {
        return view('email.mail');
    }
    public function user()
    {
        return view('userdata');
    }
   


    public function userdata(Request $request)
    {
    
        if ($request->ajax()) {
          
         
            $data =  User::with('roles:name')->get();
    
            
            return Datatables::of($data)
                    ->addIndexColumn()
                  
                    ->addColumn('action', function($row){
                      

                           $btn = '<a href="'.route("users.show",$row->id).'" data-toggle="tooltip" title="Show" class=""></span> <i class="fa fa-eye"></i></a>';

                            $btn .= '<a href="'.route("users.edit",$row->id).'" data-toggle="tooltip" title="Show" class=""></span> <i class="fa fa-edit" style="font-size:24px"></i></a>';

                       
   
                            $btn .= '<a href="" data-toggle="tooltip" data-id="'.$row->id.'"  title="Show" class="deleteUser"></span> <i class="fa fa-trash-o" style="font-size:24px;color:red"></i></a>';
                        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('userdata');
    }



    
}
