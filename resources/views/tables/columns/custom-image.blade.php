@if($record->gambar)
    <img src="{{ asset('storage/jurusan-images/' . $record->gambar) }}" alt="Gambar" style="height: 96px; width: 144px; object-fit: cover;">
@else
    <span>Tidak ada gambar</span>
@endif
