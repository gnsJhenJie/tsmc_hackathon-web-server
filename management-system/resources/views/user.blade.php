@extends('components/layout')
@section('components/sidebar')
@section('page-header','使用者管理')
@section('page-header-detail','在這裡管理系統中的使用者。')
@section('content')
<div class="ts-grid is-relaxed is-3-columns">
    <div class="column">
        <div class="ts-box">
            <div class="ts-content">
                <div class="ts-statistic">
                    <div class="value">{{$users->count()}}</div>
                </div>
                使用者數
            </div>
            <div class="symbol">
                <span class="ts-icon is-clock-icon"></span>
            </div>
        </div>
    </div>
</div>
<div class="ts-divider is-section"></div>
<div class="ts-grid is-relaxed">
    {{-- <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">新增違規類別
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action="/user" method="POST">
                    <div class="ts-grid">
                        @csrf
                        <div class="column is-13-wide">
                            <div class="ts-text is-label is-required">名稱</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="name" type="text" required>
                            </div>
                            <div class="ts-space is-large"></div>
                        </div>
                        <div class="column is-3-wide">
                            <div class="ts-text is-label">&nbsp;</div>
                            <div class="ts-space"></div>
                            <button class="ts-button" type="submit">建立</button>
                            <div class="ts-space"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="ts-space"></div>
    </div> --}}
    <div class="column is-15-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">使用者
                    <a href="/user/create" style="text-decoration: none;">
                        <button class="ts-button is-circular is-small is-dense is-short is-outlined"
                            style="margin-left: 1rem;">新增使用者
                        </button>
                    </a>
                </div>
            </div>
            <div class="ts-divider"></div>
            <table class="ts-table is-basic">
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>帳號</th>
                        <th>身份</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td class="ts-wrap is-compact">
                            {{$user->role == 1 ? "一般使用者":""}}
                            {{$user->role == 0 ? "":""}}
                            {{$user->role == 2 ? "系統管理員":""}}
                        </td>
                        <td>
                            @if($user->id != auth()->user()->id)
                            <form action="/user/{{$user->id}}" method="POST">

                                @csrf
                                @method("PUT")
                                @if ($user->role==2)
                                <button class="ts-button is-small is-short is-dense is-outlined" name="role" value="1"
                                    type="submit">
                                    設為一般使用者
                                </button>
                                @elseif ($user->role==1)
                                <button class="ts-button is-small is-short is-dense is-outlined" name="role" value="2"
                                    type="submit">
                                    設為系統管理員
                                </button>
                                @endif
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">目前無使用者</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($users->hasPages())
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