<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    public function run(): void
    {


        $imagePath = 'certificates/certificate.jpg';
        $sourceImage = public_path('certificates/certificate.jpg');

        if (!Storage::disk('public')->exists($imagePath)) {
            if (file_exists($sourceImage)) {
                Storage::disk('public')->put($imagePath, file_get_contents($sourceImage));
            } else {
                throw new \Exception("File placeholder.png tidak ditemukan di public/");
            }
        }


        $lenteraCourse = [
            'Matematika Dasar' => [
                'description' => 'Pelajari konsep dasar matematika mulai dari operasi bilangan hingga geometri dasar. Sangat cocok untuk pelajar yang ingin memperkuat pemahaman logika dan perhitungan.',
                'image' => 'courses/matematika.jpeg',
                'lessons' => [
                    'Operasi Bilangan Bulat',
                    'Pecahan dan Desimal',
                    'Dasar-Dasar Geometri'
                ],
                'quizzes' => [
                    'Kuis Operasi Bilangan',
                    'Kuis Pecahan dan Desimal',
                    'Kuis Geometri'
                ]
            ],
            'Bahasa Indonesia' => [
                'description' => 'Tingkatkan kemampuan berbahasa Indonesia, mulai dari membaca, menulis, hingga berbicara secara efektif dan sesuai kaidah.',
                'image' => 'courses/bahasa-indonesia.jpg',
                'lessons' => [
                    'Membaca Efektif',
                    'Menulis Paragraf',
                    'Pidato dan Presentasi'
                ],
                'quizzes' => [
                    'Kuis Membaca',
                    'Kuis Menulis',
                    'Kuis Pidato'
                ]
            ],
            'Ilmu Pengetahuan Alam (IPA)' => [
                'description' => 'Kenali dasar-dasar ilmu alam mulai dari makhluk hidup, materi, hingga energi. Cocok untuk pelajar yang menyukai eksplorasi dunia fisik.',
                'image' => 'courses/ipa.jpeg',
                'lessons' => [
                    'Makhluk Hidup dan Lingkungannya',
                    'Sifat dan Perubahan Materi',
                    'Energi dan Perubahannya'
                ],
                'quizzes' => [
                    'Kuis Ekosistem',
                    'Kuis Materi',
                    'Kuis Energi'
                ]
            ],
            'Agama' => [
                'description' => 'Pelajari nilai-nilai keagamaan, etika, dan moral yang membentuk karakter pribadi dan kehidupan sosial. Materi ini penting untuk menumbuhkan sikap toleransi, saling menghormati, dan tanggung jawab spiritual.',
                'image' => 'courses/agama.jpg',
                'lessons' => [
                    'Ajaran dan Nilai Agama',
                    'Etika dan Moral dalam Kehidupan',
                    'Toleransi Antar Umat Beragama'
                ],
                'quizzes' => [
                    'Kuis Ajaran Agama',
                    'Kuis Etika',
                    'Kuis Toleransi'
                ]
            ]
        ];

        $lenteraAcademy = [
            'Kepemimpinan OSIS' => [
                'description' => 'Pelatihan khusus bagi pengurus OSIS dalam membangun karakter kepemimpinan yang visioner, kolaboratif, dan bertanggung jawab.',
                'image' => 'courses/kepemimpinan.png',
                'lessons' => [
                    'Karakter Pemimpin Sekolah',
                    'Membangun Tim yang Solid',
                    'Etika dan Tanggung Jawab Organisasi'
                ],
                'quizzes' => [
                    'Kuis Kepemimpinan',
                    'Kuis Kerja Tim',
                    'Kuis Etika Organisasi'
                ]
            ],
            'Manajemen Proyek OSIS' => [
                'description' => 'Pelajari cara mengelola program dan kegiatan OSIS secara efektif, mulai dari perencanaan hingga evaluasi.',
                'image' => 'courses/manajemen-proyek.jpg',
                'lessons' => [
                    'Perencanaan Kegiatan',
                    'Pelaksanaan dan Koordinasi',
                    'Evaluasi dan Pelaporan'
                ],
                'quizzes' => [
                    'Kuis Perencanaan',
                    'Kuis Pelaksanaan',
                    'Kuis Evaluasi'
                ]
            ],
            'Public Speaking' => [
                'description' => 'Tingkatkan kepercayaan diri dan keterampilan berbicara di depan umum untuk presentasi maupun kegiatan OSIS.',
                'image' => 'courses/public-speaking.jpg',
                'lessons' => [
                    'Dasar Public Speaking',
                    'Teknik Gestur dan Intonasi',
                    'Berbicara dalam Acara Formal'
                ],
                'quizzes' => [
                    'Kuis Dasar',
                    'Kuis Teknik',
                    'Kuis Acara Formal'
                ]
            ],
            'Kreativitas dan Inovasi' => [
                'description' => 'Bangun kemampuan berpikir kreatif dan inovatif dalam merancang kegiatan OSIS yang menarik dan bermanfaat.',
                'image' => 'courses/kreativitas.png',
                'lessons' => [
                    'Ide dan Brainstorming',
                    'Desain Kegiatan Kreatif',
                    'Evaluasi Inovasi'
                ],
                'quizzes' => [
                    'Kuis Brainstorming',
                    'Kuis Desain',
                    'Kuis Inovasi'
                ]
            ]
        ];

        $video = 'https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4';

        foreach (
            [
                1 => $lenteraCourse,
                2 => $lenteraAcademy
            ] as $studentTypeId => $courses
        ) {
            foreach ($courses as $courseTitle => $data) {
                $course = Course::create([
                    'title' => $courseTitle,
                    'description' => $data['description'],
                    'image' => $data['image'],
                    'student_type_id' => $studentTypeId,
                ]);

                Certificate::create([
                    'course_id' => $course->id,
                    'name' => 'Sertifikat Penyelesaian: ' . $courseTitle,
                    'image' => 'certificates/certificate.jpg'
                ]);

                foreach ($data['lessons'] as $index => $lessonTitle) {
                    Lesson::create([
                        'course_id' => $course->id,
                        'title' => $lessonTitle,
                        'content' => "<p><strong>{$lessonTitle}</strong> adalah bagian penting dari pembelajaran ini. Anda akan mempelajari topik ini melalui penjelasan mendalam, contoh praktis, dan studi kasus nyata.</p><p>Kami akan membahas teori dasar, penerapannya dalam kehidupan sehari-hari, serta menyediakan latihan interaktif untuk memperkuat pemahaman Anda.</p><p>Setiap bagian pelajaran dirancang agar Anda tidak hanya memahami secara konseptual, tetapi juga mampu menerapkan pengetahuan secara kritis dan reflektif. Selamat belajar!</p>",
                        'video_url' => $video,
                        'is_active' => true
                    ]);
                }

                foreach ($data['quizzes'] as $quizTitle) {
                    $quiz = Quiz::create([
                        'course_id' => $course->id,
                        'title' => $quizTitle,
                        'is_active' => true
                    ]);

                    Question::create([
                        'quiz_id' => $quiz->id,
                        'question_text' => "Apa konsep utama yang dibahas dan bagaimana penerapannya?",
                        'is_active' => true
                    ]);
                }
            }
        }
    }
}
