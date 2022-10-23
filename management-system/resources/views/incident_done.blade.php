@extends('components/layout')
@section('components/sidebar')
@section('page-header','已處理違規通報')
@section('page-header-detail','在這裡檢視已被處理的違規通報。')
@section('content')
<div class="ts-box is-top-indicated">
    <div class="ts-content is-dense">
        <div class="ts-header is-heavy">已處理違規通報</div>
    </div>
    <div class="ts-divider"></div>
    <table class="ts-table is-basic">
        <thead>
            <tr>
                <th>編號</th>
                <th>區域</th>
                <th>攝影機名稱</th>
                <th>通報日期</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incidents as $incident)
            <tr>
                <td>#{{$incident->id}}</td>
                <td>{{$incident->area()->first()->name}}</td>
                <td>{{$incident->incident_type_id == 1 ? $incident->camera()->first()->name : ""}}</td>
                <td>{{$incident->created_at}}</td>
                <td class="ts-wrap is-compact">
                    <a href="/incident/{{$incident->id}}">
                        <button class="ts-button is-small">詳細資料</button>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">目前無已完成通報</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="ts-space is-large"></div>

{{$incidents->links()}}
@stop