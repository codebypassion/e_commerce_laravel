<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use App\Models\cart;
use App\Models\commernt;
use App\Models\order;
use App\Models\reply;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Support\Facades\Session;
use Exception;
use Razorpay\Api\Api;



use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\Api as FlareClientApi;

class homeController extends Controller
{
    public function redirect()
    {
        $userType = Auth::user()->usertype;
        if ($userType == '1') {
            $total_product = product::all()->count();
            $total_order = order::all()->count();
            $total_user = user::all()->count();
            $order = order::all();
            $total_revenue = 0;
            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }
            $total_deliver = order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_process = order::where('delivery_status', '=', 'processing')->get()->count();
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_deliver', 'total_process'));
        } else {

            $product = product::paginate(3);
            $comment = commernt::orderby('id', 'desc')->get();
            $reply = reply::all();
            return view('home.homepage', compact('product', 'comment', 'reply'));
        }
    }

    public function index()
    {

        $product = product::paginate(3);
        $comment = commernt::orderby('id', 'desc')->get();
        $reply = reply::all();
        return view('home.homepage', compact('product', 'comment', 'reply'));
    }

    public function product_details($id)
    {
        $product = product::find($id);

        return view('home.product_details', compact('product'));
    }


    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            // dd($user);
            $product = Auth::user();
            $product = product::find($id);
            // dd($product); 
            $cart = new cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;

            if ($product->discount_price != null) {
                $cart->price = ((int)$product->discount_price * (int)$request->quantity);
            } else {
                $cart->price = ((int)$product->discount_price * (int)$request->quantity);
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back();
        } else {
            // return $id;
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {

            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            // return $cart;
            return view('home.show_cart', compact('cart'));
        } else {
            return redirect('/login');
        }
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userId = $user->id;
        // dd($userId);
        $data = cart::where('user_id', '=', $userId)->get();
        foreach ($data as $data) {
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back();
    }

    public function rozarpay($totalPrice)
    {
        return view('home.rozarpay', compact('totalPrice'));
    }

    public function store(Request $request, $totalPrice)
    {
        // dd($totalPrice);
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        $user = Auth::user();
        $userId = $user->id;
        // dd($userId);
        $data = cart::where('user_id', '=', $userId)->get();
        foreach ($data as $data) {
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'paid';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }


        Session::put('success', 'Payment successful');
        return redirect()->back();
    }

    public function show_order()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $order = order::where('user_id', '=', $userid)->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }
    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'You cancle the order';
        $order->save();
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $comment = new commernt;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply = new reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        } else {
        }
    }

    public function product_search(Request $request)
    {
        $comment = commernt::orderby('id', 'desc')->get();
        $reply = reply::all();
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->paginate(2);
        return view('home.homepage', compact('product','comment', 'reply'));
    }
}
