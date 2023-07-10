<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\order;
use App\Models\product;
use App\Notifications\SendEmailNotification;
use Notification;
use PDF;

class adminController extends Controller
{
    public function category(){
        $data = category::all();
        return view('admin.category', compact('data'));
    }

    public function storeCategory(Request $request){
        $data = new Category;
        $data->category_name=$request->name;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    
    public function delete_category($id){
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('dlt_message', 'Category Deleted Successfully');
    }

    public function view_product(){
        $category = category::all();

        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request){

        $product = new product;     
        $product->title=$request->title;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->discount_price=$request->discount;

        $imageName = time().'.'.$request->image->extension();       
        $request->image->move(public_path('product'), $imageName);
        $product->image=$imageName;
        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product(){
        $product = product::all();
        return view('/admin.show_product', compact('product'));
    }

    
    public function delete_product($id){
        $data = product::find($id);
        $data->delete();
        return redirect()->back()->with('dlt_message', 'Category Deleted Successfully');
    }

    public function update_product($id){
        $product=product::find($id);
        $category=category::all();

        return view('/admin.update_product', compact('product','category'));
    }

    public function update_product_store(Request $request, $id){

        $product = product::find($id);     
        $product->title=$request->title;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->discount_price=$request->discount;

        $image = $request->image;
        if($image)
        {
            $imageName = time().'.'.$image->extension();       
            $request->image->move(public_path('product'), $imageName);
            $product->image=$imageName;
        }
        
        $product->save();
        return redirect()->back()->with('message', 'Product Update Successfully');
    }    

    public function orders(){
        $order = order::all();
        return view('admin.orders', compact('order'));
    }

    public function delivered($id){
        $order = order::find($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "paid";

        $order->save();
        return redirect()->back();
    }

    public function Print_pdf($id){
        $order = order::find($id);

        $pdf = PDF::loadview('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }
    public function send_email($id){
        $order = order::find($id);
        return view('admin.email_info', compact('order'));
    }

    public function send_user_email(Request $request,$id){
        $order = order::find($id);
        $details= [

            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url' =>$request->url,
            'lastline' => $request->lastline,
        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }
    public function search(Request $request){
        $searchText=$request->search;
        $order=order::where('name','LIKE',"%$searchText%")->orwhere('phone','LIKE',"%$searchText%")->get();
        return view('admin.orders', compact('order'));
    }
}
