<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Asofa - Spin Wheel</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"/>
    <!-- Font awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css')?>">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/style.css')?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img.ico/favicon-16x16.png')?>">
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
      <div class="container">
        <canvas id="wheel"></canvas>
        <button id="spin-btn" onclick="spin()">Spin</button>
        <img src="<?= base_url('assets/spinner-arrow-.svg')?>" class="spinner-arrow" alt="spinner-arrow" />
      </div>
      <div id="final-value">
        <p>Klik tombol SPIN untuk memulai</p>
        <p class="text">Kamu cuma punya 1 kali kesempatan</p>
        <p class="text">Semoga beruntung!</p>
      </div>
    </div>
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Script -->
    <!-- <script src="<?= base_url('assets/script.js')?>"></script> -->
    <script type="text/javascript">
      const wheel = document.getElementById("wheel");
      const spinBtn = document.getElementById("spin-btn");
      const finalValue = document.getElementById("final-value");
      const buttonWa = document.getElementById("button-wa");
      let i = 0;
      //Object that stores values of minimum and maximum angle for a value
      const rotationValues = [
        { minDegree: 0, maxDegree: 30, value: "Kemeja" },
        { minDegree: 31, maxDegree: 90, value: "Blouse" },
        { minDegree: 91, maxDegree: 150, value: "Totebag" },
        { minDegree: 151, maxDegree: 210, value: "Gamis" },
        { minDegree: 211, maxDegree: 270, value: "Tunik" },
        { minDegree: 271, maxDegree: 330, value: "Jilbab" },
        { minDegree: 331, maxDegree: 360, value: "Kemeja" },
      ];
      //Size of each piece
      const data = [16, 16, 16, 16, 16, 16];
      //background color for each piece
      var pieColors = [
        "#CEE5D0",
        "#8FBDD3",
        "#7882A4",
        "#C1D5A4",
        "#E5E3C9",
        "#94B49F",
        "#94B49F",
      ];
      //Create chart
      let myChart = new Chart(wheel, {
        //Plugin for displaying text on pie chart
        plugins: [ChartDataLabels],
        //Chart Type Pie
        type: "pie",
        data: {
          //Labels(values which are to be displayed on chart)
          labels: ["Blouse", "Kemeja", "Jilbab", "Tunik", "Gamis", "asda"],
          //Settings for dataset/pie
          datasets: [
            {
              backgroundColor: pieColors,
              data: data,
            },
          ],
        },
        options: {
          //Responsive chart
          responsive: true,
          animation: { duration: 0 },
          plugins: {
            //hide tooltip and legend
            tooltip: false,
            legend: {
              display: false,
            },
            //display labels inside pie chart
            datalabels: {
              color: "#ffffff",
              formatter: (_, context) => context.chart.data.labels[context.dataIndex],
              font: { size: 15 },
            },
          },
        },
      });
      //display value based on the randomAngle
      const valueGenerator = (angleValue) => {
        for (let i of rotationValues) {
          //if the angleValue is between min and max then display it
          if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
            //i.value == 'Gamis' || i.value == 'Kemeja'  || i.value == 'Blouse'  || i.value == 'Totebag'
            if(i.value == 'Gamis'){
              console.log("N");
              spin();
            } else {
              setTimeout(function(){
                const waMessage = 'https://wa.me/6285697984834/?text=Halo!%0ASaya%20{nama}%20mau%20klaim%20hadiah%20{namahadiah}.%20Alamat:%20%20{alamat}%20.%20No%20HP:%20{nohp}.%20Terimakasih!';
                finalValue.innerHTML = 
                `<div class="fade-in-text">
                  <p>Selamat kamu dapat ${i.value}!</p><p class="text">&nbsp;</p>
                  <a href="${waMessage}" class="button-17">
                    <i class="fa fa-share-alt" aria-hidden="true"></i> Klaim Hadiah Sekarang
                  </a>
                </div>`;
              }, 800); 

              // finalValue.innerHTML = `<p>Selamat kamu dapat ${i.value}!</p><br>
              //   <button class="button-17">
              //     <i class="fa fa-share-alt" aria-hidden="true"></i> Klaim Hadiah Sekarang
              //   </button>
              //   <div class ="loader"></div>`;
              console.log("Y");
              break;
            }
          }
        }
      };

      //Spinner count
      let count = 0;
      //100 rotations for animation and last rotation for result
      let resultValue = 101;

      function spin(){
        //Start spinning
        spinBtn.disabled = true;
        //Empty final value
        // finalValue.innerHTML = ``;
        //Generate random degrees to stop at
        let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
        //Interval for rotation animation
        let rotationInterval = window.setInterval(() => {
          //Set rotation for piechart
          /*
          Initially to make the piechart rotate faster we set resultValue to 101 so it rotates 101 degrees at a time and this reduces by 1 with every count. Eventually on last rotation we rotate by 1 degree at a time.
          */
          myChart.options.rotation = myChart.options.rotation + resultValue;
          //Update chart with new value;
          myChart.update();
          //If rotation>360 reset it back to 0
          if (myChart.options.rotation >= 360) {
            count += 1;
            resultValue -= 5;
            myChart.options.rotation = 0;
          } else if (count > 15 && myChart.options.rotation == randomDegree) {
            valueGenerator(randomDegree);
            clearInterval(rotationInterval);
            count = 0;
            resultValue = 101;
          }
        }, 10);
      }

    </script>
  </body>
</html>
