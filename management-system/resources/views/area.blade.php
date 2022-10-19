@extends('components/layout')
@section('components/sidebar')
@section('page-header','工區管理')
@section('page-header-detail','在這裡管理廠區中的各個工區。')
@section('content')
<div class="ts-grid is-relaxed is-3-columns">
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{2}}</div>
                    <div class="comparison">/{{35}}</div>
                </div>
                我管理的工區(施工中)
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
                <div class="ts-header is-heavy">我管理的工區<a href="/area/create"><button
                            class="ts-button is-circular is-small is-dense is-short"
                            style="margin-left: 2rem;">新增</button></a>
                </div>
            </div>
            <div class="ts-divider"></div>
            <table class="ts-table is-basic">
                <thead>
                    <tr>
                        <th>名稱</th>
                        <th>管理者</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($areas as $area)
                    <tr>
                        <td>{{$area['name']}}</td>
                        <td>
                            @foreach ($area->managers() as $user)
                            {{-- <button class="ts-button is-small">{{$user->name}}</button> --}}
                            <div class="ts-chip">
                                <div class="ts-image">
                                    <img src="/assets/images/user.webp" />
                                </div>
                                {{$user->name}}
                            </div>
                            @endforeach
                        </td>
                        <td class="ts-wrap is-compact">

                            <a href="/area/{{$area->id}}">
                                <button class="ts-button is-small ">詳細資料</button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">目前無管理中的工區</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($areas->hasPages())
                <tfoot>
                    <tr>
                        <th colspan="4">{!! $areas->links() !!}</th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        <div class="ts-space is-big"></div>
    </div>
</div>
@stop