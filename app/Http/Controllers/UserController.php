<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use  App\Models\Model_Has_Roles;
// use DB;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;
// use Elibyy\TCPDF\Facades\TCPDF;
use PDF;
use TCPDF;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        
        return view('users.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
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
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        // User::find($id)->delete();
        // return redirect()->route('users.index')
        //                 ->with('success','User deleted successfully');
        $user = User::where('id',$request->id)->delete();
      
        return Response()->json($user);
    }
    public function exporttcpdf(Request $request)
    {
        // $filename = 'demo.pdf';
  
        // $data = [
        //     'title' => 'User Details'
        // ];
  
        // $html = view()->make('pdfSample', $data)->render();
  
        // $pdf = new TCPDF;
          
        // $pdf::SetTitle('Hello World');
        // $pdf::AddPage();
        // $pdf::writeHTML($html, true, false, true, false, '');
  
        // $pdf::Output(public_path($filename), 'F');
  
        // return response()->download(public_path($filename));


      
        $users =User::with('roles:name')->get();
      
        $view = \View::make('pdfSample', ['users'=>$users]);
        $html_content = $view->render();
        PDF::SetTitle("List of users");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // D is the change of these two functions. Including D parameter will avoid 
        // loading PDF in browser and allows downloading directly
        PDF::Output('userlist.pdf', 'D');  
    }
    public function generatetcpdf()
    {
        
   
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);     
        // Set document information
        $pdf->SetCreator('PDF_CREATOR');
        $pdf->SetAuthor('User Management');
        $pdf->SetSubject('TCPDF ');
        $pdf->SetTitle('User Details PDF');
        $pdf->SetKeywords('TCPDF, PDF');
        
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 004', PDF_HEADER_STRING);
        $pdf->SetHeaderData('Image', 50, 'Secure Softwere solution', 'User Management');

    
      
        // Add a page
        $pdf->AddPage();

        $pdf->setHeaderFont(Array('helvetica', '', 16));
        $pdf->setFooterFont(Array('helvetica', '', 12));

    

       

        // Add content using Cell
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 15, 'User  Details', 0, 1, 'C');

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $headerHeight = 90; // in millimeters (mm)
        $pdf->SetHeaderMargin($headerHeight);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

          // Set font and size
        $pdf->SetFont('helvetica', 'I', 12);
        
        $columnWidths = [10, 40, 80,40];
    
        $columnNames = ['SR', 'Name', 'Email','Role'];
        $pdf->SetXY(15,25);    
        // Create the table header with column names
        foreach ($columnNames as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 1, 'L');
        }
        $pdf->Ln();
     

    

        // Fetch users and their roles
        $users = User::with('roles:name')->get();

        // Loop through the users and display user data and roles' names in MultiCells
        foreach ($users as $key=> $user) {
            // User data
            $userName = $user->name;
            $userEmail = $user->email;

            // Initialize a string to store roles' names
            $rolesString = '';

            // Loop through the user's roles and concatenate their names into the string
            foreach ($user->roles as $role) {
                $rolesString .= $role->name . ', ';
            }

            // Remove the trailing comma and space
            $rolesString = rtrim($rolesString, ', ');

            // Use MultiCell to display user data and roles' names
            // $pdf->MultiCell(0, 10, "User: $userName\nEmail: $userEmail\nRoles: $rolesString", 1, 'L');
            $pdf->Cell($columnWidths[0], 10, $key+1, 1,'L');
            $pdf->Cell($columnWidths[1], 10, $userName, 1,'L');
            $pdf->Cell($columnWidths[2], 10,  $userEmail, 1,'L');
            $pdf->Cell($columnWidths[3], 10,   $rolesString, 1,'L');
            $pdf->Ln(); // Move to the next line (row)
        }

        // Output the PDF (you can choose to save it or display it in the browser)
        $pdf->Output('user_data_and_roles.pdf', 'I');
    }
   
}