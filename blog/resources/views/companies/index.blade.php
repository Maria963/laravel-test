@extends('layouts.app')
 
@section('content')
<div class="col-md-2">
          <ul class="list-group">
             <li class="list-group-item"><a class="btn" href="{{ route('companies.index') }}"> Companies</a></li>
             <li class="list-group-item"><a class="btn" href="{{ route('employees.index') }}"> Employees</a></li>
          </ul>
        </div>
        <div class="col-md-10">
@include('companies.companies')
</div>   
@endsection