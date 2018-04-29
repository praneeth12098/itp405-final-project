@extends('main-layout')

@section('title', 'Top Artists')

@section('content')
<div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="text-center">
            Top 10 Artists
          </h4>
        </div>
        <table class="table table-fixed">
          <thead>
            <tr>
              <th class="col-lg-5 text-center">Artist</th>
              <th class="col-lg-6 text-center">Image</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $it = new MultipleIterator();
            $it->attachIterator(new ArrayIterator($artists));
            $it->attachIterator(new ArrayIterator($images));

            foreach($it as $item)
             :?>
            <tr>
              <td class="col-lg-5 text-center">{{$item[0]}}</td>
              <td class="col-lg-6 text-center"><img src="<?php echo $item[1]; ?>"></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
  </div>
@endsection