<div wire:poll.2s>
    <style>
        .nav-link-container {
            display: flex;
            align-items: center;
            position: relative;
        }

        .badge {
           
    position: absolute;
    top: 5px;       
    right: 5px;     /* Center the badge horizontally relative to the right edge */
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 5px; /* Make it a small circle */
    font-size: 10px;  /* Smaller font for a compact badge */
    font-weight: bold;
    min-width: 20px;
    min-height: 20px;
    text-align: center;
    z-index: 1010;   /* Ensure badge is above the icon */
    line-height: 1;  /* Center text inside the small badge */
        }
    </style>

    @if ($unreadCount > 0)
        
            <!-- Badge for unread messages -->
            <span class="badge badge-danger">{{ $unreadCount }}</span>
    @endif
</div>

@livewireScripts
