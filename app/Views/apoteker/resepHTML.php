<body>
    <!-- <p style="text-align: right;">
        Depok,
        <?php $date = date_create($resep['tanggal']);
        echo date_format($date, "d-M-Y"); ?>
    </p>
    <p>Nomor Resep : <?= $resep['id']; ?>
    </p> -->
    <?php foreach ($resep['resep'] as $data) :  ?>
        <p><?= $data; ?></p>
    <?php endforeach; ?>

</body>