@extends('layouts.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}
        </p>
    @endif
      <!-- Small boxes (Stat box) -->
      @if(Auth::user()->type=='admin')
      <div class="row">

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ \App\Models\User::count() }}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
             </div>
             @endif
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
@endsection
