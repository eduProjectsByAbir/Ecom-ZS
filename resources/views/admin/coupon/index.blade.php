@extends('admin.layouts.app')

@section('title')
Coupon
@endsection

@section('content')
<x-admin.partials.breadcumb name="Coupon" />
<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Coupon List ({{ $coupons->total() ?? '0' }}) </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <table class="table mb-0 table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="2%">#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Discount (%)</th>
                                    <th scope="col">Expire</th>
                                    <th scope="col">Limit</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                <tr>
                                    <th scope="row">{{ $coupon->id }}</th>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->coupon_discount }}%</td>
                                    <td>{!! $coupon->expired ? '<span class="badge badge-danger">Expired</span>' : $coupon->coupon_expire !!}</td>
                                    <td>{{ $coupon->coupon_limit ?? 'Unlimited' }}</td>
                                    <td>{!! $coupon->status == 1 ? '<span class="badge badge-success">Valid</span>' : '<span class="badge badge-danger">Expired</span>' !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn {{ $coupon->status == 1 ? 'btn-secondary' : 'btn-success' }}" title="Change Status"
                                                style="margin-right: 3px; border-radius: 4px !important;"
                                                href="{{ route('admin.coupon.toggle.status', $coupon->id) }}"><i
                                                    class="fa {{ $coupon->status == 1 ? 'fa-times color-black' : 'fa-check color-red' }}" aria-hidden="true"></i></a>
                                            <a class="btn btn-warning" title="Edit"
                                                style="margin-right: 3px; border-radius: 4px !important;"
                                                href="{{ route('admin.coupon.edit', $coupon->id) }}"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="{{ route('admin.coupon.delete', $coupon->id) }}"
                                                method="post"> @method('delete') @csrf
                                                <button type="submit" class="btn btn-danger delete-confirm"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></button>
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
                            {{ $coupons->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            @if (empty($couponData) && userCan('coupon.create'))
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Coupon</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.coupon.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_code') has-error @enderror">
                                    <label>Coupon Code <span class="color-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Coupon Code"
                                            name="coupon_code" id="coupon_code" value="{{ old('coupon_code') }}">
                                        <div class="input-group-append">
                                            <button type="button"
                                                class="btn btn-rounded btn-info btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">Generate</button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                style="will-change: transform; padding:6px;">
                                                <button type="button" class="dropdown-item btn btn-secondary" onclick="generateCode(4)">4 Char
                                                    Code</button>
                                                <button type="button" class="dropdown-item btn btn-success"
                                                    style="margin-left: 3px;" onclick="generateCode(6)">6 Char Code</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('coupon_code')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_discount') has-error @enderror">
                                    <label>Coupon Discount <span class="color-red">*</span></label>
                                    <input type="number" class="form-control" placeholder="Coupon Discount Percentage"
                                        name="coupon_discount" max="100" min="1" value="{{ old('coupon_discount') }}">
                                    @error('coupon_discount')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_expire') has-error @enderror">
                                    <label>Expire Date <span class="color-red">*</span></label>
                                    <input type="date" class="form-control" placeholder="Coupon Expire Date"
                                        name="coupon_expire" value="{{ old('coupon_expire', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                                    @error('coupon_expire')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_limit') has-error @enderror">
                                    <label>Coupon Limit</label>
                                    <input type="number" class="form-control" placeholder="Coupon Limit"
                                        name="coupon_limit" value="{{ old('coupon_limit') }}">
                                    @error('coupon_limit')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if (userCan('coupon.store'))
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Create
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
            @if (!empty($couponData) && userCan('coupon.edit'))
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title" style="line-height: 36px;">Update Coupon</h4>
                    <a href="{{ route('admin.coupon.index') }}"
                        class="btn btn-rounded btn-warning btn-outline float-right d-flex align-items-center justify-content-center"><i
                            class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.coupon.update', $couponData->id) }}">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_code') has-error @enderror">
                                    <label>Coupon Code <span class="color-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Coupon Code"
                                            name="coupon_code" id="coupon_code" value="{{ old('coupon_code', $couponData->coupon_code) }}">
                                        <div class="input-group-append">
                                            <button type="button"
                                                class="btn btn-rounded btn-info btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">Generate</button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                style="will-change: transform; padding:6px;">
                                                <button type="button" class="dropdown-item btn btn-secondary" onclick="generateCode(4)">4 Char
                                                    Code</button>
                                                <button type="button" class="dropdown-item btn btn-success"
                                                    style="margin-left: 3px;" onclick="generateCode(6)">6 Char Code</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('coupon_code')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_discount') has-error @enderror">
                                    <label>Coupon Discount <span class="color-red">*</span></label>
                                    <input type="number" class="form-control" placeholder="Coupon Discount Percentage"
                                        name="coupon_discount" max="100" min="1" value="{{ old('coupon_discount', $couponData->coupon_discount) }}">
                                    @error('coupon_discount')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_expire') has-error @enderror">
                                    <label>Expire Date <span class="color-red">*</span></label>
                                    <input type="date" class="form-control" placeholder="Coupon Expire Date"
                                        name="coupon_expire" value="{{ old('coupon_expire', $couponData->coupon_expire) }}">
                                    @error('coupon_expire')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('coupon_limit') has-error @enderror">
                                    <label>Coupon Limit</label>
                                    <input type="number" class="form-control" placeholder="Coupon Limit"
                                        name="coupon_limit" value="{{ old('coupon_limit', $couponData->coupon_limit) }}">
                                    @error('coupon_limit')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if (userCan('coupon.update'))
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
    
    .color-green {
        color: green;
    }

    .color-black {
        color: black;
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
        }).then(function (value) {
            if (value) {
                form.submit();
            }
        });
    });

</script>

<script>
    // declare all characters
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    function generateCode(length) {
        let result = ' ';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        $('#coupon_code').val(result);
    }
</script>
@endsection
