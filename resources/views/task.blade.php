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
                            @if (Auth::user()->type != 'admin')
                            <div class="row mb-2">
                                <div class="col justify-content-between mb-2">

                                    <a href="{{ route('admin.task.create') }}">
                                        <button type="button" class="btn btn-outline-success float-left">Create
                                        </button>
                                    </a>

                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Tasks</h3>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Task Name</th>
                                        <th>Created_at</th>
                                        <th>Created by</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($tasks))
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $task->task_name }}</td>
                                                <td>{{ $task->created_at }}</td>
                                                <td>{{ \App\Models\User::where('id', $task->created_by)->pluck('name')->first() }}
                                                </td>
                                                <td>{{ \App\Models\Project::where('id', $task->id_project)->pluck('name')->first() }}
                                                </td>

                                                <td>
                                                    @php
                                                        $status=\App\Models\TaskHistory::where('id_tasks',$task->id)->pluck('status')->first();
                                                    @endphp
                                                    {{ ($status==0)?'Not Started':(($status==1)?'Started':'Completed') }}
                                                </td>
                                                <td><a
                                                        href="{{ route('admin.task.view', ['id' => $task->id]) }}">View</a>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <div class="d-flex">

                            </div>
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
