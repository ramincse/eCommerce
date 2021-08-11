@extends('admin.admin_master')
@section('admin')   
<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Image</th>
                                        <th style="text-align: center;">Product Eng</th>
                                        <th style="text-align: center;">Price</th>
                                        <th style="text-align: center;">Quantity</th>
                                        <th style="text-align: center;">Discount</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)  
                                    <tr>
                                        <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                        <td style="text-align: center;"><img style="width: 60px; height:60px; border-radius:4px;" src="{{ asset($item->product_thumbnail) }}"></td>
                                        <td style="text-align: center;">{{ $item->product_name_eng }}</td>
                                        <td style="text-align: center;">{{ $item->selling_price }} $</td>
                                        <td style="text-align: center;">{{ $item->product_qty }}</td>
                                        <td style="text-align: center;">
                                            @if ($item->discount_price == NULL)
                                            <span class="badge badge-pill badge-success">No Discount</span>  
                                            @else
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;

                                                $discount = ($amount/$item->selling_price) * 100;
                                            @endphp
                                            <span class="badge badge-pill badge-success">{{ round($discount) }} %</span>  
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>  
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span> 
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-primary" href="{{ route('product.edit', $item->id) }}" title="Product Details"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-info" href="{{ route('product.edit', $item->id) }}" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a id="delete" class="btn btn-danger" href="{{ route('product.delete', $item->id) }}" title="Delete Data"><i class="fa fa-trash"></i></a>
                                            @if ($item->status == 1)
                                            <a class="btn btn-danger" href="{{ route('product.inactive', $item->id) }}" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a class="btn btn-success" href="{{ route('product.active', $item->id) }}" title="Active Now"><i class="fa fa-arrow-up"></i></a> 
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection