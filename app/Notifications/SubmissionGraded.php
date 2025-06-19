<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Submission;

class SubmissionGraded extends Notification implements ShouldQueue
{
    use Queueable;

    public $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Assignment Submission Has Been Graded')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your submission for the assignment "' . $this->submission->assignment->title . '" has been graded.')
            ->line('Grade: ' . ($this->submission->grade ?? 'N/A'))
            ->line('Feedback: ' . ($this->submission->feedback ?? 'No feedback provided.'))
            ->action('View Submission', url('/assignments/' . $this->submission->assignment_id . '/submit'))
            ->line('Thank you for using the Assignment Submission Portal!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'assignment_id' => $this->submission->assignment_id,
            'assignment_title' => $this->submission->assignment->title,
            'grade' => $this->submission->grade,
            'feedback' => $this->submission->feedback,
            'submission_id' => $this->submission->id,
        ];
    }
}
