<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- These meta tags help describe the page to browsers and search engines -->
    <meta name="description" content="Sustainable Energy Solutions Company">
    <meta name="keywords" content="renewable energy, solar, wind">
    <meta name="author" content="Kevin Devaiah Baliyamederira Vinod,Sereyboth Sok ,Minh Tran ,Jack Nguyen">
    <!-- This viewport setting is what allows the layout to scale properly on phones and tablets -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sustainable Energy Solutions</title>

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="style.css">

    <!-- Internal CSS is included because the assignment requires at least one example on each page -->
    <style>
        /* The slogan is styled separately sto stand out from the background */
        .slogan {
            font-style: italic;
            color: #76fa7d;
        }
    </style>
</head>

<body>

<header>
    <!-- The logo gives the company an identity at the top of the page.
         Alt text is included so the image still has meaning for screen readers and if it fails to load. -->
    <img src="images/green-energy-logo.webp" alt="Solar energy logo" class="logo">

    <!-- The h1 is the main heading of the page and identifies the company clearly -->
    <h1>Sustainable Energy Solutions</h1>

    <!-- The slogan supports branding and gives the homepage a more professional feel -->
    <p class="slogan">Powering a Greener Tomorrow</p>

    <!-- Navigation is placed in the header so users can move to other pages -->
    <?php include 'nav.inc'; ?>
</header>
