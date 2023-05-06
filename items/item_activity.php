<div class="container p-0 pt-2">
    <div class="d-flex w-100 justify-content-between">
        <h1>Mahasiswa</h1>
    </div>
    <div class="row">
        <?php   

        $query = mysqli_query($conn, "SELECT * FROM activity WHERE peserta_act='college_student'");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <div class="col-xl-3 d-flex justify-content-center my-2">
                <button data-bs-toggle="offcanvas" data-bs-target="#act_<?php echo $data['id_act'] ?>" class="btn btn-warning p-3" style="width: 90%;"><?php echo $data['nama_act']; ?></button>
            </div>
        <?php
            getDataTable("college_student", $data, $conn);
        }
        ?>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <h1>Pengurus</h1>
    </div>
    <div class="row">
        <?php

        $query = mysqli_query($conn, "SELECT * FROM activity WHERE peserta_act='management'");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <div class="col-xl-3 d-flex justify-content-center my-2">
                <a data-bs-toggle="offcanvas" data-bs-target="#act_<?php echo $data['id_act'] ?>" class="btn btn-warning p-3" style="width: 90%;"><?php echo $data['nama_act']; ?></a>
            </div>
        <?php
            getDataTable("management", $data, $conn);
        }
        ?>
    </div>
</div>