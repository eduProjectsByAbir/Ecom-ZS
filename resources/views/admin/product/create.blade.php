@extends('admin.layouts.app')

@section('title')
Product List
@endsection

@section('content')
<x-admin.partials.breadcumb name="Product" />
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title" style="line-height: 36px;">Add Product</h4>
            <a href="{{ route('admin.product.index') }}"
                class="btn btn-rounded btn-warning float-right d-flex align-items-center justify-content-center"><i
                    class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group @error('name') has-error @enderror">
                            <label>Product Name <span class="color-red">*</span></label>
                            <input type="text" class="form-control" placeholder="Product Name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group @error('code') has-error @enderror">
                            <label>Product Code <span class="color-red">*</span></label>
                            <input type="text" class="form-control" placeholder="Product Code" name="code"
                                value="{{ old('code') }}">
                            @error('code')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group @error('brand_id') has-error @enderror">
                            <label>Brand <span class="color-red">*</span></label>
                            <select name="brand_id" id="brand" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group @error('category_id') has-error @enderror">
                            <label>Category <span class="color-red">*</span></label>
                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group @error('sub_category_id') has-error @enderror">
                            <label>Subcategory</label>
                            <select name="sub_category_id" id="subcategory" class="form-control">
                                <option value="">Select Subcategory</option>
                            </select>
                            @error('sub_category_id')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group @error('sub_subcategory_id') has-error @enderror">
                            <label>Sub Subcategory</label>
                            <select name="sub_subcategory_id" id="sub_subcategory" class="form-control">
                                <option value="">Select Sub Subcategory</option>
                            </select>
                            @error('sub_subcategory_id')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group @error('qty') has-error @enderror">
                            <label>Product Qunatity <span class="color-red">*</span></label>
                            <input type="number" class="form-control" placeholder="Product qunatity" name="qty"
                                value="{{ old('qty') }}">
                            @error('qty')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group @error('tags') has-error @enderror">
                            <label>Product Tags <span class="color-red">*</span></label>
                            <input type="text" class="form-control bootstrap-tagsinput" placeholder="Product Tags" name="tags"
                                value="{{ old('tags') }}" data-role="tagsinput">
                            @error('tags')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group @error('price') has-error @enderror">
                            <label>Product Price <span class="color-red">*</span></label>
                            <input type="number" class="form-control" placeholder="Product Price" name="price"
                                value="{{ old('price') }}">
                            @error('price')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group @error('discount_price') has-error @enderror">
                            <label>Discount Price</label>
                            <input type="text" class="form-control" placeholder="Product discount price"
                                name="discount_price" value="{{ old('discount_price') }}">
                            @error('discount_price')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group @error('short_description') has-error @enderror">
                            <label>Short Description <span class="color-red">*</span></label>
                            <input type="text" class="form-control" placeholder="Product short description"
                                name="short_description" value="{{ old('short_description') }}">
                            @error('short_description')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group @error('long_description') has-error @enderror">
                            <label>Long Description</label>
                            <textarea name="long_description" id="long_description" cols="30" rows="10"
                                class="form-control"
                                placeholder="Product long description">{{ old('long_description') }}</textarea>
                            @error('long_description')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group @error('product_thumbnail') has-error @enderror">
                            <label>Product Thumbnail <span class="color-red">*</span></label>
                            <input name="product_thumbnail" type="file" data-show-errors="true" data-width="50%" class="dropify text-center"
                                data-default-file="">
                            @error('product_thumbnail')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="row mt-4">
                            <div class="col-12 pt-2 m-2">
                                <input type="checkbox" value="1" name="hot_deals" id="hot_deals" class="filled-in chk-col-success" {{ old('hot_deals') ? 'checked' : '' }} />
                                <label for="hot_deals">Hot Deals</label>
                            </div>
                            <div class="col-12 m-2">
                                <input type="checkbox" value="1" name="featured" id="featured" class="filled-in chk-col-success" {{ old('featured') ? 'checked' : '' }} />
                                <label for="featured">Featured</label>
                            </div>
                            <div class="col-12 m-2">
                                <input type="checkbox" value="1" id="special_offer" name="special_offer" class="filled-in chk-col-success" {{ old('special_offer') ? 'checked' : '' }} />
                                <label for="special_offer">Special Offer</label>
                            </div>
                            <div class="col-12 m-2">
                                <input type="checkbox" value="1" id="special_deals" name="special_deals" class="filled-in chk-col-success" {{ old('special_deals') ? 'checked' : '' }} />
                                <label for="special_deals">Special Deals</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 m-auto"><button class="btn btn-rounded btn-success " type="submit">Submit</button></div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('backend/js/dropify/css/dropify.min.css') }}">
<style>
    .close-button {
        padding-right: 5px;
        margin-top: 2px;
    }

    .color-red {
        color: red;
    }

    .ck-editor__editable_inline {
        min-height: 170px;
    }

</style>
@endsection
@section('scripts')
<script src="{{ asset('backend/js/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/js/ckeditor.js') }}"></script>

<script>
    $('.dropify').dropify();
    ClassicEditor
        .create(document.querySelector('#long_description'))
        .catch(error => {
            console.error(error);
        });

        $(document).ready(function() {
            $('#category').on('change', function() {
                var category = this.value;
                Subcategory(category);
            });
        });

        function Subcategory(category) {
            $.ajax({
                url: "{{ route('admin.product.getSubcategories') }}",
                type: "POST",
                data: {
                    category_id: category,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(subcategories) {
                    $("#subcategory").empty();
                    $('#subcategory').append(`<option value="">Select Subcategory</option>`);
                    if (subcategories.length > 0) {
                        $.each(subcategories, function(key, value) {
                            $("#subcategory").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    }
                }
            });
        }

        $(document).ready(function() {
            $('#subcategory').on('change', function() {
                var sub_category = this.value;
                Sub_Subcategory(sub_category);
            });
        });

        function Sub_Subcategory(sub_category) {
            $.ajax({
                url: "{{ route('admin.product.getSub_subcategories') }}",
                type: "POST",
                data: {
                    sub_category_id: sub_category,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(subcategories) {
                    $("#sub_subcategory").empty();
                    $('#sub_subcategory').append(`<option value="">Select Sub Subcategory</option>`);
                    if (subcategories.length > 0) {
                        $.each(subcategories, function(key, value) {
                            $("#sub_subcategory").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    }
                }
            });
        }
</script>
@endsection
