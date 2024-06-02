@extends('admin.layout.master')

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                <div>
                    <h1>All products</h1>
                    <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Product
                    </p>
                </div>
                <div>
                    <a href="{{ route('product.create') }}" class="btn btn-primary"> Add Porduct</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Product name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($products as $key => $item)
                                            <tr>
                                                <td>#{{ $item->id }}</td>
                                                <td><img class="tbl-thumb" src="{{ asset($item->image) }}"
                                                        alt="Product Image" /></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->content }}</td>
                                                <td>
                                                    {!! $item->status
                                                        ? '<span class="badge bg-success">Active</span>'
                                                        : '<span class="badge bg-danger">Inactive</span>' !!}
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-1">
                                                        <button type="button" class="btn btn-outline-success">Info</button>
                                                        <button type="button"
                                                            class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-display="static">
                                                            <span class="sr-only">Info</span>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Edit</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr></tr>
                                            <td colspan="9" class="text-center">No matching records found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
@endsection

@section('css')
    <!-- Data Tables -->
    <link href='{{ asset('admin-assets/assets/plugins/data-tables/datatables.bootstrap5.min.css') }}' rel='stylesheet'>
    <link href='{{ asset('admin-assets/assets/plugins/data-tables/responsive.datatables.min.css') }}' rel='stylesheet'>
@endsection

@section('script')
    <!-- Data Tables -->
    <script src='{{ asset('admin-assets/assets/plugins/data-tables/jquery.datatables.min.js') }}'></script>
    <script src='{{ asset('admin-assets/assets/plugins/data-tables/datatables.bootstrap5.min.js') }}'></script>
    <script src='{{ asset('admin-assets/assets/plugins/data-tables/datatables.responsive.min.js') }}'></script>

    <!-- Option Switcher -->
    <script src="{{ asset('admin-assets/assets/plugins/options-sidebar/optionswitcher.js') }}"></script>
@endsection
