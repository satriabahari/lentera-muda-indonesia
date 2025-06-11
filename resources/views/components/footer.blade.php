<footer data-aos="fade-up" class="bg-white px-16">
    <div class="w-full mx-auto md:flex justify-between items-start border-t border-neutral-300 pt-6">

        <h1 class="text-2xl font-bold text-cyan-900">Lentera Muda Indonesia</h1>

        <div class="md:mb-0">
            <h3 class="font-semibold text-cyan-900 mb-2">Informasi</h3>

            <p class="mt-2 text-neutral-500 text-sm">
                Jambi - Muara Bulian No.KM. 15<br>
                Mendalo Darat<br>
                Kec. Jambi Luar Kota<br>
                Kab. Muaro Jambi<br>
                Jambi
            </p>
            <p class="mt-2 text-sm text-neutral-500">Phone: +6282183340920</p>
            <p class="text-sm text-neutral-500">Email: satriaabaharii@gmail.com</p>
        </div>

        <div class="mb-6 md:mb-0">
            <h3 class="font-semibold text-cyan-900 mb-2">Navigasi</h3>
            <ul class="text-sm text-neutral-500 space-y-1">
                <li><a href={{ route('home') }}
                        class="text-neutral-500 hover:text-neutral-700 transition duration-300">Beranda</a></li>
                <li><a href={{ route('course') }}
                        class="text-neutral-500 hover:text-neutral-700 transition duration-300">Kelas</a>
                </li>
            </ul>
        </div>
    </div>

    <div
        class="flex justify-between items-center mt-8 text-xs text-neutral-500 bg-white py-6 border-t border-neutral-300">
        <p>
            © Copyright 2025 <a href="https://www.instagram.com/lenteramuda.idn/" class="text-cyan-500">Lentera Muda
                Indonesia</a>. All Rights Reserved
        </p>

        <div class="flex gap-4">
            <a href="https://www.instagram.com/lenteramuda.idn/">
                <x-bi-instagram class="w-5 h-5" style="color: #164e63 " />
            </a>
        </div>
    </div>
</footer>
