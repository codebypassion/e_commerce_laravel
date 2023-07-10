<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.css')
        <style>
            .div_canter {
                text-align: center;
                padding-top: 40px;
            }

            .h2_font {
                font-size: 40px;
                padding-bottom: 40px;
            }

            .input_color {
                color: black;
            }

            .center{
                margin: auto;
                width: 50%;
                text-align: center;
                margin-top: 30px;
                border: 3px solid white;
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
                                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support,
                                    updates, and more with this template!</p>
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
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close">X</button>
                        </div>
                    @endif

                    @if (session()->has('dlt_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('dlt_message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close">X</button>
                    </div>
                @endif

                    <div class="div_canter">
                        <h2 class="h2_font">Add Category</h2>
                        <form action="{{ url('/add_category') }}" method="post">
                            @csrf
                            <input type="text" class="input_color" name="name" placeholder="Write Category Name">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                        </form>
                    </div>

                    <table class="center">
                        <tr>
                            <td>Ctegory Name</td>
                            <td>Action</td>
                        </tr>

                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item->category_name}}</td>
                            <td>
                                <a onclick="return confirm('Are you sure to Delete This Category')" href="{{url('delete_category', $item->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                       

                    </table>

                </div>
            </div>
            <!-- container-scroller -->
            <!-- plugins:js -->
            @include('admin.scrips')
            <!-- End custom js for this page -->
    </body>

    </html>
</body>

</html>
