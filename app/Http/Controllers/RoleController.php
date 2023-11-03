<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Yajra\DataTables\Facades\DataTables;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        // return view('roles.index',compact('roles'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);

        // $roles = Role::latest()->paginate(5);

        // return view('roles.index', compact('roles'));
        if ($request->ajax()) {
  
            $role = Role::latest()->get();
            $user = auth()->user();
  
            return Datatables::of($role)
                    ->addIndexColumn()
                    ->addColumn('action', function($row)use ($user){
                        $btn = '';
                        if ($user->can('role-edit'))
                         {
                            $btn = '<a href="'.route("roles.edit",$row->id).'" data-toggle="tooltip" title="Show" class=""><span class="icon-size-fullscreen"></span> <i class="fa fa-edit" style="font-size:24px"></i></a>';

                        }
                        if($user->can('role-edit'))
                        {
   
                            $btn = $btn.'<a href="'.route("roles.show",$row->id).'" data-toggle="tooltip" title="Show" class="">  <i class="fa fa-eye"></i></a>';
                        }
                        if ($user->can('role-delete'))
                        {
   
                            $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip" title="delete" class="deleteRole" data-id="'.$row->id.'"><span class="icon-size-fullscreen"></span> <i class="fa fa-trash-o" style="font-size:24px;color:red"></i></a>';
                        }
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('roles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        // return redirect()->route('roles.index')
        //                 ->with('success','Role created successfully');
                        return redirect()->back()->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // DB::table("roles")->where('id',$id)->delete();
        // return redirect()->route('roles.index')
        //                 ->with('success','Role deleted successfully');
        $com = Role::where('id',$request->id)->delete();
      
        return Response()->json($com);
    }
}