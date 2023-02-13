<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CartController extends Controller
{
    public function cartList(){
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image
            ),
            'slug' => $request->slug
        ));
        return redirect()->route('cart.list')->with('success', 'Producto añadido al carrito');
    }

    public function updateCart(Request $request){
        \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            )
        ));
        return redirect()->route('cart.list')->with('success', 'Actualizada cantidad');
    }

    public function removeCart(Request $request){
        \Cart::clear($request->id);
        return redirect()->route('cart.list')->with('success', 'Eliminado producto del carrito');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.list')->with('success', 'Carrito borrado');
    }
}
