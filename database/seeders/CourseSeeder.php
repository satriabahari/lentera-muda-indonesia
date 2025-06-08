<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Arr;

class CourseSeeder extends Seeder
{
    /**
     * Jalankan seed pada database.
     */
    public function run(): void
    {

        $course = Course::create([
                'title' => "Testing",
                'description' => "Kursus komprehensif ini dirancang untuk membantu pelajar di Tingkat membangun dasar yang kuat dalam pengetahuan teoretis maupun penerapan praktis.
                Melalui serangkaian pelajaran yang terstruktur, Anda akan mempelajari prinsip-prinsip inti, kerangka kerja, dan studi kasus yang mencerminkan tantangan dunia nyata di berbagai bidang.
                Setiap modul dirancang dengan hati-hati untuk memperkuat pemahaman Anda melalui perpaduan materi multimedia, tutorial terpandu, dan proyek praktis.
                Selain itu, kursus ini menekankan pembelajaran kolaboratif melalui forum diskusi, tinjauan sejawat, dan umpan balik dari instruktur.
                Di akhir kursus ini, Anda akan dibekali keterampilan yang diperlukan untuk melanjutkan ke tingkat berikutnya atau langsung menerapkan apa yang telah Anda pelajari dalam pekerjaan atau studi Anda.
                Baik Anda mengejar keunggulan akademik maupun pertumbuhan profesional, kursus ini akan menjadi batu loncatan penting dalam perjalanan Anda.",
                'image' => "placeholder.png",
                'student_type_id' => 1,
            ]);


        $studentTypeIds = [1, 2]; // Pastikan data ini tersedia di tabel student_types

        for ($i = 1; $i <= 3; $i++) {
            // Buat Kursus
            $course = Course::create([
                'title' => "Menguasai Keterampilan Tingkat $i",
                'description' => "Kursus komprehensif ini dirancang untuk membantu pelajar di Tingkat $i membangun dasar yang kuat dalam pengetahuan teoretis maupun penerapan praktis.
                Melalui serangkaian pelajaran yang terstruktur, Anda akan mempelajari prinsip-prinsip inti, kerangka kerja, dan studi kasus yang mencerminkan tantangan dunia nyata di berbagai bidang.
                Setiap modul dirancang dengan hati-hati untuk memperkuat pemahaman Anda melalui perpaduan materi multimedia, tutorial terpandu, dan proyek praktis.
                Selain itu, kursus ini menekankan pembelajaran kolaboratif melalui forum diskusi, tinjauan sejawat, dan umpan balik dari instruktur.
                Di akhir kursus ini, Anda akan dibekali keterampilan yang diperlukan untuk melanjutkan ke tingkat berikutnya atau langsung menerapkan apa yang telah Anda pelajari dalam pekerjaan atau studi Anda.
                Baik Anda mengejar keunggulan akademik maupun pertumbuhan profesional, kursus ini akan menjadi batu loncatan penting dalam perjalanan Anda.",
                'image' => "placeholder.png",
                'student_type_id' => Arr::random($studentTypeIds),
            ]);

            // Tambahkan Sertifikat
            Certificate::create([
                'course_id' => $course->id,
                'name' => "Sertifikat Penyelesaian untuk Tingkat $i",
                'image' => "placeholder.png",
            ]);

            // Tambahkan Pelajaran
            for ($j = 1; $j <= 3; $j++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => "Pelajaran $j: Penyelaman Mendalam ke Konsep Utama",
                    'content' => "
        <p>Dalam pelajaran ini, kita akan melihat secara mendalam bagian <strong>$j</strong> dari kompetensi inti untuk Tingkat Keterampilan <strong>$i</strong>.</p>
        <p>Anda akan memahami latar belakang historis dan teoretis dari topik, termasuk evolusi dan relevansinya di dunia digital dan global saat ini.</p>
        <p>Pelajaran ini mencakup:</p>
        <ul>
            <li>Penjelasan mendetail tentang kerangka kerja dan alat</li>
            <li>Studi kasus dunia nyata</li>
            <li>Latihan interaktif dan wawasan dari para ahli</li>
        </ul>
        <p>Di akhir pelajaran ini, Anda diharapkan dapat mengevaluasi secara kritis, menerapkan, dan mengkomunikasikan ide-ide utama dengan percaya diri.</p>
    ",
                    'video_url' => "https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4",
                    'is_active' => true,
                ]);
            }

            // Tambahkan Kuis dan Pertanyaan
            for ($k = 1; $k <= 3; $k++) {
                $quiz = Quiz::create([
                    'course_id' => $course->id,
                    'title' => "Kuis $k: Penilaian Komprehensif untuk Tingkat $i",
                    'is_active' => true,
                ]);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => "Manakah dari pernyataan berikut yang paling mencerminkan prinsip utama yang dibahas dalam Pelajaran $k dari Tingkat $i? Pertimbangkan aspek teoritis dan implikasi dunia nyata dalam jawaban Anda.",
                    'is_active' => true,
                ]);
            }


        }
    }
}
