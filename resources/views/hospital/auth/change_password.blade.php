@extends('hospital/layout/master')
@section('content')

<div class="main-content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-12">
                <!--offset-md-1-->
                <div class="card" style="min-height: 390px;">
                    <div class="card-header font-weight-bold">
                        <h2>Change Password</h2>

                    </div>
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-4 offset-md-4">
                                <form method="POST" action="{{route('hospital.change.password.action')}}">
                                    @csrf
                                    @method('PUT')

                              
                                    @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                    @endforeach

                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input name="old_password" type="password" class="form-control form-control-danger">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input name="new_password" type="password" class="form-control form-control-primary">
                                    </div>
                                    <div class="form-group">
                                        <label>Re Enter New Password</label>
                                        <input name="new_confirm_password" type="password" class="form-control form-control-primary">
                                    </div>

                                    <button type="submit" class="btn btn-info">Change</button>
                                </form>
                           </div>
                       </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
