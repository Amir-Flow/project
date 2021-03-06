 
@extends('layout.layout')
 
@section("content")

<div class="main-web">
    <!--  Main web  -->
    <div class="container">
        <div class="breadcrumb">
            <a href="#">{{ __("text.Store") }}</a>
            <a href="#">{{ __("text.cart") }} </a>
            <span>{{ __("text.confirm_order") }}</span>

        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('payment') }}" method="POST">
        @csrf
        <div class="row container-confirm-form">

            <div class="col-md-9 right-details  confirm-right confirm-form">
                <!-- Prosnal data Block -->
                <div class="block-form">
                    <h4>{{ __("text.personal_information") }} </h4>
                    <div class="data-block-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="name" class="form-control"
                                 placeholder="الإسم" value="{{ old('name', ((Auth::user() && $profile) ? $profile->name : ''))  }}">

                                   
                            </div>
                            <div class="col">
                                <input type="text" name="phone" class="form-control" placeholder="رقم الجوال"  value="{{old('phone', ((Auth::user() && $profile) ? $profile->phone : ''))}}">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact  Addess  -->
                <div class="block-form">
                    <h4>عنوان التوصيل</h4>
                    <div class="data-block-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="province" class="form-control" placeholder="المنطقة"  value="{{  old('province', ((Auth::user() && $profile)? $profile->province : '')) }}">

                            </div>
                            <div class="col">
                                <input type="text" name="city" class="form-control" placeholder="المدينة"  value="{{ old('city', ((Auth::user() && $profile)? $profile->city : ''))}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="block" class="form-control" placeholder="الحي"  value="{{old('block', ((Auth::user() && $profile)? $profile->block : ''))}}">
                            </div>
                            <div class="col">
                                <input type="text" name="street" class="form-control" placeholder="الشارع"  value="{{old('street', ((Auth::user() && $profile)? $profile->street : ''))}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <textarea class="form-control" name="place_extra" id="exampleFormControlTextarea1" rows="3" placeholder="{{ __("text.place_extra") }}">
                                     {{ old('place_extra',
                                      ((Auth::user() && $profile)? $profile->place_extra : '' )) }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method  -->
                <div class="block-form wiht-out-bgheader">
                    <h4>طريقة الدفع</h4>
                    <div class="data-block-form">

                        <div class="form-row">
                            <div class="col">
                                <input type="radio" id="payment1" value="0" name="payment_method" class="custom-control-input"   {{ old('payment_method') == "0" ? 'checked' : '' }} >
                                <label class="custom-control-label" for="payment1">الدفع كاش عند الإستلام</label>
                            </div>
                            <div class="col">
                                <input type="radio" id="payment2" value='1' name="payment_method" class="custom-control-input" {{ old('payment_method') == "1" ? 'checked' : ''}}>
                                <label class="custom-control-label" for="payment2">
                                    الدفع أونلاين عن طريق بطاقة فيزا أو مدى
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

        
   <!-- details-order-blocks -->
   <div class="details-order-blocks">
    <div class="order-blocks">
        <h4>تفاصيل الطلب</h4>

        <div class="item-order-details-block">
           @foreach (Cart::content() as $item)
           @php
                            $image = json_decode($item->model->image);
                 @endphp
                <!-- Item -->
            <div class="item-order-details">
                <div class="col-md-2 img-pro-cart">
                    <img src="{{ URL::asset('storage/'.$image[0]) }}" height="100" width="100" />
                </div>

                <div class="col-md-6 products-name-data">
                    <div class="name-product"> {{ $item->name  }} </div>
                </div>
                <div class="col-md-2 quantity-numner-details"><span> {{ $item->qty }} </span></div>
                <div class="col-md-2 price-product-order">{{ $item->price }} ر.س</div>
            </div>
           @endforeach

        </div>
    </div>
    <div class="totlal-order-bootom">
        الإجمالي: <span>{{ Cart::Total() }} ر.س</span>
    </div>
</form>
</div>


         
        </div>
   <!-- Left Cart -->
   <div class="col-md-3 left-details cart-left  confirm-left">
    <div class="details-products-block-left  left-cart-block left-confirm-block  block-coupon">
        <h6>{{ __("text.have_coupon") }}</h6>
        <form method="post" action="{{ route('add_coupon') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="الرجاء إدخال الكوبون">
            </div>
            <button type="submit" class="btn-link-confirm">تفعيل الكوبون</button>
        </form>

    </div>
    <div class="details-products-block-left  left-cart-block left-confirm-block block-total-confirm ">
        @if (Session()->has("coupon"))
        
        <div class="total-confirm">التخفيض: {{ Session()->get("coupon")['name']}} <span class="price-total-confirm">{{ Session()->get("coupon")['discount']}} ر.س</span></div>
        @endif
        <div class="total-confirm">التوصيل: <span class="price-total-confirm">{{ $shipping }} ر.س</span></div>

        <div class="total-confirm">الإجمالي: <span class="price-total-confirm">{{ $newTotal }} ر.س</span></div>
        <p>بالضغط على تأكيد الطلب أقر بأنني قرأت وفهمت كل ما يتعلق بالشروط و الأحكام.</p>
    <button type="submit" class="btn-link-confirm">تأكيد الطلب</a>

    </div>




</form></div>
    </div>
    <!-- service shop block -->
    <div class="service-shop-block service-footer-shop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 items-service-shop wow zoomIn animated " data-wow-delay="0.2s">
                    <img src="{{ asset("assets/images/connecting-icon.svg") }}" />
                <h3>{{ __("text.get_branch") }}</h3>
                    <p>{{ __("text.free_shipping") }}</p>
                </div>

                <div class="col-md-3 items-service-shop wow zoomIn animated " data-wow-delay="0.4s">
                    <img src="{{ asset("assets/images/return.svg") }}" />
                    <h3>{{ __("text.refund") }}</h3>
                    <p>{{ __("text.refund_policy") }}</p>
                </div>

                <div class="col-md-3 items-service-shop wow zoomIn animated " data-wow-delay="0.6s">
                    <img src="{{ asset("assets/images/security-icon.svg") }}" />
                <h3>{{ __("text.secure-payment") }}</h3>
                <p>{{ __("text.accepted-cards") }}</p>
                </div>

                <div class="col-md-3 items-service-shop wow zoomIn animated " data-wow-delay="0.8s">
                    <img src="{{ asset("assets/images/client-service.svg") }}" />
                    <h3>{{ __("text.customer-service") }}</h3>
                    <p>{{ __("text.available-247") }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End service shop block -->

</div>
<!-- End  Main web  -->


@endsection
