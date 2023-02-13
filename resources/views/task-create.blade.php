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
                        <form class="form-horizontal" method="post" action="{{ route('admin.task.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="task_name" class="col-sm-2 col-form-label">Task Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control
                  is-invalid"
                                            id="task_name" name="task_name" placeholder="Enter task name"
                                            value="{{ old('task_name') }}" required>

                                    </div>
                                </div>


                                <div class="form-group row" id="roleField">
                                    <label for="name" class="col-sm-2 col-form-label">Projects</label>
                                    <div class="col-sm-3">
                                        <select
                                            class="form-control col-sm-4 is-invalid js-example-basic-single"
                                            name="id_project" id="id_project">
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
                                    <div class="col-sm-3">
                                      <input type="file" class="form-control" id="task_image" name="task_image"  placeholder="" value="{{ old('task_image') }}">
                                    </div>
                                  </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                                <a href="{{ route('admin.task') }}"><button type="button"
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
