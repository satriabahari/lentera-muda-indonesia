<div class="text-center mb-16">
    <h2 class="text-2xl font-bold my-6 text-cyan-900">Sertifikat</h2>

    @if ($certificate)
        <h4 class="text-xl font-semibold">{{ $certificate->name }}</h4>
        <img src="{{ Storage::url($certificate->image) }}" class="rounded-md w-[500px] m-auto my-4" />

        @if ($isCompleted)
            <a href="{{ route('certificate.download', $certificate) }}"
                class="py-2 px-4 rounded-md text-neutral-100 my-4 bg-cyan-500 hover:bg-cyan-600 inline-block">
                Unduh Sertifikat
            </a>
        @else
            <div class="py-2 px-4 rounded-md text-neutral-100 my-4 bg-gray-400 cursor-not-allowed inline-block">
                Unduh Sertifikat
            </div>
            <p class="text-sm text-red-500 mt-2">Selesaikan semua kuis untuk mengunduh sertifikat.</p>
        @endif
    @else
        <p>Tidak ada sertifikat yang tersedia</p>
    @endif

</div>
