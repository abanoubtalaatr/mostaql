@extends('layouts.front')
@section('content')
    @livewire('user.project.edit', ['project' => $project])
@endsection
