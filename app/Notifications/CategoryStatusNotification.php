<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CategoryStatusNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $category;
    protected $status; // approved | rejected

    public function __construct($category, $status)
    {
        $this->category = $category;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

     public function toDatabase($notifiable)
    {
        return [
            'message' => $this->Message(),
            'type' => $this->status,
            'category_id' => $this->category->id,
            'url' => route('categories.index'),
        ];
    }

    private function Message()
    {
        return match ($this->status) {
            'approved' => 'Your category "' . $this->category->name . '" has been approved',
            'rejected' => 'Your category "' . $this->category->name . '" has been rejected',
            default => 'Category status updated',
        };
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->Message(),
            'type' => $this->status,
            'category_id' => $this->category->id,
            'url' => route('categories.index'),
            'created_at' => now()->toDateTimeString(),  // اختياري
        ]);
    }
}
