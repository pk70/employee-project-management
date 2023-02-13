@extends('layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <!-- /.card -->
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h3 class="card-title">Project Create</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="{{ route('admin.project.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control
                  is-invalid"
                                            id="name" name="name" placeholder="Enter category name"
                                            value="{{ $project->name }}" required>

                                    </div>
                                </div>


                                <div class="form-group row" id="roleField">
                                    <label for="name" class="col-sm-2 col-form-label">Assign users</label>
                                    <div class="col-sm-3">
                                        <select
                                            class="form-control col-sm-4 js-attribute-basic-multiple is-invalid js-example-basic-single"
                                            name="assign_user[]" id="assign_user" multiple="true">
                                            @foreach ($users as $key => $user)
                                                <option
                                                    value="{{ $project->projectAssign[$key]->assigned_user_id }}"{{ $user->id == $project->projectAssign[$key]->assigned_user_id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <input type="hidden" value="{{ $project->id }}" name="id_project">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-success">Update</button>
                                <a href="{{ route('admin.project') }}"><button type="button"
                                        class="btn btn-outline-primary float-right">Back</button></a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
