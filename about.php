
<?php require_once("settings.php");?>
<?php include 'header.inc'; ?>
<link rel="stylesheet" href="styles/about.css">
</head>
<main id="main-content">

    <nav class="page-nav" aria-label="Page sections">
        <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#contributions">Contributions</a></li>
            <li><a href="#facts">Fun Facts</a></li>
        </ul>
    </nav>

    <section id="about">
        <h2>About Us</h2>

        <img src="images/web_group.webp"
             alt="Group members collaborating on a web development project"
             class="web-group">

        <ul class="about-list">
            <li>
                G03 Sustainable Energy Solutions Company
                <ul>
                    <li>COS10026 - Applied Web Development</li>
                </ul>
            </li>
        </ul>
    </section>

    <section id="contributions">
        <h2>Member Contributions & Quotes</h2>

        <dl>
            <dt>Sereyboth Sok</dt>
            <dd>
                Developed about page.<br>
                <q>Success is not final, failure is not fatal.</q>
            </dd>

            <dt>Minh Tran</dt>
            <dd>
                Developed apply page.<br>
                <q>Do something today your future self will thank you for.</q>
            </dd>

            <dt>Kevin Devaiah</dt>
            <dd>
                Developed index page.<br>
                <q>Great things never come from comfort zones.</q>
            </dd>

            <dt>Jack Nguyen</dt>
            <dd>
                Developed jobs page.<br>
                <q>Dream big and dare to fail.</q>
            </dd>
        </dl>
    </section>

    <section id="facts">
        <h2>Fun Facts</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Dream Job</th>
                    <th scope="col">Snack</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Sereyboth Sok</td>
                    <td>Game Developer</td>
                    <td>Chips</td>
                </tr>
                <tr>
                    <td>Minh Tran</td>
                    <td>Software Engineer</td>
                    <td>Instant Noodles</td>
                </tr>
                <tr>
                    <td>Kevin Devaiah</td>
                    <td>AI Engineer</td>
                    <td>Chocolate</td>
                </tr>
                <tr>
                    <td>Jack Nguyen</td>
                    <td>Cybersecurity Specialist</td>
                    <td>Cookies</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Acknowledgement of Country -->
    <section class="acknowledgement">
        <h2>Acknowledgement of Country</h2>
        <p>
            We acknowledge the Traditional Owners and Custodians of the land on which we live and work. 
            We pay our respects to Elders past, present, and emerging, and recognise their continuing connection to land, waters, and community.
            We are committed to fostering respect for Aboriginal and Torres Strait Islander peoples and supporting reconciliation through inclusive practices, meaningful engagement, and equitable opportunities.
        </p>
    </section>

</main>

<?php include 'footer.inc'; ?>