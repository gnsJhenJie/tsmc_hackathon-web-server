<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>登入-工地安全管理系統-戀愛巴士新竹站</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas/4.0.4/tocas.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tocas/4.0.4/tocas.min.js"></script>

</head>

<body>
    <div class="ts-center">
        <div class="ts-header is-large is-heavy is-icon">
            <div class="ts-icon is-helmet-safety-icon"></div>
            工地安全管理系統-戀愛巴士新竹站
        </div>
        <div class="ts-space is-large"></div>
        <div class="ts-segment" style="width: 320px">
            <form class="ts-wrap is-vertical" action="/login" method="POST">
                <div class="ts-text is-label">使用者帳號</div>
                <div class="ts-input is-start-icon is-underlined is-fluid">
                    <span class="ts-icon is-user-icon"></span>
                    <input type="text" name="email">
                </div>
                <div class="ts-text is-label">密碼</div>
                <div class="ts-input is-start-icon is-underlined is-fluid">
                    <span class="ts-icon is-lock-icon"></span>
                    <input type="password" name="password">
                </div>
                @csrf
                <button class="ts-button is-fluid" type="submit">登入</button>
                @error("login")
                <div class="ts-notice is-negative">
                    <div class="title">登入失敗</div>
                    <div class="content">請確認輸入的資訊</div>
                </div>
                @enderror
                @error("logout")
                <div class="ts-notice">
                    <div class="title">登出成功</div>
                    <div class="content">感謝您的使用</div>
                </div>
                @enderror
            </form>
        </div>
    </div>
</body>

</html>