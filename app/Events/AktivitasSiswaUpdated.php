<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Superuser\DashboardController;
class AktivitasSiswaUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $chartData;

    public function __construct(array $chartData)
    {
        $this->chartData = $chartData;
    }

    public function broadcastOn()
    {
        return new Channel('dashboard');
    }

    public function broadcastWith()
    {
        return $this->chartData;
    }
}
