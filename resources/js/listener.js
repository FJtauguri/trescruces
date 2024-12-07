import Echo from 'laravel-echo'
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '3b72788ce885d41d158c',
  cluster: 'ap1',
  forceTLS: true,
  encrypted: true,
});

let channel = window.Echo.channel('staffDashboard');

channel.listen('.Monitoring', function(data) {
  console.log('Received data:', data);
  // alert(data.message);
  if (data.message && data.message.pendingRequests) {
    const formattedData = data.message.pendingRequests.map(request => ({
      id: request.id || null,
      full_name: request.full_name | "N/A",
      request_type: request.request_type,
      tracking_code: request.tracking_code,
      created_at: request.created_at,
      status: request.status,
    }));

    if (window.table) {
      window.table.replaceData(formattedData);
      console.log('Formatted data for table:', formattedData);

    } else {
      console.error("Table is not initialized or accessible.");
    }
  } else {
    console.error("No 'pendingRequests' found in the received data.");
  }
});