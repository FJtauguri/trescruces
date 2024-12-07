<?php
namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Monitoring implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;
  public $pendingRequests;

  public function __construct($message, $pendingRequests = null)
  {
    $this->pendingRequests = $pendingRequests;
    $this->message = $message;
  }

  public function broadcastOn()
  {
      return ['staffDashboard'];
  }

  public function broadcastAs()
  {
      return 'Monitoring';
  }
}