<x-app-layout>
    <div class="pt-16">
        {{-- Hero --}}
        <section class="relative overflow-hidden text-center text-cyan-900 px-16 ">
            <div
                class="absolute top-0 left-0 h-screen w-screen bg-[radial-gradient(100%_50%_at_50%_0%,rgba(0,163,255,0.13)_0,rgba(0,163,255,0)_50%,rgba(0,163,255,0)_100%)]">
            </div>

            <div class="space-y-6 z-10 h-screen flex flex-col items-center justify-center pb-32">
                <div class="space-y-2">
                    <h1 class="text-[55px] leading-none font-bold">Bangun Masa Depanmu Bersama</h1>
                    <h1 class="text-[55px] leading-none font-bold text-cyan-500">Lentera Muda Indonesia</h1>
                </div>

                <p class="flex items-center justify-center w-3/5 m-auto">
                    Bersama Lentera Muda Indonesia, kamu akan mendapatkan dukungan,
                    pembelajaran, dan komunitas yang membantumu mengembangkan potensi diri, meraih impian, dan
                    menciptakan
                    masa
                    depan yang lebih cerah.
                </p>

            </div>
        </section>

        {{-- Hero --}}

        {{-- Kenapa Memilih --}}
        <section class="bg-white pt-4 pb-32 px-16 ">
            <div class="max-w-6xl mx-auto text-center space-y-12">
                <h2 class="text-2xl md:text-3xl font-bold text-cyan-900">
                    Kenapa Memilih
                    <br>
                    <span class="text-cyan-500 font-bold">Lentera Muda Indonesia</span>
                </h2>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-b from-cyan-50 border border-neutral-200 to-white  rounded-md p-4">
                        <div class=" text-cyan-900 p-3 rounded-md items-center mb-4 flex flex-col gap-4">
                            <x-tabler-target-arrow class="w-8 h-8" />
                            <span class="font-bold text-lg">Belajar dengan tujuan, berkembang dengan arah.</span>
                        </div>
                        <p class="text-sm text-neutral-500">
                            Kami hadir dengan program terfokus untuk pengembangan OSIS dan persiapan UTBK.
                            Materi kami dibuat sesuai kebutuhan nyata siswa di daerah.
                        </p>
                    </div>
                    <div class="bg-gradient-to-b from-cyan-50 border border-neutral-200 to-white  rounded-md p-4">
                        <div class=" text-cyan-900 p-3 rounded-md items-center mb-4 flex flex-col gap-4">
                            <x-bx-dollar class="w-8 h-8" />
                            <span class="font-bold text-lg">Pendidikan berkualitas, tanpa batasan biaya.</span>
                        </div>
                        <p class="text-sm text-neutral-500">
                            Tak perlu khawatir soal biaya. Semua kelas di Lentera Academy dan Lentera Course
                            bisa diakses gratis untuk seluruh siswa.
                        </p>
                    </div>
                    <div class="bg-gradient-to-b from-cyan-50 border border-neutral-200 to-white  rounded-md p-4">
                        <div class=" text-cyan-900 p-3 rounded-md items-center mb-4 flex flex-col gap-4">
                            <x-fas-graduation-cap class="w-8 h-8" />
                            <span class="font-bold text-lg">Belajar bersama, tumbuh bersama.</span>
                        </div>
                        <p class="text-sm text-neutral-500">
                            Bangun koneksi dengan sesama siswa, dapatkan bimbingan langsung dari mentor berpengalaman,
                            dan tumbuh bersama komunitas inspiratif.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        {{-- Kenapa Memilih --}}

        {{-- Tentang Kami --}}
        <section class="bg-cyan-50 py-16 px-32 mb-16 flex flex-col gap-32">
            <div class="w-full mx-auto grid grid-cols-[1.5fr_2.3fr] items-center gap-16">
                <img class="block w-full" src="/images/placeholder.png" alt="Tentang Kami">

                <div class="flex-1">
                    <h2 class="text-3xl font-bold mb-4 text-cyan-900">Tentang Kami</h2>
                    <p class="text-neutral-500 mb-4  leading-relaxed">
                        Lentera Muda Indonesia adalah komunitas pemuda yang berfokus pada pemberdayaan pendidikan,
                        pengembangan karakter, dan peningkatan kesadaran sosial di kalangan generasi muda. Berawal dari
                        kepedulian terhadap kesenjangan akses dan kualitas pendidikan di berbagai daerah, Lentera Muda
                        hadir
                        sebagai wadah kolaborasi anak muda untuk menjadi agen perubahan yang berdampak.

                        Kami percaya bahwa setiap anak bangsa memiliki potensi besar untuk berkembang, dan tugas kita
                        bersama adalah menyalakan lentera harapan itu melalui pendidikan, aksi nyata, dan pengabdian
                        kepada
                        masyarakat.
                    </p>
                </div>
            </div>
            <div class="w-full mx-auto grid grid-cols-[2.3fr_1.5fr] items-center gap-16">
                <div class="flex-1">
                    <h2 class="text-3xl font-bold mb-4 text-cyan-900">Visi</h2>
                    <p class="text-neutral-500 mb-4  leading-relaxed">
                        Menjadi komunitas pelopor dalam menciptakan generasi muda Indonesia yang berkarakter, berdaya
                        saing,
                        dan peduli terhadap pembangunan sosial melalui pendidikan dan pengabdian.
                    </p>
                </div>

                <img class="block w-full" src="/images/placeholder.png" alt="Tentang Kami">
            </div>
            <div class="w-full mx-auto grid grid-cols-[1.5fr_2.3fr] items-center gap-16">
                <img class="block w-full" src="/images/placeholder.png" alt="Tentang Kami">

                <div class="flex-1">
                    <h2 class="text-3xl font-bold mb-4 text-cyan-900">Misi</h2>
                    <ul class="list-disc list-inside text-neutral-500 mb-4  leading-relaxed space-y-2">
                        <li>
                            Meningkatkan akses dan kualitas pendidikan melalui kegiatan pembelajaran, pelatihan, dan
                            penyuluhan
                            bagi anak-anak dan remaja di daerah kurang terlayani.
                        </li>
                        <li>
                            Mendorong partisipasi aktif pemuda dalam kegiatan sosial dan pengabdian masyarakat yang
                            berkelanjutan.
                        </li>
                        <li>
                            Membangun karakter dan kepemimpinan generasi muda melalui pelatihan soft skills, mentoring,
                            dan
                            kolaborasi lintas sektor.
                        </li>
                        <li>
                            Menjadi jembatan inspirasi dan kolaborasi antara pemuda, institusi pendidikan, komunitas
                            lokal,
                            dan pihak-pihak yang peduli terhadap kemajuan pendidikan di Indonesia.
                        </li>
                        <li>
                            Mengembangkan platform digital sebagai sarana pembelajaran, berbagi pengetahuan, dan
                            menyebarkan
                            semangat kebaikan kepada lebih banyak orang.
                        </li>
                    </ul>
                </div>

            </div>
        </section>
        {{-- Tentang Kami --}}

        {{-- Course List --}}
        <livewire:courses />
        {{-- Course List --}}

        {{-- CTA --}}
        <section
            class="overflow-hidden rounded-xl mx-16 py-24 text-center gap-4 my-16 flex justify-center flex-col relative">

            <div
                class="absolute inset-0 z-1 h-full w-full items-center px-5 py-24 [background:radial-gradient(125%_125%_at_50%_10%,#000_40%,#06b6d4_100%)]">
            </div>

            <div class="z-10 space-y-4">
                <h1 class="text-4xl font-bold text-cyan-50">Siap Menyalakan <br> Lentera Harapanmu?</h1>

                <p class="text-neutral-200 w-1/2 m-auto">
                    Wujudkan impian dan potensi terbaikmu bersama komunitas yang mendukungmu untuk terus belajar,
                    bertumbuh, dan menginspirasi.</p>

                <div class="flex justify-center">
                    <div class="flex items-center text-center">
                        <a href="{{ route('course') }}" >
                            <x-primary-button class="!bg-cyan-500 !text-neutral-100 hover:!bg-cyan-700 hover:scale-105 transition duration-300">
                                Nyalakan Lentera🔥
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        {{-- CTA --}}

    </div>
</x-app-layout>
