<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AktivitasSiswaUpdated implements ShouldBroadcastNow
{
    use SerializesModels;

    public $chartData;
    public $timeRange; // <-- Tambahkan properti ini

    public function __construct(array $chartData, string $timeRange = 'week')
    {
        $this->chartData = $chartData;
        $this->timeRange = $timeRange;
    }

    public function broadcastOn()
    {
        return new Channel('dashboard');
    }

    public function broadcastWith()
    {
        return $this->chartData; // langsung kirim data yang sudah siap
    }

    public function broadcastAs()
{
    return 'AktivitasSiswaUpdated';
}

}

