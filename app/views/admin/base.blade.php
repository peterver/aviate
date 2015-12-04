@extends('admin/_layout')

@section('content')
	@if(isset($content))
		{{ $content }}
	@endif
@stop