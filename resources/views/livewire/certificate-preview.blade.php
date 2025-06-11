<div class="text-center mb-16">
    <h2 data-aos="fade-down" class="text-2xl font-bold my-6 text-cyan-900">Sertifikat</h2>

    @if ($certificate)
        <h4 data-aos="fade-down" data-aos-delay="200" class="text-xl font-semibold text-cyan-900 ">{{ $certificate->name }}
        </h4>
        <img data-aos="zoom-in" data-aos-delay="400" src="{{ Storage::url($certificate->image) }}"
            class="rounded-md w-[500px] m-auto my-4" />

        @if ($isCompleted)
            <a data-aos="fade-up" data-aos-delay="600"
                href="{{ route('certificate.download', basename($certificate->image)) }}"
                class="py-2 px-4 rounded-md text-neutral-100 my-4 bg-cyan-500 hover:bg-cyan-600 inline-block">
                Unduh Sertifikat
            </a>
        @else
            <div data-aos="fade-up" data-aos-delay="600"
                class="py-2 px-4 rounded-md text-neutral-100 my-4 bg-gray-400 cursor-not-allowed inline-block">
                Unduh Sertifikat
            </div>
            <p class="text-sm text-red-500 mt-2">Selesaikan semua kuis untuk mengunduh sertifikat.</p>
        @endif
    @else
        <p data-aos="zoom-in" data-aos-delay="600">Tidak ada sertifikat yang tersedia</p>
    @endif

</div>
