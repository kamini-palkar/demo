<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Product Details</h2>

<table>
  <tr>
    <th>SR</th>
    <th>Name</th>
    <th>Price</th>
    <th>Details</th>
    @foreach($products as $key=>$data)
            <tr>
                <td scope="col">{{$key+1}}</td>
                <td scope="col">{{$data->name}}</td>
                <td scope="col">{{$data->price}}</td>
                <td scope="col">{{$data->details}}</td>
                
              </tr>
            
              @endforeach 
</table>

</body>
</html>

