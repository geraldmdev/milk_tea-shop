   <!-- social Section Starts Here -->
   <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">BINIBeysik</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

    <script>
    // Inline JavaScript to set the active class based on the current URL
    document.querySelectorAll('.menu li a').forEach(link => {
        if (link.href === window.location.href) {
            link.parentElement.classList.add('active');
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