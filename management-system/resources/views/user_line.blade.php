@extends('components/layout')
@section('components/sidebar')
@section('page-header','Line綁定')
@section('page-header-detail','在這裡取得line綁定碼。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-13-wide">
        <div class="ts-box is-top-indicated">
            <div class="ts-content is-dense">
                <div class="ts-header is-heavy">line綁定碼
                </div>
            </div>
            <div class="ts-divider"></div>
            <div class="ts-content">
                <form action="/user" method="POST">
                    <div class="ts-grid">
                        @csrf
                        <div class="column is-16-wide">
                            <div class="ts-img">
                                <img
                                    src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=https://line.me/R/oaMessage/@991pxuce/?register:{{$token}}" />
                            </div>
                        </div>
                        <div class="column is-16-wide">
                            <div class="ts-text is-label">請掃描上方QR Code<br /><br />或將以下文字複製到tsmc工安提醒Line對話框並傳送</div>
                            <div class="ts-space"></div>
                            <div class="ts-input is-underlined is-fluid">
                                <input name="email" type="text" value="register:{{$token}}" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="ts-space"></div>
    </div>

</div>
@stop