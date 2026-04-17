<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class aproveCatigory implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */


    public function __construct(public Category $category)
    {

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
   public function broadcastOn()
    {
        return new PrivateChannel('users.'.$this->category->add_by);
    }

    public function broadcastAs(): string
    {
        return 'category.approved';


    }

    public function broadcastWith(): array
    {
        return [
            'message' => 'Your category "' . $this->category->name . '" has been approved',
            'type' => 'approved',
            'category_id' => $this->category->id,
            'url' => route('categories.index'),
        ];

        }
}
