<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dinamis</title>
    <style>
        .content-section {
            display: none;
        }
        .active {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#" class="menu-item" data-target="home">Home</a></li>
            <li><a href="#" class="menu-item" data-target="about">About</a></li>
            <li><a href="#" class="menu-item" data-target="contact">Contact</a></li>
        </ul>
    </nav>

    <div id="content">
        <div id="home" class="content-section">
            <h1>Welcome to Home</h1>
            <p>This is the home page content.</p>
        </div>
        <div id="about" class="content-section">
            <h1>About Us</h1>
            <p>This is the about page content.</p>
        </div>
        <div id="contact" class="content-section">
            <h1>Contact Us</h1>
            <p>This is the contact page content.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuItems = document.querySelectorAll('.menu-item');
            const contentSections = document.querySelectorAll('.content-section');

            // Function to hide all content sections
            function hideAllSections() {
                contentSections.forEach(section => {
                    section.style.display = 'none';
                });
            }

            // Function to show the target section
            function showSection(target) {
                document.getElementById(target).style.display = 'block';
            }

            // Function to remove active class from all menu items
            function removeActiveClass() {
                menuItems.forEach(item => {
                    item.classList.remove('active');
                });
            }

            // Add event listener to each menu item
            menuItems.forEach(item => {
                item.addEventListener('click', function (event) {
                    event.preventDefault();
                    hideAllSections();
                    showSection(this.getAttribute('data-target'));
                    removeActiveClass();
                    this.classList.add('active');
                });
            });

            // Show the first section by default and set the first menu item as active
            hideAllSections();
            showSection('home');
            menuItems[0].classList.add('active');
        });
    </script>
</body>
</html>
