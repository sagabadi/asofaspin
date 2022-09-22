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
    <?php
      $db      = \Config\Database::connect();
      $sql = "select * from hadiah";
      $query = $db->query($sql);
      $cek_h = $query->getResult();
      $hadiah_all = $cek_h;

      $sql = "select * from hadiah where is_valuable = 1";
      $query = $db->query($sql);
      $cek_v = $query->getResult();
      $hadiah_valuable = $cek_v;

      $degree = 360 / count($cek_h);

      $percent = 100 / count($cek_h);
    ?>
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
      var index = 0;
      var min = 360 - Math.floor(<?php echo $degree?>);
      var nama_hadiah_ = '';
      var max = 360;
      const rotationValues = [];
      const data = [];
      const data_valuable = [];
      const label_data = [];
      //Object that stores values of minimum and maximum angle for a value
      <?php foreach ($hadiah_all as $v): ?>
        var nama_hadiah = '<?php echo $v->nama_hadiah?>';
        var text = [{ minDegree: min, maxDegree: max, value: nama_hadiah, id_hadiah: <?php echo $v->id?>}]
        rotationValues.push(text[0]);
        data.push(Math.floor(<?php echo $percent?>));
        label_data.push('<?php echo $v->nama_hadiah?>');
        index = index + 1;
        min = min - Math.floor(<?php echo $degree?>);
        max = max - Math.floor(<?php echo $degree?>);
      <?php endforeach; ?>
      //Size of each piece
      <?php foreach ($hadiah_valuable as $v): ?>
        data_valuable.push('<?php echo $v->nama_hadiah?>');
      <?php endforeach;?>

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
          labels: label_data,
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
            // if(i.value == 'Gamis'){
            if(data_valuable.includes(i.value)){
              console.log("N");
              spin();
            } else {
              setTimeout(function(){
                // const waMessage = 'https://wa.me/6285697984834/?text=Halo!%0ASaya%20{nama}%20mau%20klaim%20hadiah%20{namahadiah}.%20Alamat:%20%20{alamat}%20.%20No%20HP:%20{nohp}.%20Terimakasih!';
                const waMessage = 'https://asofaspin.88cellgrup.com/update_is_claim?keygen=20220922131233&id_hadiah='+i.id_hadiah;
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
        myFunction();
      }
      function myFunction() {
        $.ajax({
            url:"<?php echo base_url('/add_counter?keygen=20220922131233');?>",
            method:"GET",
            // data:{id:id},
            dataType:"JSON",
            // success:function(data)
            // {

            // }
        });
        // window.location = urls;
    //   /* Select the text field */
    //   copyText.select();
    //   copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
    //   /* Copy the text inside the text field */
    //   navigator.clipboard.writeText(copyText.value);
    
      /* Alert the copied text */
    //   alert("Copied the text: " + copyText);
    }

    </script>
  </body>
</html>
