@extends('layouts.admin')

@section('title', 'Pengaturan Toko & WhatsApp')

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">KONFIGURASI SISTEM</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Pengaturan Toko &amp; Integrasi WhatsApp</h1>
        <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Kelola identitas etalase, nomor penerima pesanan, dan templat teks WhatsApp.</p>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 900px;">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <h3 style="font-size: 16px; margin-bottom: 16px; border-bottom:1px solid var(--border-hairline); padding-bottom:8px;">Identitas Toko &amp; Sambutan Beranda</h3>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="store_name" class="form-label">Nama Brand Toko *</label>
                    <input type="text" id="store_name" name="store_name" value="{{ old('store_name', $setting->store_name) }}" required class="form-control">
                    @error('store_name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="store_tagline" class="form-label">Slogan Toko (Tagline)</label>
                    <input type="text" id="store_tagline" name="store_tagline" value="{{ old('store_tagline', $setting->store_tagline) }}" class="form-control">
                    @error('store_tagline') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="welcome_title" class="form-label">Judul Sambutan Halaman Depan (Hero Title) *</label>
                <input type="text" id="welcome_title" name="welcome_title" value="{{ old('welcome_title', $setting->welcome_title) }}" required class="form-control">
                @error('welcome_title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="welcome_subtitle" class="form-label">Teks Paragraf Sambutan (Hero Subtitle)</label>
                <textarea id="welcome_subtitle" name="welcome_subtitle" rows="3" class="form-control">{{ old('welcome_subtitle', $setting->welcome_subtitle) }}</textarea>
                @error('welcome_subtitle') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <h3 style="font-size: 16px; margin: 28px 0 16px; border-bottom:1px solid var(--border-hairline); padding-bottom:8px;">Saluran &amp; Templat Pemesanan WhatsApp</h3>

            <div class="form-group">
                <label for="whatsapp_number" class="form-label">Nomor WhatsApp Admin (Format Internasional: 628...) *</label>
                <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" required class="form-control" placeholder="Contoh: 6281234567890">
                <span class="form-text">Gunakan awalan 62 (tanpa tanda plus '+', spasi, atau tanda strip).</span>
                @error('whatsapp_number') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="settings-wa-template" class="form-label">Templat Kata-Kata Pesan Beli *</label>
                <textarea id="settings-wa-template" name="whatsapp_message_template" rows="7" required class="form-control" style="font-family:var(--font-mono); font-size:13px; line-height:1.5;">{{ old('whatsapp_message_template', $setting->whatsapp_message_template) }}</textarea>
                <div class="form-text" style="line-height:1.6; margin-top:6px;">
                    <strong>Variabel Otomatis yang Didukung:</strong>
                    <code>{store_name}</code>, <code>{product_name}</code>, <code>{sku}</code>, <code>{price}</code>, <code>{quantity}</code>, <code>{total_price}</code>, <code>{customer_notes}</code>, <code>{product_url}</code>
                </div>
                @error('whatsapp_message_template') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Live Sample Output Box --}}
            <div style="background-color:var(--bg-surface); border:1px solid var(--border-hairline); padding:16px; margin-bottom:24px;">
                <span class="mono-label" style="font-size:11px;">PRATINJAU FORMAT KELUARAN REAL-TIME:</span>
                <pre id="settings-wa-preview" class="wa-preview-box" style="margin-top:8px;"></pre>
            </div>

            <h3 style="font-size: 16px; margin: 28px 0 16px; border-bottom:1px solid var(--border-hairline); padding-bottom:8px;">Kontak &amp; Alamat Toko</h3>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="store_email" class="form-label">Email Resmi Toko</label>
                    <input type="email" id="store_email" name="store_email" value="{{ old('store_email', $setting->store_email) }}" class="form-control">
                    @error('store_email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="instagram_handle" class="form-label">Instagram Handle</label>
                    <input type="text" id="instagram_handle" name="instagram_handle" value="{{ old('instagram_handle', $setting->instagram_handle) }}" class="form-control" placeholder="@monoarchive">
                    @error('instagram_handle') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="store_address" class="form-label">Alamat Studio / Toko Fisik</label>
                <input type="text" id="store_address" name="store_address" value="{{ old('store_address', $setting->store_address) }}" class="form-control">
                @error('store_address') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-top: 28px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Simpan Semua Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
