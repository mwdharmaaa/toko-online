@props(['specifications'])

@if(!empty($specifications))
    <div style="margin-top: 36px;">
        <span class="mono-label">SPESIFIKASI TEKNIS</span>
        <table class="detail-specs-table">
            <tbody>
                @foreach($specifications as $specKey => $specVal)
                    <tr>
                        <th>{{ $specKey }}</th>
                        <td>{{ $specVal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
