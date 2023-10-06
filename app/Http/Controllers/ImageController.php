<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;


class ImageController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    // Store Image
    public function storeImage(Request $request)
    {
        $file = $request->file('image');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		// $empData = ['name'=> $request->name, 'price' => $request->price, 'details' => $request->details,  'image' => $fileName];
		// Product::create($empData);
		return response()->json([
			'status' => 200,
		]);

      
    }
   
}
