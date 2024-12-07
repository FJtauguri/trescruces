<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle">Loading.....</title> 
    <style>
        /* Center the entire preloader on the page */
        #preloaderz {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; 
        }
        
        #loaderz {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .load-image img {
            max-width: 100px;
            height: auto;
        }
        
        .rect-loader {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            height: 40px;
            border: 1px solid black;
            position: relative;
            overflow: hidden;
            margin-top: 20px;
            border-radius: 8px;
        }
        
        .fill-load {
            background-color:  #ffc107;
            height: 100%;
            width: 0;
            position: absolute;
            top: 0;
            left: 0;
            animation: fillAnimation 1.5s ease-in-out infinite; 
        }
        
        @keyframes fillAnimation {
            0% {
                width: 0;
            }
            50% {
                width: 100%;
            }
            100% {
                width: 0;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script> 
</head>
<body id="bodyWithPreloader"> 
    <div id="preloaderz">
        <div id="loaderz">
            <div id="lottie-animation" class="load-image">
                 @php
        use App\Models\GeneralConf;

        // Fetch the configuration data
        $generalConfig = GeneralConf::first();
    @endphp
            
                <img id="load-img"  src="{{ asset('assets/head_logo/' . ($generalConfig->logo ?? 'default-logo.png')) }}" alt="">
            </div>
            <div class="rect-loader">
                <div class="fill-load"></div>
            </div>
            <h5 id="loadingMessage">Loading...</h5> 
        </div>
    </div> 
    <script>
        // Display preloader while page is loading
        document.body.style.overflow = 'hidden'; 
        
        // Function to fetch and apply JSON data
        async function fetchDataAndApply() {
            try {
                const response = await fetch('./assets/json/preloader.json');
                const data = await response.json();
                
                // Update title
                document.getElementById('pageTitle').textContent = data.title;
                
                // Update loading message
                document.getElementById('loadingMessage').textContent = data.message;
                
                // Render Lottie animation
                lottie.loadAnimation({
                    container: document.getElementById('lottie-animation'), 
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: './assets/json/preloader.json' 
                });
            } catch (error) {
                console.error('Error fetching JSON data:', error);
            }
        }

        window.addEventListener('load', function() {
            // Fetch and apply JSON data
            fetchDataAndApply();
            // Hide preloader when content is loaded
            document.body.style.overflow = ''; // Allow scrolling after loading
            document.getElementById('preloaderz').style.display = 'none';
        });
    </script>
</body>
</html>
