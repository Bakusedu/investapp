@extends('layouts.users.dashboard')

@section('content')
<style>
    .dropdown:hover .dropdown-menu {
  display: block;
}
</style>
<div id="app" class="h-screen">
    <dashboard-component></dashboard-component>
</div>
@endsection
