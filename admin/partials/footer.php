 <!-- Footer Section Starts -->
 <div class="footer">
         <div class="wrapper">
             <p class=text-center>2024 All rights reserved, BINIBeysik Brew, Developed  By <a href="#">BINIBEYSIK </a></p>
        </div>
    </div>

    <!-- Footer Section Ends -->
    <script>
    // Inline JavaScript to set the active class based on the current URL
    document.querySelectorAll('.menu li a').forEach(link => {
        if (link.href === window.location.href) {
            link.parentElement.classList.add('active'); // Add active class
        }
    });

    // Target the logout link
const logoutLink = document.querySelector('.logout');

// Add an event listener (e.g., for confirmation before logout)
logoutLink.addEventListener('click', function(event) {
    const confirmation = confirm("Are you sure you want to logout?");
    if (!confirmation) {
        event.preventDefault(); // Prevent logout if the user cancels
    }
});

</script>
    </body>
    </html>