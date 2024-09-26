<?php
session_start();
include 'db_connect.php';
include 'header.php';

// Récupération des événements à venir
$sql = "SELECT * FROM nomevent WHERE date >= CURDATE() ORDER BY date ASC";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

$conn->close();
?>

   
   <style>
    body{
        background-image: url("images/Bg.jpg");
        background-repeat: no-repeat;
    }
   </style>



<body>
<div style="padding: 80px;">

            <section class="container mt-5 mb-5">
                <div class="row">
                <?php if (!empty($events)) :?>
                    <?php foreach ($events as $event) :?>
                  <div class="col-lg-3 col-md-6">
                     <div class="g-card">
                         <div class="img-container">
                         <a href="#"><?php
                                // Convert binary image data to base64 and embed it in an <img> tag
                                $base64Image = base64_encode($event['image']);
                                echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Event Image">';
                                ?>
                                </a>
                         </div>
                         <div class="g-card-desc">
                             <div class="mb-3">
                                <span class="g-category"><?php echo htmlspecialchars($event['titre']); ?></span>
                             </div>
                                 <h3 class="g-title">
                                    <a href="#"><?php echo htmlspecialchars($event['titre']); ?></a>
                                </h3>
                                    <p class="g-address">
                                        <strong><?php echo htmlspecialchars($event['ville']);?></strong>
                                        <br>
                                       <h4><?php echo htmlspecialchars($event['Adresse']);?></h4>
                                      
                                         <?php echo htmlspecialchars($event['Nplace']) . " places"; ?>
                                          <br>
                                      <?php echo htmlspecialchars($event['date']); ?>
                                    </p>
                                <div class="d-flex justify-content-between g-price-container">
                                            <div class="g-price">
                                                    <label for="">A partir de :</label>
                                                    <p>
                                                     <?php echo htmlspecialchars($event['Prix']) . " <span>MAD</span>"; ?>
                                                    </p>
                                            </div>
                                            <form action="venteticket.php" method="get">
                                            <input type="hidden" name="idEvent" value="<?php echo $event['idEvent']; ?>">
                                             <button type="submit" class="g-btn-orange">J'achète</button>
                                        </form>
                                    </div>
                                 </div>
                            </div>
                             
                    </div>
                    <?php endforeach; ?>
                     <?php else : ?>
                     <?php endif; ?>
              </div>
        </div>
    </section>
   

    </div>
</body>
</html>

