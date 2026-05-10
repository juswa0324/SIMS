<!-- Lottie script -->
<script src="https://unpkg.com/lottie-web@5.7.4/build/player/lottie.min.js"></script>

<style>
    #loading {
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #lottie-loader {
        width: 80vw;
        max-width: 400px;
        height: auto;
    }

    #loading-text {
        margin-top: 15px;
        font-size: 22px;
        color: white;
        font-family: "Segoe UI", sans-serif;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
        font-weight: bolder;
        animation: pulseText 1.5s ease-in-out infinite;
    }

    @keyframes pulseText {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.6;
        }

        100% {
            opacity: 1;
        }
    }

    .dots::after {
        content: '';
        display: inline-block;
        animation: dots 1.2s steps(3, end) infinite;
    }

    @keyframes dots {
        0% {
            content: '';
        }

        33% {
            content: '.';
        }

        66% {
            content: '..';
        }

        100% {
            content: '...';
        }
    }
</style>

<div id="loading">
    <div id="lottie-loader"></div>
    <div id="loading-text">LOADING, PLEASE WAIT<span class="dots"></span></div>
</div>

<script>
    // Load Lottie animation
    lottie.loadAnimation({
        container: document.getElementById('lottie-loader'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: 'assets/js/loader/Aurora Loader.json' // Your downloaded JSON file path
    });
</script>