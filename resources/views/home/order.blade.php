<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="css/responsive.css" rel="stylesheet" />
     <style>
        .center{
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }
        table,th,td{
            border: 1px solid black;
        }
        .th_Deg{
            padding: 10px;
            background-color: skyblue;
            font-size: 20px;
            font-weight: bold;
        }
     </style>
   </head>
   <body>
      <div>
         {{-- header Start --}}
         @include('home.header')
         {{-- header ends --}}

         <div class="center"><table>
            <tr>
                <th class="th_Deg">Product Title</th>
                <th class="th_Deg">Quantity</th>
                <th class="th_Deg">Price</th>
                <th class="th_Deg">Payment Status</th>
                <th class="th_Deg">Delivery Status</th>
                <th class="th_Deg">Image</th>
                <th class="th_Deg">Cancel order</th>
            </tr>
            @foreach ($order as $item)
                
            <tr>
                <td>{{$item->product_title}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->payment_status}}</td>
                <td>{{$item->delivery_status}}</td>
                <td><img height="100" width="150" src="product/{{$item->image}}" alt=""></td>
                <td>                
                    @if($item->delivery_status=='processing')
                    <a class="btn btn-danger" href="{{url('cancel_order', $item->id)}}" onclick="return confirm('Are you sure to cancle the order')">Cencel Order</a>
                @else
                <p style="color: blue">Not Allowed</p>
                @endif
                </td>
            </tr>
            @endforeach
        </table>
         </div>
      </div>
      
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>