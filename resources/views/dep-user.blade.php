@extends ('layouts.master')

@section('title')
Users | Admin
@endsection

@section('content') 

<div class="row">
  <div class="col-md-12">
    <div class="card">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <div class="card-header"> 
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>Name</th>
              <th>Department</th>
            </thead>
            <tbody>
            @foreach($users as $row)
            <tr>
            <script>console.log($row)</script>
            <td>{{ $row->username }}</td>
            <td>{{ $row->name}}</td> 
            </tr>
            @endforeach          
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  @endsection

  @section('scripts')

  @endsection 
