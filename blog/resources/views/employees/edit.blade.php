@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('employees.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="firstname" value="{{$employee->firstname}}" class="form-control" placeholder="First Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Last Name:</strong>
                <input type="text" name="lastname" value="{{$employee->lastname}}"  class="form-control" placeholder="Last Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email"  value="{{$employee->email}}"  class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                            <label for="room">Company name</label>
                            <select class="form-control" name="company" >
                                @foreach ($companies as $company)
                                @if ($employee->company==$company->id)
                                    <option value="{{$company->id}}" selected="selected">{{ $company->name }}</option>
                                    @else 
                                    <option value="{{$company->id}}">{{ $company->name }}</option>
                                @endif   
                                @endforeach
                            </select>
                        </div>
        </div>

      
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" value="{{$employee->phone}}s"  class="form-control" placeholder="Phone">
            </div>
        </div>


        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
    </form>
@endsection