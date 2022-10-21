@extends('components/layout')
@section('components/sidebar')
@section('page-header','待處理違規通報')
@section('page-header-detail','在這裡檢視尚待處理的違規通報。')
@section('content')
<div class="ts-grid is-4-columns">
    @foreach($incidents as $incident)
    <div class="column">
        <a class="box-anchor" href="/incident/{{$incident->id}}">
            <div class="ts-box">
                @if ($incident->has_image)
                <div class="ts-image is-4-by-3">
                    <img src="/incident/image/{{$incident->id}}" style="width: auto; max-height:155px;">
                </div>
                @else
                <div class="ts-image">
                    <img src="/assets/images/default_incident.png" style="width: auto; max-height:150px;">
                </div>
                @endif
                <div class="ts-content">
                    <div class="ts-text is-heavy">{{$incident->incidentType()->first()->name}}
                    </div>
                    編號:&nbsp;#{{$incident->id}}
                    <br />
                    {{$incident->area()->first()->name}}&nbsp;{{$incident->incident_type_id ==
                    1?"- ".$incident->camera()->first()->name : ""}}
                    <br />
                    違規人數&nbsp;{{$incident->without_amount}}/&nbsp;現場人數&nbsp;{{$incident->total_amount}}
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<div class="ts-space is-large"></div>

{{$incidents->links()}}
<style>
    .ts-box {
        transition: top ease 0.5s;
    }

    .ts-box:hover {
        top: -3px;
    }

    .box-anchor {
        text-decoration: none;
    }
</style>
@stop