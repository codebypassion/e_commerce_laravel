<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .title_deg {
            text-align: center;
            font-weight: bold;
            font-size: 25px;
            padding-bottom: 40px;
        }

        .table_Deg {
            border: 2px solid white;
            /* width: 70%; */
            margin: auto;
            text-align: center;
        }

        table,
        td,th{
            padding: 5px;
            /* min-width: 80px; */
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and
                                more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/corona-free/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')

        <div class="main-panel">
            <div class="content-wrapper">


                <h1 class="title_deg">All Orders</h1>
                <div style="padding-bottom:30px; padding-left:400px;">
                    <form action="{{url('search')}}" method="get">
                        @csrf
                        <input type="text" style="color: black" name="search" placeholder="Search for something">
                        <input type="submit" value="search" class="btn btn-primary">
                    </form>
                </div>
                <table class="table_Deg">

                    <tr style="background-color: rgb(47, 161, 161)">
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        <th>Print PDF</th>
                        <th>Send email</th>
                    </tr>
                    @forelse ($order as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->product_title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->payment_status }}</td>
                            <td>{{ $item->delivery_status }}</td>
                            <td><img src="product/{{ $item->image }}" alt=""></td>
                            <td>
                                @if ($item->delivery_status == 'processing')
                                    <a onclick="return confirm('Are you sure is product is delivered')"
                                        href="{{ url('delivered', $item->id) }}" class="btn btn-primary">Delivered</a>
                                @else
                                    <p style="color: rgb(133, 248, 38)">Delivered</p>
                                @endif
                            </td>
                            <td><a href="{{url('Print_pdf', $item->id)}}" class="btn btn-secondary">Print Pdf</a></td>
                            <td><a href="{{url('send_email', $item->id)}}" class="btn btn-info">Send Email</a></td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="16">No Data Found</td>
                        </tr>
                            
                        {{-- @endempty --}}
                    @endforelse
                </table>

            </div>
        </div>
        <!-- partial -->
        {{-- @include('admin.body') --}}
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.scrips')
        <!-- End custom js for this page -->
</body>

</html>
