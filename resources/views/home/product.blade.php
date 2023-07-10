<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <div>
                <form action="{{url('product_search')}}" method="get">
                    @csrf
                    <input style="width:500px;" type="text" name="search" placeholder="Search Here">
                    <input type="submit" value="search">
                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($product as $item)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{url('/product_details', $item->id)}}" class="option1">
                                    Product Details
                                </a>
                                {{-- <a href="" class="option2">
                                    A
                                </a> --}}
                                <form action="{{url('/add_cart', $item->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1" style="width:100px">
                                        </div>
                                        <div class="col-md-4">
                                    <input type="submit" value="Add To Cart">
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="/product/{{ $item->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $item->title }}
                            </h5>

                            @if ($item->discount_price != null)
                            Discount Price <br>
                                <h6 style="color: red">
                                    {{ $item->discount_price }}
                                </h6>

                                 Price <br>
                                <h6 style="text-decoration: line-through; color:blue">
                                    {{ $item->price }}
                                </h6>
                            @else
                                <h6 style="color:blue">
                                    {{ $item->price }}
                                </h6>
                            @endif


                        </div>
                    </div>
                </div>
                {{-- <div class="btn-box">
            <a href="">
               View All products
            </a>
         </div> --}}
            @endforeach
            <span style="padding:20px">
            {{-- {!!$product->appends(Request::all())->links()!!} --}}
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
        </span>
         </div>
</section>
