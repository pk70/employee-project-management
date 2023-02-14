@extends('layouts.master')
@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Is Active</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($users))
                    @php
                       $i=1;
                    @endphp
                    @foreach ($users as $user )
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>{{ $user->is_active }}</td>
                        <td>{{ $user->type }}</td>
                        <td><a href="{{ route('admin.users.edit',['id'=>$user->id]) }}">View</a></td>
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

