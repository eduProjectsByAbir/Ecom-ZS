@extends('admin.layouts.app')

@section('title')
Sub Subcategory
@endsection

@section('content')
<x-admin.partials.breadcumb name="Subcategory" />
<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Sub Subcategory List ({{ $sub_subcategories->total() ?? '0' }}) </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <table class="table mb-0 table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="2%">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Subcategory</th>
                                    <th scope="col" width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sub_subcategories as $subcategory)
                                <tr>
                                    <th scope="row">{{ $subcategory->id }}</th>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->subcategory->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" style="margin-right: 3px; border-radius: 4px !important;"
                                                href="{{ route('admin.sub.subcategory.edit', $subcategory->slug) }}"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="{{ route('admin.sub.subcategory.delete', $subcategory->slug) }}"
                                                method="post"> @method('delete') @csrf
                                                <button type="submit" class="btn btn-danger delete-confirm"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No data Found...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row justify-content-center align-items-center pt-10">
                            {{ $sub_subcategories->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            @if (empty($subcategoryData) && userCan('subsubcategory.create'))
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Subcategory</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.sub.subcategory.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('name') has-error @enderror">
                            <label>Name <span class="color-red">*</span></label>
                            <input type="text" class="form-control" placeholder="Sub Subcategory Name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('sub_category_id') has-error @enderror">
                            <label>Category <span class="color-red">*</span></label>
                            <select name="sub_category_id" id="category" class="form-control">
                                <option value="">Select Subcategory</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('sub_category_id')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if (userCan('subsubcategory.store'))
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                        </button>
                        @else
                        <div class="box-body">
                            <b class="text-center color-red">You don't have permission!</b>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            @endif
            <!-- /.box-body -->
            @if (!empty($subcategoryData) && userCan('subsubcategory.edit'))
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title" style="line-height: 36px;">Update Sub Subcategory</h4>
                    <a href="{{ route('admin.sub.subcategory.index') }}"
                        class="btn btn-rounded btn-warning btn-outline float-right d-flex align-items-center justify-content-center"><i
                            class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.sub.subcategory.update', $subcategoryData->slug) }}">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('name') has-error @enderror">
                            <label>Name <span class="color-red">*</span></label>
                            <input type="text" class="form-control" placeholder="Category Name" name="name"
                                value="{{ old('name', $subcategoryData->name) }}">
                            @error('name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('sub_category_id') has-error @enderror">
                            <label>Category <span class="color-red">*</span></label>
                            <select name="sub_category_id" id="category" class="form-control">
                                <option value="">Select Subcategory</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $subcategoryData->sub_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('sub_category_id')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if (userCan('subsubcategory.update'))
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="fa fa-refresh"></i> Update
                        </button>
                        @else
                        <div class="box-body">
                            <b class="text-center color-red">You don't have permission!</b>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .close-button {
        padding-right: 5px;
        margin-top: 2px;
    }

    .color-red {
        color: red;
    }

</style>
@endsection
@section('scripts')
<script src="{{ asset('backend/js/sweetalert/sweetalert.min.js') }}"></script>

<script>
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const form = event.target.form;
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Delete!"],
        dangerMode: true,
    }).then(function(value) {
        if (value) {
            form.submit();
        }
    });
});
</script>
@endsection
