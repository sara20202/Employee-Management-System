@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Department') }}</div>

                    <div class="card-body">
                        
                        <table class="table">
                        <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">id</th>
                                        
                                    </tr>
                        </thead>
                        <tbody>


                            @foreach($departments as $department)
                            <tr>
                                <th scope="row">{{ $department->id }}</th>
                                <td>{{ $department->name }}</td>
                                <td>{{$department->user_id}}</td>
                                
                            </tr>
                 
                            @endforeach
                       </table>
                       {{ $departments->links() }}
                    </div>
                 </div>
            </div>
		</div>	
	</div>
</div>
@endsection