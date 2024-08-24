@extends('admin.layouts.app')

@section('title')
Edit new coupon
@endsection

@section('content')
<div class="row">
    @include('admin.layouts.sidebar')
    <div class="col-md-9">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card-header bg-white">
                    <h3 class="mt-2">Edit Coupon</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <form action="{{route('admin.coupons.update', $coupon->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-floating mb-3">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="name"
                                        value="{{$coupon->name,old('name')}}"
                                        >
                                    <label for="name">Name</label>
                                    @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="discount" name="discount" type="number"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        placeholder="Discount"
                                        value="{{$coupon->discount,old('discount')}}"
                                        >
                                    <label for="discount">Discount</label>
                                    @error('discount')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="valid_until" name="valid_until" type="datetime-local"
                                        value="{{$coupon->valid_until}}"
                                        class="form-control @error('valid_until') is-invalid @enderror"
                                        placeholder="Validity"
                                        >
                                    <label for="valid_until">Validity</label>
                                    @error('valid_until')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-lg btn-dark">
                                        Add Coupon
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection