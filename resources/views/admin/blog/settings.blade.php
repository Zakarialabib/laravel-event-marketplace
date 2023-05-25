@extends('layouts.dashboard')

@section('content')

<div class="content-area">

    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Blog Settings') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Blog') }}</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Blog Settings') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="add-product-content1 add-product-content2">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area">
                        <div class="gocover"
                            style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                        </div>
                        <form action="{{ route('admin-gs-update') }}" id="geniusform" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <x-form-alert />                                

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Display Posts Per Page') }} *
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" class="input-field" placeholder="{{ __('Display Posts Per Page') }}" name="post_count" 
                                    value="{{ $gs->post_count }}" required="" min="0">
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="left-area">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection