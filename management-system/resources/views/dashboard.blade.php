@extends('components/layout')
@section('components/sidebar')
@section('page-header','儀表板')
@section('page-header-detail','從這裡快速檢視工安狀況。')
@section('content')
<div class="ts-grid is-relaxed is-3-columns">
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{$incidents_30d_count}}</div>
                </div>
                全公司近30日違規次數
            </div>
            <div class="symbol">
                <span class="ts-icon is-right-to-bracket-icon"></span>
            </div>
        </div>
    </div>
    {{-- <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{5}}</div>
                </div>
                負責區域近30日違規次數
            </div>
            <div class="symbol">
                <span class="ts-icon is-graduation-cap-icon"></span>
            </div>
        </div>
    </div> --}}
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{2}}</div>
                    <div class="comparison">/{{20}}</div>
                </div>
                負責區域違規次數排名
            </div>
            <div class="symbol">
                <span class="ts-icon is-clipboard-user-icon"></span>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{$incidents_count}}</div>
                </div>
                待處理違規通報
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
    <div class="column is-11-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">待處理違規通報</div>
            </div>
            <div class="ts-divider"></div>
            <table class="ts-table is-basic">
                <thead>
                    <tr>
                        <th>區域</th>
                        <th>相機名稱</th>
                        <th>通報日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incidents as $incident)
                    <tr>
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
                <tfoot>
                    <tr>
                        <th colspan="4">{!! $incidents->links() !!}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="ts-space is-big"></div>

    </div>
    <div class="column is-5-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">概況</div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <div class="ts-text is-bold">本日違規區域數</div>
                <div class="ts-space is-small"></div>
                <div class="ts-progress is-small">
                    <div class="bar" style="width: {{100*$area_has_incident_count/($area_count+0.000000001)}}%">
                        <div class="text">{{$area_has_incident_count}}</div>
                    </div>
                    <div class="bar is-secondary" style="width: 100%;">
                        <div class="text">{{$area_count}}</div>
                    </div>
                </div>
                <div class="ts-space is-small"></div>
                <div class="ts-text is-bold">攝影機上線數量</div>
                <div class="ts-space is-small"></div>
                <div class="ts-progress is-small">
                    <div class="bar" style="width: {{100*$camera_active_count/($camera_count+0.000000001)}}%">
                        <div class="text">{{$camera_active_count}}</div>
                    </div>
                    <div class="bar is-secondary" style="width: 100%;">
                        <div class="text">{{$camera_count}}</div>
                    </div>
                </div>
                <div class="ts-space is-small"></div>
            </div>
        </div>
        <div class="ts-space is-big"></div>
    </div>

</div>
@stop