<?php 
namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use App\Events\NotificationUpdated;
use Illuminate\Support\Facades\Auth;

class UnreadNotificationBadgeCounter extends Component
{
    public $unreadCount = 0;

    public function mount()
    {
        $this->updateUnreadCount();
    }

    public function updateUnreadCount()
    {
        // Get the unread notification count
        $this->unreadCount = Notification::where('receiver_id', Auth::id())
                                          ->where('is_read', false)
                                          ->count();

        // Broadcast the event
        broadcast(new NotificationUpdated($this->unreadCount));
    }
     // Listener for events
    protected $listeners = ['notificationUpdated' => 'refresh'];

    public function refresh()
    {
        // This method will be triggered by the event to refresh the unread count
        $this->updateUnreadCount();
    }


    public function render()
    {
        return view('livewire.unread-notification-badge-counter');
    }
}


// use Illuminate\Support\Facades\Auth;

// class UnreadNotificationBadgeCounter extends Component
// {
//     public $unreadCount = 0;

//     public function mount()
//     {
//         $this->updateUnreadCount();
//     }

//     public function updateUnreadCount()
//     {
//         // Get the count of unread notifications for the logged-in user
//         $this->unreadCount = Notification::where('receiver_id', Auth::id())
//                                         ->where('is_read', false)
//                                         ->count();
//     }

//     // Listener for events
//     protected $listeners = ['notificationUpdated' => 'refresh'];

//     public function refresh()
//     {
//         // This method will be triggered by the event to refresh the unread count
//         $this->updateUnreadCount();
//     }

//     public function render()
//     {
//         return view('livewire.unread-notification-badge-counter');
//     }
// }
