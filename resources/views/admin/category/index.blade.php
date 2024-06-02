@extends('admin.layout.master')

@section('content')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>All Category</h1>
                    <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>All Category
                    </p>
                </div>

                <div>
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Add category</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="ec-cat-list card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Parent Category</th>
                                            <th>Products</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($categories as $key => $item)
                                            <tr>
                                                <td>#00{{ $key + 1 }} </td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->parent_id !== null)
                                                        @foreach ($categories as $parentCategory)
                                                            @if ($parentCategory->id == $item->parent_id)
                                                                {{ $parentCategory->name }}
                                                            @endif
                                                        @endforeach
                                                    @else
                                                      N/A
                                                    @endif

                                                </td>
                                                <td>{{ $item->product->count() }}</td>
                                                <td>{!! $item->status
                                                    ? '<span class="badge bg-success">Active</span>'
                                                    : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success">Info</button>
                                                        <button type="button"
                                                            class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-display="static">
                                                            <span class="sr-only">Info</span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('category.edit', $item->id) }}">Edit</a>
                                                            <form action="{{ route('category.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="return confirm('Are you sure?')"
                                                                    class="dropdown-item" type="submit">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            @empty
                                            <tr class="odd">
                                                <td valign="top" colspan="5" class="dataTables_empty text-center">No
                                                    data available
                                                    in table</td>
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
