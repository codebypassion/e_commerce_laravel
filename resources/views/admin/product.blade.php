<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color {
            color: black;
            padding-bottom: 20px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 15px
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

                <div class="div_center">
                    <h1 class="font_size">Add Product</h1>

                    <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="div_design">
                        <label>Product Title :</label>
                        <input class="text_color" type="text" name="title" placeholder="Write a title" required>
                    </div>

                    <div class="div_design">
                        <label>Product Description :</label>
                        <input class="text_color" type="text" name="description" placeholder="Write a description" required>
                    </div>

                    <div class="div_design">
                        <label>Product price :</label>
                        <input class="text_color" type="number" name="price" placeholder="Write a price" required>
                    </div>
                    
                    <div class="div_design">
                        <label>Discount Price :</label>
                        <input class="text_color" type="number" name="discount" placeholder="Write a discount">
                    </div>

                    <div class="div_design">
                        <label>Product Quantity :</label>
                        <input class="text_color" type="number" min="0" name="quantity"
                            placeholder="Write a quantity" required>
                    </div>

                    <div class="div_design">
                        <label>Product Category :<Title></Title></label>
                        <select class="text_color" name="category" required>
                            <option value="" selected>Add a category here</option>
                            @foreach ($category as $item)
                            <option value="{{$item->category_name}}">{{$item->category_name}}</option>                                
                            @endforeach
                        </select>
                    </div>

                    <div class="div_design">
                        <label>Product Image Here :</label>
                        <input type="file" name="image" required>
                    </div>

                    
                    <div class="div_design">
                        <input type="submit" name="submit" value="Add Product" class="btn btn-primary">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.scrips')
    <!-- End custom js for this page -->
</body>

</html>
