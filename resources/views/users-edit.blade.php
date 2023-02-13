@extends('layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card mt-1">
                <div class="card-header bg-info">
                    <h3 class="card-title">User Edit</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('admin.users.update') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-3">
                               <span>{{ $user->name }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-3">
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-3">
                                <span>{{ $user->type }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is active" class="col-sm-2 col-form-label">Is Active</label>
                            <div class="col-sm-4">

                                            <select
                                                class="form-control col-sm-4 @error('is_active') is-invalid @enderror"
                                                name="is_active" id="is_active">
                                                <option value="1" {{ $user->is_active==1 ? 'selected': ''}}>
                                                    Active
                                                </option>
                                                <option value="0" {{ $user->is_active==0 ? 'selected': ''}}>
                                                    InActive
                                                </option>

                                            </select>
                                            @error('is_active')
                                            <span class="error invalid-feedback"></span>
                                            @enderror
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-info">Update</button>
                        <a href="{{route('admin.users')}}">
                            <button type="button" class="btn btn-outline-primary float-right">Back</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
