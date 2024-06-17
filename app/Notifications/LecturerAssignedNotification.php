<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LecturerAssignedNotification extends Notification
{
    use Queueable;

    protected $lecture;

    /**
     * Create a new notification instance.
     */
    public function __construct($lecture)
    {
        $this->lecture = $lecture;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('You have been assigned to a new lecture.')
                    ->line('Lecture Title: ' . $this->lecture->title)
                    ->line('Lecture Date: ' . $this->lecture->date)
                    ->action('View Lecture', url('/lectures/' . $this->lecture->id))
                    ->line('Thank you for your attention!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'lecture_id' => $this->lecture->id,
            'lecture_title' => $this->lecture->title,
            'lecture_date' => $this->lecture->date,
            //
        ];
    }
}
