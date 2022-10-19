@extends('components/layout')
@section('components/sidebar')
@section('page-header','攝影機管理')
@section('page-header-detail','在這裡管理各工區的攝影機。')
@section('content')
<div class="ts-grid is-relaxed is-3-columns">
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{2}}</div>
                    <div class="comparison">/{{35}}</div>
                </div>
                我管理的攝影機(施工中)
            </div>
            <div class="symbol">
                <span class="ts-icon is-clock-icon"></span>
            </div>
        </div>
    </div>
</div>
<div class="ts-space is-large"></div>
<div class="ts-divider is-section"></div>
<div class="ts-space is-large"></div>
<div class="ts-grid is-relaxed">
    <div class="column is-15-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">我管理的攝影機<a href="/camera/create"><button
                            class="ts-button is-circular is-small is-dense is-short"
                            style="margin-left: 2rem;">新增</button></a>
                </div>
            </div>
            <div class="ts-divider"></div>
            <table class="ts-table is-basic">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>工區</th>
                        <th>狀態</th>
                        <th>Token</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cameras as $camera)
                    <tr>
                        <td>{{$camera['name']}}</td>
                        <td>
                            {{$camera->area()->first()->name}}
                        </td>
                        <td>{{$camera->last_active_time < now()->subMinutes(10) ?
                                "不在線(最後上線:".$camera->last_active_time.")" : "在線"}}</td>
                        <td>{{$camera->token}}</td>
                        <td class="ts-wrap is-compact">
                            <a href="/camera/{{$camera->id}}">
                                <button class="ts-button is-small ">詳細資料</button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">目前無我管理的攝影機</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($cameras->hasPages())
                <tfoot>
                    <tr>
                        <th colspan="4">{!! $cameras->links() !!}</th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        <div class="ts-space is-big"></div>
    </div>
</div>
@stop