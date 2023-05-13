@extends('layouts.front')
@section('content')
    @livewire('user.project.show',['project' => $project])
@endsection
