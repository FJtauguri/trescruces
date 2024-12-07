<div id="notification-badge-container">
    <!-- Show unread notification count badge if there are unread notifications -->
    @if($unreadCount > 0)
        <span class="notification-badge">{{ $unreadCount }}</span>
    @endif
</div>

@push('script')
<script>
    // Use setInterval to trigger a manual refresh every second (1000ms)
    setInterval(function() {
        // Directly call the Livewire method from JavaScript to refresh the unread count
        @this.call('updateUnreadCount');
    }, 1000); // 1000 milliseconds = 1 second
</script>
@endpush
