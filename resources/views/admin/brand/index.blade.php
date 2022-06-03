@extends('admin.layouts.app')

@section('title')
Brand
@endsection

@section('content')
<x-admin.partials.breadcumb name="Brand" />
<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Brand List</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="2%">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                @empty
                                    <tr><td colspan="4">No data Found...</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Brand</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
@endsection
