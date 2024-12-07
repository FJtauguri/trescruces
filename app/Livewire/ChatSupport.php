<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatSupport extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $adminOrStaffUserIds; 

    protected $listeners = [
        'refreshChatMessages' => 'loadMessages',
    ];

    public function mount()
    {
        // Automatically assign chats with all admin or staff users
        $this->adminOrStaffUserIds = User::whereIn('roles', ['admin', 'staff'])->pluck('id')->toArray();

        // Load chat messages for the current admin/staff
        $this->loadMessages();
    }

    public function loadMessages()
{
    // Mark messages as seen for the current user when chatting with admin/staff
    foreach ($this->adminOrStaffUserIds as $adminOrStaffUserId) {
        Chat::where('receiver_id', Auth::id())
            ->where('sender_id', $adminOrStaffUserId)
            ->update(['seen' => true]);
    }

    // Load unique messages between the authenticated user and the selected admin/staff
    $this->messages = Chat::where(function ($query) {
        foreach ($this->adminOrStaffUserIds as $adminOrStaffUserId) {
            $query->orWhere(function ($query) use ($adminOrStaffUserId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $adminOrStaffUserId);
            })
            ->orWhere(function ($query) use ($adminOrStaffUserId) {
                $query->where('sender_id', $adminOrStaffUserId)
                      ->where('receiver_id', Auth::id());
            });
        }
    })
    ->orderBy('created_at', 'asc')
    ->get()
    ->unique('message'); 
}

    public function sendMessage()
    {
        if (!empty($this->newMessage) && !empty($this->adminOrStaffUserIds)) {
            foreach ($this->adminOrStaffUserIds as $adminOrStaffUserId) {
                // Check if the message already exists to avoid duplicates
                $existingMessage = Chat::where('sender_id', Auth::id())
                    ->where('receiver_id', $adminOrStaffUserId)
                    ->where('message', $this->newMessage)
                    ->first();
    
                if (!$existingMessage) {
                    // Create and save the message in the database
                    Chat::create([
                        'sender_id' => Auth::id(),
                        'receiver_id' => $adminOrStaffUserId,
                        'message' => $this->newMessage,
                        'seen' => false,
                    ]);
                }
            }
    
            // Clear the input field
            $this->reset('newMessage');
    
            // Reload messages to reflect the new message
            $this->loadMessages();
        }
    }
    
    public function confirmDeleteConversation()
    {
        $this->dispatch('confirmDeleteConversation');
    }

    public function deleteConversation()
    {
        \Log::info('Delete conversation called'); // Debug log
    
        if (empty($this->adminOrStaffUserIds)) {
            return;
        }
    
        foreach ($this->adminOrStaffUserIds as $adminOrStaffUserId) {
            Chat::where(function ($query) use ($adminOrStaffUserId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $adminOrStaffUserId);
            })
            ->orWhere(function ($query) use ($adminOrStaffUserId) {
                $query->where('sender_id', $adminOrStaffUserId)
                      ->where('receiver_id', Auth::id());
            })
            ->delete();
        }
    
        // Call loadMessages to refresh the messages
        $this->loadMessages();
    }

    public function render()
{
    return view('livewire.chat-support', [
        'messages' => $this->messages
    ]); 
}

}
