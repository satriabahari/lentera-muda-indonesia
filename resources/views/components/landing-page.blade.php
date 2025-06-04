<!-- resources/views/hero.blade.php -->
<div>
    <div class=" bg-gray-800 text-white py-12 text-center">
        <h1 class="text-2xl md:text-3xl font-semibold mb-4">
            Temukan Potensi Terbaikmu bersama
            <span class="text-cyan-400 font-bold">Lentera Muda Indonesia</span>
        </h1>

        <p class="text-lg md:text-xl mb-2 flex items-center justify-center gap-2">
            📘 <span>Belajar. Bertumbuh. Berprestasi.</span> 📘
        </p>

        <p class="text-sm text-gray-300 mb-6">Since 2025</p>

        <x-primary-button class="bg-cyan-500 dark:bg-cyan-500">
            Mulai Belajar
        </x-primary-button>
    </div>

    <!-- resources/views/components/why-lentera.blade.php -->
    <section class="bg-[#f0fafd] py-16 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-semibold mb-10">
                Kenapa Memilih
                <span class="text-cyan-600 font-bold">Lentera Muda Indonesia</span>?
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white border border-cyan-400 rounded-md shadow-md p-6">
                    <div class="bg-cyan-200 text-cyan-900 p-3 rounded-md flex items-center gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m2 6H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-semibold">Belajar dengan tujuan, berkembang dengan arah.</span>
                    </div>
                    <p class="text-sm text-gray-700">
                        Kami hadir dengan program terfokus untuk pengembangan OSIS dan persiapan UTBK.
                        Materi kami dibuat sesuai kebutuhan nyata siswa di daerah.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border border-cyan-400 rounded-md shadow-md p-6">
                    <div class="bg-cyan-200 text-cyan-900 p-3 rounded-md flex items-center gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 12l6 6m0-12l-6 6" />
                        </svg>
                        <span class="font-semibold">Pendidikan berkualitas, tanpa batasan biaya.</span>
                    </div>
                    <p class="text-sm text-gray-700">
                        Tak perlu khawatir soal biaya. Semua kelas di Lentera Academy dan Lentera Course
                        bisa diakses gratis untuk seluruh siswa.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-cyan-400 rounded-md shadow-md p-6">
                    <div class="bg-cyan-200 text-cyan-900 p-3 rounded-md flex items-center gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 17l6-6 4 4 8-8" />
                        </svg>
                        <span class="font-semibold">Belajar bersama, tumbuh bersama.</span>
                    </div>
                    <p class="text-sm text-gray-700">
                        Bangun koneksi dengan sesama siswa, dapatkan bimbingan langsung dari mentor berpengalaman,
                        dan tumbuh bersama komunitas inspiratif.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- resources/views/components/about-section.blade.php -->
    <section class="bg-cyan-200 py-12 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <img src="{{ asset('images/tentang-kami.jpg') }}" alt="Tentang Kami"
                    class="rounded-lg shadow-lg w-full">
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-semibold mb-4">Tentang Kami</h2>
                <p class="text-gray-800 mb-4 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit. Volutpat
                    odio facilisis mauris sit amet massa.
                </p>
                <a href="#"
                    class="inline-block mt-2 text-white bg-cyan-600 px-4 py-2 rounded hover:bg-cyan-700 text-sm">
                    Selengkapnya
                </a>
            </div>
        </div>
    </section>

    <!-- resources/views/components/latest-classes.blade.php -->
    @livewire('course-list')

    <section class="bg-cyan-200 py-16">
        <div class="text-center text-2xl font-semibold text-gray-800 mb-10">Kontak</div>
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8 grid md:grid-cols-3 gap-6 text-sm text-gray-700">
            <div class="flex items-start gap-3">
                <div class="text-cyan-500 text-xl">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <div class="font-semibold">Location:</div>
                    <p>Jambi - Muara Bulian No.KM. 15<br>Mendalo Darat<br>Kec. Jambi Luar Kota<br>Kab. Muaro Jambi<br>Jambi</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="text-cyan-500 text-xl">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <div class="font-semibold">Email:</div>
                    <p>namaemail88@gmail.com</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="text-cyan-500 text-xl">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <div class="font-semibold">Call:</div>
                    <p>+1 5589 55488 51<br>+1 5589 55488 51</p>
                </div>
            </div>
        </div>
    </section>

    <x-footer/>

</div>
