<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::latest()->get();
        return view('home', compact('productos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function postProducto(Request $request)
    {
        $image = null;
        if (isset($request->picture)) {
            $image = time().'_'.$request->picture->getClientOriginalName().'.'.$request->picture->extension();
            $request->picture->move(public_path('pictures'),$image);
        }
        Producto::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'picture'=>$image
        ]);

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateStatus($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update(['complete' => !$producto->complete]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('update', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTodo(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $image = $producto->picture;

        if (isset($request->picture)) {
            if ($producto->picture) {
                unlink('pictures/'.$image);
            }
            $image = time().'_'.$request->picture->getClientOriginalName().'.'.$request->picture->extension();
            $request->picture->move(public_path('pictures'),$image);
        }

        $producto->name = $request->name;
        $producto->price = $request->price;
        $producto->picture = $image;
        $producto->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteTodo($id)
    {
        $producto = Producto::findOrFail($id);
        if ($producto->picture) {
            unlink('pictures/'.$producto->picture);
        }
        $producto->delete();
        return redirect('/');
    }
}
