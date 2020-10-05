
 @include('layouts.app')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        {!! Form::model($user, ['enctype'=>'multipart/form-data','route' => ['user.update'], 'method' => 'POST']) !!}
                        <div class="form-group row" >
                        <div class="col-sm-2">
                            <div class="form-group row" >
                                        @csrf
                                        <!-- <input type="file" name="image" /> -->
                                        <img src="/avatar/{{$user->avatar}}" style=" width:150px; height=150px">
                                        
                                            <div class="col-sm-10">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group row">
                                        {!! Form::file('avatar',null, ['class' => 'form-control', 'id' => 'avatar']) !!}
                                        </div>
                                    </div>
                            </div>
                        </div>
                            <div  class="col-sm-10">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                </div>
                            </div>
                            </div>
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
