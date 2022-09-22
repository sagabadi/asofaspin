<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Asofa - Spin Wheel</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"/>
    <!-- Font awesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css')?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
  </head>
  <body>
    <header class='header-wrapper' id='header' itemscope='itemscope' itemtype='http://schema.org/WPHeader'>
    <b:section class='header' id='header' maxwidgets='1' showaddelement='no'>
    <b:widget id='Header1' locked='true' title='Asofa.id' type='Header'></b:widget>
    </b:section>
    </header>
    <div class="primary-wrapper">
      <h4 class="site-title">Asofa.id</h4>
    </div>
    <div class="wrapper">
      <div id="final-value">
        <div class="fade-in-text">
          <p>Selamat kamu dapat ${i.value}!</p><p class="text">&nbsp;</p>
          <a href="${waMessage}" class="button-17">
            <i class="fa fa-share-alt" aria-hidden="true"></i> Klaim Hadiah Sekarang
          </a>
        </div>
      </div>
    </div>
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Script -->
    <script src="script.js"></script>
  </body>
</html>
