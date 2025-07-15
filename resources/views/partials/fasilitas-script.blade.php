<script>
    document.addEventListener('DOMContentLoaded', () => {
        const viewerContainer = document.getElementById('panolens-container');

        const viewer = new PANOLENS.Viewer({
            container: viewerContainer,
            controlBar: true,
            autoHideInfospot: false,
            autoRotate: true,           // Aktifkan auto-rotate langsung
            autoRotateSpeed: 1        // Kecepatan mutar
        });

        const panoramas = {};

        @foreach($fasilitas as $item)
            const panorama{{ $item->id }} = new PANOLENS.ImagePanorama(@json(asset('storage/' . $item->gambar_360)));

            panorama{{ $item->id }}.addEventListener('enter', () => {
                const nadirLogo = new PANOLENS.Infospot(256, @json(asset('images/logo-nadir-256.png')));
                nadirLogo.position.set(0, -500, 0);
                nadirLogo.tooltip = 'SMKN 6 Denpasar';
                nadirLogo.hoverText = 'Logo Sekolah';
                panorama{{ $item->id }}.add(nadirLogo);
            });

            panoramas[@json($item->id)] = panorama{{ $item->id }};
            viewer.add(panorama{{ $item->id }});
        @endforeach

        document.querySelectorAll('.tab-btn').forEach((btn) => {
            btn.addEventListener('click', () => {
                const targetId = btn.dataset.target;
                if (panoramas[targetId]) {
                    viewer.setPanorama(panoramas[targetId]);
                    // ❌ Jangan pakai viewer.enableAutoRotate() lagi
                }
            });
        });

        const firstId = @json($fasilitas->first()->id ?? '');
        if (firstId && panoramas[firstId]) {
            viewer.setPanorama(panoramas[firstId]);
            // ❌ Jangan tambahkan autoRotate di sini, sudah aktif dari awal
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('fasilitasTabs');
        const scrollLeftBtn = document.getElementById('scrollLeft');
        const scrollRightBtn = document.getElementById('scrollRight');

        if (scrollLeftBtn && scrollRightBtn && container) {
            scrollLeftBtn.addEventListener('click', () => {
                container.scrollBy({ left: -200, behavior: 'smooth' });
            });

            scrollRightBtn.addEventListener('click', () => {
                container.scrollBy({ left: 200, behavior: 'smooth' });
            });
        }
    });
</script>