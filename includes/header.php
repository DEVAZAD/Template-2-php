<header id="head">
    <nav class="navbar bread-slices">
        <div class="head-container  flex">
            <div>
                <a href="/" class="logo">
                    <img src="/assets/logo.png" alt="ABCEL Logo">

                    <h2>ABCEL</h2>
                </a>
            </div>
            <div class="hamburger">&#9776;</div>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/#about-us">About Us</a></li>
                <li><a href="/#activities">Activities</a></li>
                <li><a href="/#team">Team</a></li>
                <li><a href="/#partners">Partners</a></li>
                <li><a href="/#gallery">Gallery</a></li>
                <li><a href="/#contact">Connect</a></li>
                <li><a href="/pages/login.php">Login</a></li>
            </ul>
        </div>
        <script>
            document.querySelector(".hamburger").addEventListener("click", function() {
                document.querySelector(".nav-links").classList.toggle("active");
            });

            document.querySelectorAll(".nav-links a").forEach(function(link) {
                link.addEventListener("click", function() {
                    document.querySelector(".nav-links").classList.remove("active");
                });
            });
        </script>
    </nav>
</header>