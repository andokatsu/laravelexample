<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrapの追加 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendarのCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

    <!-- カスタムCSS -->
    <style>
        body {
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }
        .btn-primary:hover {
            background-color: #357abd;
            border-color: #357abd;
        }
        .link {
            color: #4a90e2;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        nav {
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm w-100">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <li class="nav-item dropdown">
                            <a id="notificationsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                通知 <span class="badge badge-light">{{ Auth::user()->unreadNotifications->count() }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown">
                                @forelse (Auth::user()->unreadNotifications as $notification)
                                    <a class="dropdown-item" href="#">
                                        {{ $notification->data['message'] }}
                                    </a>
                                @empty
                                    <a class="dropdown-item" href="#">通知はありません</a>
                                @endforelse
                            </div>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">新規登録</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- エラーメッセージの表示 -->
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <!-- メインコンテンツ -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- BootstrapのJavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FullCalendarのJavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    @yield('scripts')
</body>
</html>
