@extends('components/layout')
@section('components/sidebar')
@section('page-header','違規類別管理')
@section('page-header-detail','在這裡管理系統中的違規類別。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">新增違規類別
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action="/incident/type" method="POST">
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
    </div>
</div>
@stop