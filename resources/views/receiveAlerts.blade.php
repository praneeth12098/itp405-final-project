@extends('main-layout')

@section('title', 'Receive Alerts')

@section('content')
<h1 class="text-center"> Enter Phone Number </h1>

<p>Receive text alerts for all favorited artists when they put out new music or new albums (text charges apply). </p>

<p> Re-enter phone number if you need to update </p>

@if($errors->isNotEmpty())
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $message)
        {{$message}}
      @endforeach
    </div>
  @endif

  <form action="/receiveAlerts" method="post">
    {{csrf_field()}}
    <div class="form-group">
      <label for="phone">Phone Number (i.e. (123)456-7890 -> 1234567890)</label>
      <input type="text" value="{{old('phone')}}" id="phone" name="phone" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection