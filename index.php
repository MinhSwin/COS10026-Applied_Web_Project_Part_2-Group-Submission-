<?php include 'header.php'; ?>
<main>
    <!-- This section introduces the company and explains what it does.
         Inline CSS is used here only because the assignment requires at least one inline example. -->
    <section style="margin: 20px;">
        <h2>Welcome</h2>
        <p>
            Sustainable Energy Solutions is a renewable energy company focused on developing 
            innovative solar and wind technologies. We aim to reduce environmental impact 
            while supporting communities with sustainable energy solutions.
        </p>

        <!-- This image reinforces the clean-energy theme and makes the homepage less text-heavy -->
        <img src="images/main-logo-renewable-energies.avif" 
             alt="Wind turbines and solar panels" class="main-image">
    </section>

    <!-- A search box is included because it is a required homepage feature.
         It just takes user to jobs page. -->
    <section>
        <h2>Search Opportunities</h2>
        <form action="jobs.html" method="get">
            <label for="search">Search jobs:</label>
            <input type="text" id="search" name="search" placeholder="Search job titles">
            <button type="submit">Search</button>
        </form>
    </section>

    <!-- The table presents company growth to embolden possible applicants.
         Rowspan and colspan are used to meet the requirement for merged table cells. -->
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

    <!-- This acknowledgement is included to meet the assignment requirement.
         It is placed on the homepage so it is visible to all visitors. -->
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
</body>
</html>