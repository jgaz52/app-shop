<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); //listado de productos
    }

    public function create(){
    	return view('admin.products.create'); //formulario de registro
    }

    public function store(Request $request){
        //validar 
        $rules = [
            'name'=> 'required|min:3',
            'description'=> 'required|max:200',
            'price'=> 'required|numeric|min:0'
        ];
        $messages = [
            'name.required' =>          'El nombre es requerido',
            'name.min' =>               'Mínimo tres caracteres para el nombre',
            'description.required' =>   'La descripción es requerida',
            'description.max' =>        'Máximo docientos caracteres para la descripción',
            'price.required'=>          'El precio es requerido',
            'price.numeric'=>           'El precio debe ser numérico',
            'price.min'=>               'El precio no puede ser negativo',
        ];

        $this->validate($request, $rules, $messages);

    	//Registrar el nuevo producto en la BD
    	//dd($request->all());
    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
    	$product->save(); // INSERT sobre la tabla de productos
    	return redirect('/admin/products');
    }

    public function edit($id){
        //return "Mostrar aqui el form de edición para el producto con id $id";
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product')); //formulario de registro
    }

    public function update(Request $request, $id){

        //validar 
        $rules = [
            'name'=> 'required|min:3',
            'description'=> 'required|max:200',
            'price'=> 'required|numeric|min:0'
        ];
        $messages = [
            'name.required' =>          'El nombre es requerido',
            'name.min' =>               'Mínimo tres caracteres para el nombre',
            'description.required' =>   'La descripción es requerida',
            'description.max' =>        'Máximo docientos caracteres para la descripción',
            'price.required'=>          'El precio es requerido',
            'price.numeric'=>           'El precio debe ser numérico',
            'price.min'=>               'El precio no puede ser negativo',
        ];

        $this->validate($request, $rules, $messages);
        
        //Registrar el nuevo producto en la BD
        //dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); // UPDATE sobre la tabla de productos
        return redirect('/admin/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete(); // DELETE sobre la tabla de productos
        return back();  //Redirect a la pagina anterior
    }
}
