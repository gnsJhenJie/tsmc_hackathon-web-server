@extends('components/layout')
@section('components/sidebar')
@section('page-header','使用者管理')
@section('page-header-detail','在這裡管理系統中的使用者。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">新增使用者
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action="/user" method="POST">
                    <div class="ts-grid">
                        @csrf
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">email</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="email" type="text" required>
                            </div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">密碼</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="password" type="password" required>
                            </div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">姓名</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="name" type="text" required>
                            </div>
                        </div>
                        <div class="column is-8-wide">
                            <div class="ts-text is-label is-required">身份</div>
                            <div class="ts-space"></div>
                            <div class="ts-select">
                                <select name="role">
                                    <option value="1">一般使用者</option>
                                    <option value="2">系統管理員</option>
                                </select>
                            </div>
                        </div>
                        <div class="column is-3-wide">
                            <button class="ts-button" type="submit">建立</button>
                            <div class="ts-space"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="ts-space"></div>
    </div>

</div>
@stop