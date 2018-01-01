<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
//use Symfony\Component\HttpFoundation\Session\Session;
use Mockery\Exception;
use Session;
use Auth;
use Stripe\Stripe;
use Stripe\Charge;
//test acc number 000123456789
class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }
    public function getreduce1(Request $request,$id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduce1($id);if(count($cart->items)>0)
            Session::put('cart', $cart);
        else
            Session::forget('cart');
        return redirect()->route('product.shoppingCart');
    }

    public function getremoveItem(Request $request,$id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if(count($cart->items)>0)
            Session::put('cart', $cart);
        else
            Session::forget('cart');
        $cart->removeItem($id);
        return redirect()->route('product.shoppingCart');
    }


    public function getAddToCart(Request $request,$id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }
    public function getCart(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart',['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = 'ran';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function postCheckout(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        Stripe::setApiKey('sk_test_YLjdVyMfqwRmpW3QYHdtqyF5');
        //$customer = \Stripe\Customer::retrieve("cus_C2agpDnzSYD92A");
        //$bank_account = $customer->sources->retrieve("cus_C2agpDnzSYD92A");

        //$bank_account->verify(array('amounts' => array(32, 45)));
//        try{
//            Charge::create(array(
//                "amount" => $cart->totalPrice * 100,
//                "currency" => "usd",
//                "source" => $request->input('stripeToken'), // obtained with Stripe.js
//                "description" => "Test Charge"
//            ));
//        }catch(\Exception $e){
//            return redirect()->route('checkout')->with('error', $e->getMessage());
//        }
//
//        Session::forget('cart');
        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->payment_id = $this->generateRandomString();

        Auth::user()->orders()->save($order);
        Session::forget('cart');
        return redirect()->route('product.index')->with('success','sucessfully done');
    }



}
