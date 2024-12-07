<div class="chat-window" id="chatWindow">
    <style>
        .chat-window {
            width: 300px;
            max-width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chat-title {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .title-text {
            flex: 1;
            font-size: 16px;
        }

        .btn-close {
            position: absolute;
            right: 10px;
            top: 10px;
            background: none;
            border: none;
            font-size: 16px;
            color: white;
            cursor: pointer;
        }

        .three-dots-menu {
            position: relative;
            margin-right: 30px; /* Space to avoid overlap with the close button */
        }

        .three-dots-menu button {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        .three-dots-menu button  a:hover {
            background-color: #ddd;
        }


        .three-dots-menu-content {
            display: none;
            position: absolute;
            top: 25px;
            right: 0;
            background-color: white;
            min-width: 120px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .three-dots-menu-content a {
            color: black;
            padding: 8px 12px;
            text-decoration: none;
            display: block;
            font-size: 1rem;
        }

        .three-dots-menu-content a:hover {
            background-color: #ddd;
        }

        .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            max-height: 400px;
        }

        .messages {
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 5px 10px;
            border-radius: 15px;
            margin: 5px 0;
            max-width: 70%;
        }

        .message-sent {
            align-self: flex-end;
            background-color: #007bff;
            color: white;
        }

        .message-received {
            align-self: flex-start;
            background-color: #f1f1f1;
            color: black;
        }

        .chat-footer {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .chat-footer input {
            flex: 1;
            margin-right: 10px;
        }

        .chat-footer button {
            height: 40px;
        }
    </style>

    <div class="chat-title">
        <span class="title-text">Barangay Chat Support</span>
        <div class="three-dots-menu">
        <button title="Delete Conversation"onclick="confirmDelete()">&#x1F5D1;</button>
            <!-- <button title="Options" onclick="toggleMenu(event)">&#x22EE;</button>
            <div class="three-dots-menu-content" id="menuContent">
                <a href="#" onclick="confirmDelete()">
                 <button class="btn btn-danger"></button>Delete Conversation
                </a>
            </div> -->
        </div>
        <button type="button" class="btn-close" id="closeChat" aria-label="Close">X</button>
    </div>

    <div class="chat-body" id="chatBody">
        <div class="messages">
            @foreach($messages as $message)
                <div class="message {{ $message->sender_id == auth()->id() ? 'message-sent' : 'message-received' }}">
                    <strong>{{ $message->sender_id == auth()->id() ? 'Me' : 'Brgy. Support' }}:</strong>
                    <span> {!! nl2br(preg_replace('/https?:\/\/[^\s<]+/', '<a style="color:red;" href="$0" target="_blank">$0</a>',$message->message)) !!}</span>
                    <br>
                    <small class="text-muted" style="font-size:12px;"><em>{{ $message->created_at->diffForHumans() }}</em></small>
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="chat-footer">
        <input type="text" class="form-control" placeholder="Type your message..." 
            wire:model.debounce.200ms="newMessage" 
            wire:keydown.enter="sendMessage">
        <button class="btn btn-primary" type="button" wire:click="sendMessage"> 
            <span wire:loading.remove>Send</span>
            <span wire:loading></span>
        </button>
    </div>

    <script>
        function scrollToBottom() {
            const chatBody = document.getElementById('chatBody');
            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            scrollToBottom();
        });

        const chatBody = document.getElementById('chatBody');
        const observer = new MutationObserver(scrollToBottom);
        observer.observe(chatBody, { childList: true, subtree: true });

        function confirmDelete() {
            if (confirm("Are you sure you want to delete the entire conversation?")) {
                @this.deleteConversation(); 
            }
        }

        function toggleMenu(event) {
            event.stopPropagation(); // Prevent the event from bubbling up
            const menu = document.getElementById('menuContent');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('menuContent');
            if (menu && event.target.closest('.three-dots-menu') === null) {
                menu.style.display = 'none';
            }
        });

        document.querySelector('.chat-footer button').addEventListener('click', function(event) {
            // No need to stop propagation here
        });

        document.querySelector('.chat-footer input').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                // No need to stop propagation here
            }
        });

        document.getElementById('chatWindow').addEventListener('show', scrollToBottom);
    </script>
</div>
