<!DOCTYPE html>
<html>
<head>
    <title>user details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
</head>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>
 
 


    <div class="container">
        <div class="">
   
           <h2 class="text-dark">User Details</h2>
            <table class="table table-hover table-bordered  table-striped user-table" >
                <thead class="bg-secondary text-dark">
                    <tr>
                      <th width="10%">No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users  as $key =>$user)
                  <tr>
                      <td width="10%">{{$key+1}}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <!-- <td>{{ $user->role_name }}</td> -->
                      <td>
                        @if(!empty($user->getRoleNames()))
                          @foreach($user->getRoleNames() as $v)
                            <label class="">{{ $v }}</label>
                          @endforeach
                        @endif
                      </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
     </div>
    </div>
</body>
</html>