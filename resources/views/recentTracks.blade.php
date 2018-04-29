@extends('main-layout')

@section('title', 'Recent Tracks')

@section('content')
<div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>
            10 Most Recent Tracks
          </h4>
        </div>
        <table class="table table-fixed">
          <thead>
            <tr>
              <th class="col-xs-2">Preview</th><th class="col-xs-8">Track</th><th class="col-xs-2">Artist</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $it = new MultipleIterator();
            $it->attachIterator(new ArrayIterator($tracks));
            $it->attachIterator(new ArrayIterator($artists));
            $it->attachIterator(new ArrayIterator($urls));

            foreach($it as $item)
             :?>
            <tr>
              <td class="col-xs-3">
                <audio controls="controls" autobuffer="autobuffer">
                <source src="<?php echo $item[2]; ?>">
                </audio>
                <!-- {{$item[2]}} -->
              </td>
              <td class="col-xs-7">{{$item[0]}}</td>
              <td class="col-xs-4">{{$item[1]}}</td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
  </div>
@endsection