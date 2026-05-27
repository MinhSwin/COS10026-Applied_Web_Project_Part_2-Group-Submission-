<?php include 'header.inc'; ?>
<link rel="stylesheet" href="styles/index.css">
</head>
<?php require_once "settings.php"; ?>


<main>

    <section style="margin: 20px;">
        <h2>Welcome</h2>
        <p>
            Sustainable Energy Solutions is a renewable energy company focused on developing
            innovative solar and wind technologies. We aim to reduce environmental impact
            while supporting communities with sustainable energy solutions.
        </p>

        <img src="images/main-logo-renewable-energies.avif" 
             alt="Wind turbines and solar panels" class="main-image">
    </section>

    <section>
        <h2>Search Opportunities</h2>
        <form action="jobs.php" method="get">
            <label for="search">Search jobs:</label>
            <input type="text" id="search" name="search" placeholder="Search job titles">
            <button type="submit">Search</button>
        </form>
    </section>

    <section>
        <h2>Our Growth</h2>
        <table>
            <caption>Renewable Projects Overview</caption>
            <tr>
                <th rowspan="2">Year</th>
                <th colspan="2">Projects Completed</th>
            </tr>
            <tr>
                <th>Solar</th>
                <th>Wind</th>
            </tr>
            <tr>
                <td>2024</td>
                <td>18</td>
                <td>12</td>
            </tr>
            <tr>
                <td>2025</td>
                <td>25</td>
                <td>16</td>
            </tr>
        </table>
    </section>

    <section class="acknowledgement">
        <h2>Acknowledgement of Country</h2>
        <p>
            We acknowledge the Traditional Owners of the land on which we operate and pay our respects 
            to Elders past, present and emerging. We are committed to supporting Aboriginal and Torres 
            Strait Islander peoples through inclusive employment and sustainable partnerships.
        </p>
    </section>

</main>

<?php include 'footer.inc'; ?>