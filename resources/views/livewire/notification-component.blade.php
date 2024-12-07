<div id="drawerContainer" class="drawerContainerHide">
    <div class="notification-container notifDawHide" wire:poll.2000ms="loadMessages" id="notifDaw" style="overflow-y: auto; max-height: 80vh;">

        <button id="notifClose" style="float: right; border: none; color: black; background-color: transparent;" title="Close">
            X Close
        </button>
        <br>
        <button style="float: right; border: none; color: red; background-color: transparent;" wire:confirm="Do you want to delete all your notifications?" wire:click="deleteAllNotifications" title="Clear all"> 
            <i class="fa fa-trash"></i> Clear All
        </button>
        <h4>Notifications</h4>
        
        @if($messages->isEmpty())
            <p>No notifications yet.</p>
        @else
            <ul>
                @foreach($messages as $notification)
                    <li wire:click="markAsRead({{ $notification->id }})" style="cursor: pointer; padding: 10px; border-bottom: 1px solid #ddd; display: flex; flex-direction: column; gap: .5rem; {{ !$notification->is_read ? 'font-weight: bold;' : '' }}">
                        <div style="display: flex; flex-direction: column; gap: .5rem; align-items: start; justify-content: flex-start">
                            <div style="display: flex; gap: .5rem; align-items: center;">
                                <div style="width: 10px; background-color: red; height: 10px; border-radius: 50%; display: {{ $notification->is_read ? 'none' : 'block' }}"></div>
                                <strong>{{ ucwords($notification->sender->roles) }}</strong>
                            </div>
                           
                            <p>{{ $notification->message }}</p>
                        </div>
                        <strong>{{ $notification->created_at->diffForHumans() }}</strong>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@push('script')
<script>
    // Function to trigger automatic reload every 10 seconds
    setInterval(function() {
        Livewire.emit('refreshNotifications');
    }, 10000); // 10000 milliseconds (10 seconds)

    // Optional: You can add more advanced auto-reloading or actions here
    window.addEventListener('livewire:load', function () {
        console.log("Livewire component is loaded.");
    });
</script>
@endpush
