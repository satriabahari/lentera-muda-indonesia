<?php

namespace App\Livewire;

use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CertificatePreview extends Component
{
    public Certificate $certificate;
    public bool $isCompleted;

    public function mount(Certificate $certificate)
    {
        $this->certificate = $certificate;

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil semua quiz ID dari course
        $quizIds = $certificate->course->quizzes->pluck('id');

        // Ambil semua quiz ID yang sudah dijawab oleh user DAN punya score
        $answeredWithScoreQuizIds = $user->studentAnswers()
            ->whereIn('quiz_id', $quizIds)
            ->whereNotNull('score') // hanya jawaban yang punya score
            ->pluck('quiz_id')
            ->unique();

        // Syarat kelulusan: semua quiz dari course sudah ada score-nya
        $this->isCompleted = $answeredWithScoreQuizIds->count() === $quizIds->count();
    }

    public function render()
    {
        return view('livewire.certificate-preview', [
            'certificate' => $this->certificate
        ]);
    }
}
