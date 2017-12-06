@extends('layouts.app')

@section('content')
    <listtopicposts-component topic-id={{ $topicId }}></listtopicposts-component>
@endsection