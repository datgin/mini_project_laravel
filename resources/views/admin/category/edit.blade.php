@extends('admin.layout.master')

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Add Category</h1>
                    <p class="breadcrumbs"><span><a href="{{ route('admin.index') }}">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Add Category
                    </p>
                </div>
                <div>
                    <a href="{{ route('category.index') }}" class="btn btn-primary">All category</a>
                </div>

            </div>
            <div class="row">
                <div class="col-xl-8 offset-lg-2 col-lg-12">
                    <div class="ec-cat-list card card-default mb-24px">
                        <div class="card-body">
                            <div class="ec-cat-form">
                                <h4>Add New Category</h4>

                                <form class="row" action="{{ route('category.update', $category->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group col-6 ">
                                        <label for="text" class="col-form-label">Category name</label>
                                        <input name="name" class="form-control here slug-title" type="text"
                                            id="slug" placeholder="Enter category name" onkeyup="ChangeToSlug()"
                                            value="{{ $category->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label for="slug" class="col-form-label">Slug</label>
                                        <div class="col-12">
                                            <input name="slug" class="form-control here set-slug" type="text"
                                                id="convert_slug" placeholder="Enter slug" value="{{ $category->slug }}">
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group col-6">
                                        <label for="" class="col-form-label">Children Category </label>
                                        <select name="parent_id" id="parent_id" class="form-select">
                                            <option value="">--Select One--</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ $category->parent_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label class=" col-form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input name="status" class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked" {{ $category->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="row">
                                        <div class="col-12">
                                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
@endsection
