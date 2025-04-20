<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        return view('frontend.cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $product = Product::with('productImages')->findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->discount_price ? $product->discount_price : $product->price,
                'image' => $product->productImages->first()->image,
                'slug' => $product->slug,
            ];
        }
        session()->put('cart', $cart);

        notyf()->success('Added to cart successfully.');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($request->product_id && $request->quantity_increment || $request->quantity_decrement) {
            $cart = session()->get('cart');

            $cart[$request->product_id]['quantity'] = $request->quantity_increment ? $request->quantity_increment : $request->quantity_decrement;

            session()->put('cart', $cart);
            
            notyf()->success('Cart updated successfully.');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        if ($request->product_id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);

                session()->put('cart', $cart);
            }
            notyf()->success('Removed from cart successfully.');
            return redirect()->back();
        }

    }

    public function clear()
    {
        //session()->forget('cart');
        // notyf()->success('Cart cleared successfully.');
        // return redirect()->back();
    }

}
