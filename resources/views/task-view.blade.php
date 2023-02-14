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
                            <h3 class="card-title">Task Summery</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-2">Task Start:</label>
                                <div class="col-sm-3">
                                    <span class="text-info">
                                        @foreach ($task->taskHistory as $item)
                                            {{ $item->task_start }}
                                        @endforeach
                                    </span>

                                </div>
                                <label for="task_name" class="col-sm-1">Task End:</label>
                                <div class="col-sm-3">
                                    <span class="text-info">
                                        @foreach ($task->taskHistory as $item)
                                            {{ $item->task_end }}
                                        @endforeach
                                    </span>

                                </div>
                                <label for="task_name" class="col-sm-1">Created by:</label>
                                <div class="col-sm-2">
                                    <span>

                                        {{ \App\Models\User::where('id', $task->created_by)->pluck('name')->first() }}

                                    </span>

                                </div>



                            </div>
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-2">Total duration:</label>
                                <div class="col-sm-3">
                                    <p class="text-info">

                                        @foreach ($task->taskHistory as $item)
                                            @php
                                                $start = new \Carbon\Carbon($item->task_start);
                                                $end = new \Carbon\Carbon($item->task_end);
                                                $diff = $start->diff($end)->format('%H:%I:%S');
                                                $total = new \Carbon\Carbon($diff);
                                            @endphp


                                            {{ $start->diff($end)->format('%H:%I:%S') }}
                                        @endforeach
                                    </p>

                                </div>
                                <label for="task_name" class="col-sm-2">BreakDuration:</label>
                                <div class="col-sm-3">
                                    <span class="text-info">
                                        @foreach ($task->taskHistory as $item)
                                            @php
                                                $start = new \Carbon\Carbon($item->break_start);
                                                $end = new \Carbon\Carbon($item->break_end);
                                            @endphp
                                            {{ $start->diff($end)->format('%H:%I:%S') }}
                                        @endforeach
                                    </span>

                                </div>
                                <label for="task_name" class="col-sm-3">Total duration without break:</label>
                                <div class="col-sm-3">
                                    <p class="text-info">

                                        @foreach ($task->taskHistory as $item)
                                            @php
                                                $start = new \Carbon\Carbon($item->task_start);
                                                $end = new \Carbon\Carbon($item->task_end);
                                                $diff = $start->diff($end)->format('%H:%I:%S');
                                                $total = new \Carbon\Carbon($diff);
                                            @endphp
                                            @if ($item->break_end != null && $item->task_end != null)
                                                @php
                                                    $endBreak = new \Carbon\Carbon($item->break_end);
                                                    $startBreak = new \Carbon\Carbon($item->break_start);
                                                    $totalBreak = $startBreak->diff($endBreak)->format('%H:%I:%S');
                                                    $totalBreak = new \Carbon\Carbon($totalBreak);

                                                @endphp
                                                {{ $total->diff($totalBreak)->format('%H:%I:%S') }}
                                            @else
                                                {{ $start->diff($end)->format('%H:%I:%S') }}
                                            @endif
                                        @endforeach
                                    </p>

                                </div>


                            </div>
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-3">Status:</label>
                                <div class="col-sm-3">
                                    <span class="text-warning">
                                        @foreach ($task->taskHistory as $item)
                                            {{ $item->status == 0 ? 'Not Started' : ($item->status == 1 ? 'Started' : 'Completed') }}
                                        @endforeach
                                    </span>

                                </div>
                            </div>
                        </div>
                        <!-- form start -->


                    </div>
                    <!-- /.card-info task -->
                    <div class="card-header">

                        <h3 class="card-title">Task Details</h3>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-2 col-form-label">Project Name</label>
                                <div class="col-sm-4">
                                    <span
                                        class="form-control">{{ \App\Models\Project::where('id', $task->id_project)->pluck('name')->first() }}</span>

                                </div>
                                <label for="task_name" class="col-sm-2 col-form-label">Task Name</label>
                                <div class="col-sm-4">
                                    <span class="form-control">{{ $task->task_name }}</span>

                                </div>
                            </div>
                            <div class="form-group row">
                                {{-- <label for="task_name" class="col-sm-2 col-form-label">Details</label>
                                <div class="col-sm-4">
                                    <span class="form-control">
                                        @foreach ($task->taskHistory as $item)
                                            {{ $item->task_details }}
                                        @endforeach
                                    </span>
                                </div> --}}
                                <label for="task_name" class="col-sm-2 col-form-label">Task Attachment</label>
                                <div class="col-sm-4">
                                    @foreach ($task->taskInfo as $item)
                                        @if ($item->file_name != null)
                                            <a
                                                href="{{ URL::to('/download/')."/".$item->file_name }}">Download</a>
                                        @endif
                                    @endforeach

                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-2 col-form-label">Location Information</label>
                                <div class="col-sm-2">
                                    @foreach ($task->taskInfo as $item)
                                        <span class="">
                                            {{ isset($item->location_information->countryName) ? 'country:' . $item->location_information->countryName : '' }}
                                        </span>
                                        <span class="">
                                            {{ isset($item->location_information->cityName) ? 'cityName:' . $item->location_information->cityName : '' }}
                                        </span>
                                        <span class="">
                                            {{ isset($item->location_information->latitude) ? 'latitude:' . $item->location_information->latitude : '' }}
                                        </span>
                                        <span class="">
                                            {{ isset($item->location_information->longitude) ? 'longitude:' . $item->location_information->longitude : '' }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>




                        </div>
                        <!-- form start -->

                        @if (Auth::user()->type != 'admin')
                            <!-- /.card-body -->
                            <div class="card-footer">

                                @if (isset($task->taskHistory[0]) && $task->taskHistory[0]->status != 2)
                                    @foreach ($task->taskHistory as $item)
                                        @if ($item->task_start == null && $item->task_end == null)
                                            <a href="{{ route('admin.task.start', ['id' => $task->id]) }}"><button
                                                    type="button" class="btn btn-outline-success">Task Start</button></a>
                                        @elseif($item->task_start != null && $item->task_end == null)
                                            <a href="{{ route('admin.task.stop', ['id' => $task->id]) }}"><button
                                                    type="button" class="btn btn-outline-success">Task Stop</button></a>
                                        @else
                                        @endif
                                        @if ($item->task_start != null && $item->break == null && $item->task_end == null)
                                            <a href="{{ route('admin.task.breakStart', ['id' => $task->id]) }}"><button
                                                    type="button" class="btn btn-outline-success">Task Break</button></a>
                                        @else
                                            <a href="{{ route('admin.task.breakEnd', ['id' => $task->id]) }}"><button
                                                    type="button" class="btn btn-outline-success">Task Break
                                                    Resume</button></a>
                                        @endif
                                    @endforeach
                                @elseif(isset($task->taskHistory[0]) && $task->taskHistory[0]->status == 2)
                                @else
                                    <a href="{{ route('admin.task.start', ['id' => $task->id]) }}"><button type="button"
                                            class="btn btn-outline-success">Task Start</button></a>
                                @endif


                            </div>
                            <!-- /.card-footer -->
                        @endif
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
