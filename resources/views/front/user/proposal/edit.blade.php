@extends('layouts.front')
@section('content')
    @livewire('user.proposal.edit',['proposal'=> $proposal, 'project' => $project])
@endsection
