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
        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;

        }

        table,
        th,
        td {
            border: 1px solid gray;
        }

        .th_deg {
            font-size: 25px;
            padding: 5px;
            background: skyblue;
        }
        .img_deg{
            height: 150px;
            width: 150px;
        }
        .total_deg{
            font-size: 20px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        {{-- header Start --}}
        @include('home.header')
        {{-- header ends --}}



        <div class="center">
            <table>
                <tr>
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Product Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>
                </tr>
                <?php $totalPrice = 0; ?>
                @foreach ($cart as $item)

                    <tr>
                        <td>{{ $item->product_title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ $item->price }}</td>
                        <td><img class="img_deg" src="/product/{{ $item->image }}" alt=""></td>
                        <td><a onclick="return confirm('are you sure')" href="{{url('remove_cart', $item->id)}}" class="btn btn-danger">Rmove Product</a>
                        </td>
                    </tr>
                    <?php $totalPrice = $totalPrice + $item->price ?>
                    @endforeach
                    {{-- {{$totalPrice}} --}}
            </table>

            <div>
                <h1 class="total_deg">
                    Total Price : ₹{{ $totalPrice }} BDT
                </h1>
            </div>

            <div>
                <h1 style="font-size: 25px; padding-bottom:15px;">Proceed to Order</h1>
                <a href="cash_order" class="btn btn-danger">Cash On Delivery</a>
                <a href="{{url('rozarpay', $totalPrice)}}" class="btn btn-danger">Pay using Card</a>
            </div>
        </div>


        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->


        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
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
