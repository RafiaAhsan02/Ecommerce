<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('frontend.cart.checkout');
    }

    public function checkoutStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
            'address' => 'required|string|max:255',
            'payment_method' => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        if ($user->phone == null && $user->address == null) {
            $user->update([
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }

        if ($request->payment_method == 'cash') {
            $cartItems = session()->get('cart', []);
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $totalPrice = $total + 100;

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
                'payment_status' => 'Pending',
                'order_note' => $request->order_note,
                'shipping_address' => $request->address
            ]);

            foreach ($cartItems as $cart) {
                $order->products()->attach($cart->id, [
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                ]);
            }

            session()->forget(keys: 'cart');
            notyf()->success('Your order has been placed successfully.');
            return to_route('home');
        }

        if ($request->payment_method == 'online') {
            $cartItems = session()->get('cart', []);
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $totalPrice = $total + 100; /* shipping charge 100taka */

            # Here you have to receive all the order data to initate the payment.
            # Let's say, your oder transaction informations are saving in a table called "orders"
            # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

            $post_data = array();
            $post_data['total_amount'] = $totalPrice; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid() . time(); // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $user->name;
            $post_data['cus_email'] = $user->email;
            $post_data['cus_add1'] = $request->address;
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $request->phone;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = $request->address;
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            #Before  going to initiate the payment order status need to insert or update as Pending.

            $orderId = Order::where('tran_id', $post_data['tran_id'])->insertGetId([
                'user_id' => $user->id,
                'amount' => $totalPrice,
                'payment_method' => $request->payment_method,
                'payment_status' => 'Pending',
                'order_note' => $request->order_note,
                'shipping_address' => $request->address,
                'tran_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

            $order = Order::find($orderId);

            foreach ($cartItems as $cart) {
                $order->products()->attach($cart->id, [
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                ]);
            }

            session()->forget('cart');

            // $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            // $payment_options = $sslc->makePayment($post_data, 'hosted');

            // if (!is_array($payment_options)) {
            //     print_r($payment_options);
            //     $payment_options = array();
            // }
        }

    }
}
