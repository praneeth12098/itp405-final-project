@extends('main-layout')

@section('title', 'Profile')

@section('content')
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th class="text-center" scope="col">Stats Available</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center"><a href="/profile/recentTracks"> 10 Most Recent Tracks </td>
    </tr>
    <tr>
      <td class="text-center"><a href="/profile/topTracks"> Top 10 Tracks </td>
    </tr>
    <tr>
      <td class="text-center"><a href="/profile/topArtists"> Top 10 Artists </td>
    </tr>
    <tr>
      <td class="text-center"><a href="/profile/subscriptions"> My Subscriptions </td>
    </tr>
  </tbody>
</table>
@endsection