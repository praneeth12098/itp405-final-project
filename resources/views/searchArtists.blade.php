@extends('main-layout')

@section('title', 'Search Artists')

@section('content')
<h1 class="text-center"> Search for an Artist </h1>

<p>Click the subscribe button next to any artist you want to receive alerts from. You will receive a text notification every time the artist puts out an album or a single. </p>

@if($errors->isNotEmpty())
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $message)
        {{$message}}
      @endforeach
    </div>
  @endif

  <form action="/searchArtists" method="post">
    {{csrf_field()}}
    <div class="form-group">
      <label for="name">Search</label>
      <input type="text" value="{{old('name')}}" id="name" name="name" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>

@endsection