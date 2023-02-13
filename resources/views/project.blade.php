@extends('layouts.master')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::has('status'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}
                                </p>
                            @endif
                            <div class="row mb-2">
                                <div class="col justify-content-between mb-2">

                                    <a href="{{ route('admin.project.create') }}">
                                        <button type="button" class="btn btn-outline-success float-left">Create
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Projects</h3>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Project Name</th>
                                        <th>Created_at</th>
                                        <th>Created by</th>
                                        <th>Assign user</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($projects))
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $project->name }}</td>
                                                <td>
                                                    {{ $project->created_at }}
                                                </td>
                                                <td>{{ \App\Models\User::where('id', $project->created_by)->pluck('name') }}
                                                </td>
                                                <td>
                                                    @foreach ($project->projectAssign as $project_assign)
                                                        <span class="">{{ $project_assign['user_name'] }} | </span>
                                                    @endforeach
                                                </td>
                                                <td><a
                                                        href="{{ route('admin.project.edit', ['id' => $project->id]) }}">View</a>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->



            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
