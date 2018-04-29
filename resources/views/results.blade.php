@extends('main-layout')

@section('title', 'Search Results')

@section('content')
<div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>
            Search Results
          </h4>
        </div>
        <table class="table table-fixed">
          <thead>
            <tr>
              <th></th>
              <th class="col-lg-6">Artist</th>
              <th class="col-lg-6">Add</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th><img src="<?php echo $image; ?>" style="max-width: 100px; max-height: 100px"></th>
              <td class="col-lg-6">{{$artist}}</td>
              <td class="col-lg-6">
                <form action="/results/{artist}" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                    <button onlick="location.href='{{ url('subscribeSuccess')}}'" type="submit" class="btn btn-primary">Add</button>
                    <input name="hiddenId" type="hidden" value="{{$artistId}}">
                    <input name="hiddenId1" type="hidden" value="{{$artist}}">
                  </div>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
@endsection