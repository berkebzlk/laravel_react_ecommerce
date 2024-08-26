@extends('admin.layouts.app')

@section('title')
Add new product
@endsection

@section('content')
<div class="row">
    @include('admin.layouts.sidebar')
    <div class="col-md-9">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card-header bg-white">
                    <h3 class="mt-2">Add Product</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="name"
                                        value="{{old('name')}}">
                                    <label for="name">Name</label>
                                    @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="qty" name="qty" type="number"
                                        class="form-control @error('qty') is-invalid @enderror" placeholder="Quantity"
                                        value="{{old('qty')}}">
                                    <label for="name">Quantity</label>
                                    @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="price" name="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" placeholder="Price"
                                        value="{{old('price')}}">
                                    <label for="name">Price</label>
                                    @error('price')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="color_id" class="my-2">Choose a color</label>
                                    <select name="color_id[]" id="color_id" multiple
                                        class="form-control @error('color_id') is-invalid @enderror">
                                        @foreach ($colors as $color)
                                        <option value="{{$color->id}}" @if(collect(old('color_id'))->
                                            contains($color->id)) selected @endif
                                            value="{{$color->id}}"
                                            >
                                            {{$color->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('color')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="size_id" class="my-2">Choose a size</label>
                                    <select name="size_id[]" id="size_id" multiple
                                        class="form-control @error('size_id') is-invalid @enderror">
                                        @foreach ($sizes as $size)
                                        <option value="{{$size->id}}" @if(collect(old('size_id'))->contains($size->id))
                                            selected @endif
                                            value="{{$size->id}}"
                                            >
                                            {{$size->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="my-2" for="desc">Description</label>
                                    <textarea id="desc" name="desc" type="text"
                                        class="summernote form-control @error('desc') is-invalid @enderror"
                                        placeholder="Description">
                                    {{old('desc')}}
                                    </textarea>
                                    @error('desc')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="my-2" for="thumbnail">Thumbnail</label>
                                    <input id="thumbnail" name="thumbnail" type="file"
                                        class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Thumbnail"
                                        value="{{old('thumbnail')}}">
                                    @error('thumbnail')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <img src="#" id="thumbnail_preview"
                                    class="d-none img-fluid rounded mb-2"
                                    width="100"
                                    height="100"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label class="my-2" for="first_image">First Image</label>
                                    <input id="first_image" name="first_image" type="file"
                                        class="form-control @error('first_image') is-invalid @enderror" placeholder="First Image"
                                        value="{{old('first_image')}}">
                                    @error('first_image')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <img src="#" id="first_image_preview"
                                    class="d-none img-fluid rounded mb-2"
                                    width="100"
                                    height="100"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label class="my-2" for="second_image">Second Image</label>
                                    <input id="second_image" name="second_image" type="file"
                                        class="form-control @error('second_image') is-invalid @enderror" placeholder="Second Image"
                                        value="{{old('second_image')}}">
                                    @error('second_image')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <img src="#" id="second_image_preview"
                                    class="d-none img-fluid rounded mb-2"
                                    width="100"
                                    height="100"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label class="my-2" for="third_image">Third Image</label>
                                    <input id="third_image" name="third_image" type="file"
                                        class="form-control @error('third_image') is-invalid @enderror" placeholder="Third Image"
                                        value="{{old('third_image')}}">
                                    @error('third_image')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <img src="#" id="third_image_preview"
                                    class="d-none img-fluid rounded mb-2"
                                    width="100"
                                    height="100"
                                    >
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-lg btn-dark">
                                        Add Color
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