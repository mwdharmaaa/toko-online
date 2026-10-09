<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Mono Archive</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div style="text-align: center; margin-bottom: 28px;">
                <div class="brand-symbol" style="margin: 0 auto 12px; width:28px; height:28px;">
                    <div class="brand-symbol-inner" style="width:10px; height:10px;"></div>
                </div>
                <h1 style="font-size: 20px; font-weight:800; letter-spacing:0.04em;">ADMIN STUDIO</h1>
                <p style="font-size: 13px; color: var(--text-muted); margin-top: 4px;">Akses Manajemen Katalog &amp; Konten</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success" style="font-size:13px; padding:10px 14px;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error" style="font-size:13px; padding:10px 14px;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Administrator:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@monoarchive.id') }}" required autofocus class="form-control">
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi:</label>
                    <input type="password" id="password" name="password" value="admin12345" required class="form-control">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px; font-size:13px;">
                    <label style="display:flex; align-items:center; gap:6px; cursor:pointer;">
                        <input type="checkbox" name="remember" value="1">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-black btn-block btn-lg" style="font-size:14px;">Masuk ke Panel Admin</button>
            </form>

            <div style="margin-top: 24px; text-align: center; border-top: 1px dashed var(--border-hairline); padding-top: 16px;">
                <a href="{{ route('home') }}" class="mono-label" style="font-size:11px; color:var(--text-muted);">&larr; Kembali ke Beranda Toko</a>
            </div>
        </div>
    </div>
</body>
</html>
