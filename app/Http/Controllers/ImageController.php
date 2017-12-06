<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
	public function index($id){
		$product = product::find($id);
		$images = $product->images;
		return view('admin.products.images.index')->with(compact('product', 'images'));
	}

	public function store(Request $request, $id)
	{
    	// guardar la imagen en nuestro proyecto
		$file = $request->file('photo');
		$path = public_path().'images/products';
		$fileName = uniqid().$file->getClientOriginalName();
		$moved = $file->move($path, $fileName);

    	// crear un registro en la bd, product_images
		if($moved){
			$productImage = new ProductImage();
			$productImage->image = $fileName;
    		//$productImage->featured = false;
			$productImage->product_id = $id;
    		$productImage->save(); //INSERT
    	}

    	return back();
    }

    public function destroy(Request $request, $id)
    {
    	//eliminar el archivo
    	$productImage = ProductImage::find($request->image_id);
    	if (substr($productImage->image, 0, 4) === "http") {
    		$deleted = true;
    	} else {
    		$fullPath = public_path() . 'images/products' . $productImage->image;
    		$deleted = File::delete($fullPath);
    	}

    	//eliminar el registro de la img en la bd
    	if ($deleted) {
    		$productImage->delete();
    	}

    	return back();
    }
}
