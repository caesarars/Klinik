<body>
    <p style="font-size:14px; text-align: center;">
        <strong>Klinik dr. Farabi</strong><br>
        Ruko Pesona View Blok i no 3<br>
        Jl. Ir. H Juanda Mekarjaya Sukmajaya Depok<br>
        Telephone : 08-11111-6504
    </p>
    <br>
    <hr style="height: 4px;">
    <hr style="height: 2px;">
    <p style="text-align: right;">
        Depok,
        <?php $date = date_create($resep['tanggal']);
        echo date_format($date, "d-M-Y"); ?>
    </p>
    <p>
        Nomor Resep : <?= $resep['id']; ?>
    </p>
    <br>
    <p><?= $resep['resep']; ?></p>
    <br>
    <br>
    
</body>