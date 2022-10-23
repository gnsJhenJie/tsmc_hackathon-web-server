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
                    <div class="value">{{35}}</div>
                </div>
                全公司近30日違規次數
            </div>
            <div class="symbol">
                <span class="ts-icon is-chart-simple-icon"></span>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{5}}</div>
                </div>
                負責區域近30日違規次數
            </div>
            <div class="symbol">
                <span class="ts-icon is-people-group-icon"></span>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{3}}</div>
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
                    <div class="value">{{3}}</div>
                </div>
                待處理違規通報
            </div>
            <div class="symbol">
                <span class="ts-icon is-circle-info-icon"></span>
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
                        <th>違規人數</th>
                        <th>通報日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($pending_applications as $application)
                    <tr>
                        <td>{{$application->account}}</td>
                        <td>{{$application->unit}}</td>
                        <td>{{$application->name}}</td>
                        <td>{{$application->created_at}}</td>
                        <td class="ts-wrap is-compact">
                            <form action="/apply/{{$application->id}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" name="action" value="approve"
                                    class="ts-button is-small">通過</button><button type="submit" name="action"
                                    value="reject" class="ts-button is-small is-negative is-outlined">拒絕</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">目前無待處理通報</td>
                    </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
        <div class="ts-space is-big"></div>

    </div>
    <div class="column is-5-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">系統概況</div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <div class="ts-text is-bold">本日違規區域數</div>
                <div class="ts-space is-small"></div>
                <div class="ts-progress is-small">
                    <div class="bar" style="width: {{100*5/(30+0.000000001)}}%">
                        <div class="text">{{5}}</div>
                    </div>
                    <div class="bar is-secondary" style="width: 100%;">
                        <div class="text">{{30}}</div>
                    </div>
                </div>
                <div class="ts-space is-small"></div>
                <div class="ts-text is-bold">攝影機上線數量</div>
                <div class="ts-space is-small"></div>
                <div class="ts-progress is-small">
                    <div class="bar" style="width: {{100*2/(5+0.000000001)}}%">
                        <div class="text">{{2}}</div>
                    </div>
                    <div class="bar is-secondary" style="width: 100%;">
                        <div class="text">{{5}}</div>
                    </div>
                </div>
                <div class="ts-space is-small"></div>
            </div>
        </div>
        <div class="ts-space is-big"></div>
    </div>

</div>
@stop