<div class="container p-0 pt-4 d-flex flex-column align-items-center">
    <div class="w-100 row d-flex justify-content-between">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="mb-3">
                <h1 class="text-center">Kegiatan Mahasiswa</h1>
            </div>
            <?php
            global $nameActCollStd;
            $column_coll_std = array();
            $query_fields_coll_std = mysqli_query($conn, "DESC college_student_presence");
            ?>
            <form action="" method="POST">
                <div class="row d-flex justify-content-center" style="gap: 5px;">
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 col-5">
                        <select class="form-select" name="act_coll_std">
                            <option value="NULL">Pilih Kegiatan</option>
                            <?php
                            for ($i = 1; $i <= $query_fields_coll_std->num_rows; $i++) {
                                $field = mysqli_fetch_array($query_fields_coll_std);
                                $column_coll_std[$i] = $field['Field'];
                                if ($column_coll_std[$i] != 'nim_college_student') {
                                    $nameAct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act = $column_coll_std[$i]"));
                            ?>
                                    <option value="<?php echo ($column_coll_std[$i]) ?>"><?php echo $nameAct['nama_act']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 col-5">
                        <select class="form-select col-xl-6" name="filter_coll_std">
                            <option value="NULL">Pilih Filter</option>
                            <option value="prodi_colstd">Program Studi</option>
                            <option value="fakultas_colstd">Fakultas</option>
                            <option value="angkatan_colstd">Angkatan</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 col-5">
                        <select class="form-select" name="inf_coll_std">
                            <option value="NULL">Pilih Keterangan</option>
                            <option value="1">Hadir</option>
                            <option value="0">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-5 col-md-5 col-sm-5 col-5">
                        <button name="btn_filter_coll_std" class="btn btn-light border-dark w-100">Filter</button>
                    </div>
                </div>
            </form>
            <?php

            global $labels_coll_std;
            global $datas_coll_std;

            $labels_temp_coll_std = ['Diagram Data'];
            $datas_temp_coll_std = [1];

            $labels_coll_std = json_encode($labels_temp_coll_std);
            $datas_coll_std = json_encode($datas_temp_coll_std);
            if (isset($_POST['btn_filter_coll_std'])) {
                $activity_coll_std = $_POST['act_coll_std'];
                $filter_coll_std = $_POST['filter_coll_std'];
                $information_coll_std = $_POST['inf_coll_std'];

                if ($activity_coll_std != "NULL" && $filter_coll_std == "NULL" && $information_coll_std == "NULL") {
                    $nameAct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act = $activity_coll_std"));
                    $presence_coll_std = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`$activity_coll_std`) AS presence FROM college_student_presence WHERE `$activity_coll_std`='1';"));
                    $notPresence_coll_std = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`$activity_coll_std`) AS not_presence FROM college_student_presence WHERE `$activity_coll_std`='0';"));
                    $presence_coll_std_tmp = $presence_coll_std['presence'];  
                    $notPresence_coll_std_tmp = $notPresence_coll_std['not_presence'];  

                    $nameActCollStd = $nameAct['nama_act'];
                    $labels_temp_coll_std = ['Hadir', 'Tidak Hadir'];
                    $datas_temp_coll_std = [$presence_coll_std_tmp, $notPresence_coll_std_tmp];
                } elseif ($activity_coll_std != "NULL" && $filter_coll_std != "NULL" && $information_coll_std != "NULL") {
                    $nameAct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act = $activity_coll_std"));
                    $query_filters_coll_std = mysqli_query($conn, "SELECT college_student.$filter_coll_std, COUNT(college_student_presence.$activity_coll_std) AS amount FROM college_student JOIN college_student_presence ON (college_student_presence.nim_college_student = college_student.nim_colstd) WHERE college_student_presence.$activity_coll_std = '$information_coll_std' GROUP BY college_student.$filter_coll_std;");
                    $filter_temp_coll_std = [];
                    $value_temp_coll_std = [];
                    while ($query_filter_coll_std =  mysqli_fetch_assoc($query_filters_coll_std)) {
                        $filter_temp_coll_std[] = $query_filter_coll_std[$filter_coll_std];
                        $value_temp_coll_std[] = $query_filter_coll_std['amount'];
                    }
                    if ($filter_temp_coll_std == [] && $value_temp_coll_std == []) {
                        $filter_temp_coll_std = ["Data Kosong"];
                        $value_temp_coll_std = [1];
                    }
                    $nameActCollStd = $nameAct['nama_act'];
                    $labels_temp_coll_std = $filter_temp_coll_std;
                    $datas_temp_coll_std = $value_temp_coll_std;
                } elseif ($activity_coll_std == "NULL" && $filter_coll_std != "NULL" && $information_coll_std = "NULL") {
                    $labels_temp_coll_std = ['Filter Salah'];
                    $datas_temp_coll_std = [1];
                } elseif ($activity_coll_std == "NULL" && $filter_coll_std == "NULL" && $information_coll_std != "NULL") {
                    $labels_temp_coll_std = ['Filter Salah'];
                    $datas_temp_coll_std = [1];
                } elseif ($activity_coll_std != "NULL" && $filter_coll_std != "NULL" && $information_coll_std == "NULL") {
                    $labels_temp_coll_std = ['Filter Salah'];
                    $datas_temp_coll_std = [1];
                } elseif ($activity_coll_std != "NULL" && $filter_coll_std == "NULL" && $information_coll_std != "NULL") {
                    $labels_temp_coll_std = ['Filter Salah'];
                    $datas_temp_coll_std = [1];                    
                }

                $labels_coll_std = json_encode($labels_temp_coll_std);
                $datas_coll_std = json_encode($datas_temp_coll_std);
            }
            ?>
            <div class="mt-2 ms-3 text-center"><span class="fw-bold" id="title_diagram_coll_std"></span></div>
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12">
                <canvas id="diagram_coll_std"></canvas>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 d-flex flex-column align-items-center">
            <div class="mb-3">
                <h1 class="text-center">Kegiatan Pengurus</h1>
            </div>
            <?php
            global $nameActMgt;
            $column_mgt = array();
            $query_fields_mgt = mysqli_query($conn, "DESC management_presence");
            ?>
            <form action="" method="POST" class="d-flex justify-content-between">
                <div class="row d-flex justify-content-center" style="gap: 5px;">
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 col-5">
                        <select class="form-select" name="act_mgt">
                            <option value="NULL">Pilih Kegiatan</option>
                            <?php
                            for ($i = 1; $i <= $query_fields_mgt->num_rows; $i++) {
                                $field = mysqli_fetch_array($query_fields_mgt);
                                $column_mgt[$i] = $field['Field'];
                                if ($column_mgt[$i] != 'nim_management') {
                                    $nameAct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act = $column_mgt[$i]"));
                            ?>
                                    <option value="<?php echo ($column_mgt[$i]) ?>"><?php echo $nameAct['nama_act']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 col-5">
                        <select class="form-select" name="filter_mgt">
                            <option value="NULL">Pilih Filter</option>
                            <option value="posisi_mgt">Posisi Jabatan</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 col-5">
                        <select class="form-select" name="inf_mgt">
                            <option value="NULL">Pilih Keterangan</option>
                            <option value="1">Hadir</option>
                            <option value="0">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-5 col-md-5 col-sm-5 col-5">
                        <button name="btn_filter_mgt" class="btn btn-light border-dark w-100">Filter</button>
                    </div>
                </div>
            </form>
            <?php
            global $labels_mgt;
            global $datas_mgt;

            $labels_temp_mgt = ['Diagram Data'];
            $datas_temp_mgt = [1];

            $labels_mgt = json_encode($labels_temp_mgt);
            $datas_mgt = json_encode($datas_temp_mgt);

            if (isset($_POST['btn_filter_mgt'])) {
                $activity_mgt = $_POST['act_mgt'];
                $filter_mgt = $_POST['filter_mgt'];
                $information_mgt = $_POST['inf_mgt'];
                if ($activity_mgt != "NULL" && $filter_mgt == "NULL" && $information_mgt == "NULL") {
                    $nameAct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act = $activity_mgt"));
                    $presence_mgt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`$activity_mgt`) AS presence FROM management_presence WHERE `$activity_mgt`='1';"));
                    $notPresence_mgt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(`$activity_mgt`) AS not_presence FROM management_presence WHERE `$activity_mgt`='0';"));

                    $nameActMgt = $nameAct['nama_act'];
                    $presence_mgt_tmp = $presence_mgt['presence'];
                    $notPresence_mgt_tmp = $notPresence_mgt['not_presence'];
                    
                    $labels_temp_mgt = ['Hadir', 'Tidak Hadir'];
                    $datas_temp_mgt = [$presence_mgt_tmp, $notPresence_mgt_tmp];
                } elseif ($activity_mgt != "NULL" && $filter_mgt != "NULL" && $information_mgt != "NULL") {
                    $nameAct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act = $activity_mgt"));
                    $query_filters_mgt = mysqli_query($conn, "SELECT management.$filter_mgt, COUNT(management_presence.$activity_mgt) AS amount FROM management JOIN management_presence ON (management_presence.nim_management = management.nim_mgt) WHERE management_presence.$activity_mgt = '$information_mgt' GROUP BY management.$filter_mgt;");
                    $filter_temp_mgt = [];
                    $value_temp_mgt = [];
                    while ($query_filter_mgt =  mysqli_fetch_assoc($query_filters_mgt)) {
                        $filter_temp_mgt[] = $query_filter_mgt[$filter_mgt];
                        $value_temp_mgt[] = $query_filter_mgt['amount'];
                    }
                    if ($filter_temp_mgt == [] && $value_temp_mgt == []) {
                        $filter_temp_mgt = ["Data Kosong"];
                        $value_temp_mgt = [1];
                    }
                    $nameActMgt = $nameAct['nama_act'];
                    $labels_temp_mgt = $filter_temp_mgt;
                    $datas_temp_mgt = $value_temp_mgt;
                } elseif ($activity_mgt == "NULL" && $filter_mgt != "NULL" && $information_mgt = "NULL") {
                    $labels_temp_mgt = ['Filter Salah'];
                    $datas_temp_mgt = [1];
                } elseif ($activity_mgt == "NULL" && $filter_mgt == "NULL" && $information_mgt != "NULL") {
                    $labels_temp_mgt = ['Filter Salah'];
                    $datas_temp_mgt = [1];
                } elseif ($activity_mgt != "NULL" && $filter_mgt != "NULL" && $information_mgt == "NULL") {
                    $labels_temp_mgt = ['Filter Salah'];
                    $datas_temp_mgt = [1];
                } elseif ($activity_mgt != "NULL" && $filter_mgt == "NULL" && $information_mgt != "NULL") {
                    $labels_temp_mgt = ['Filter Salah'];
                    $datas_temp_mgt = [1];
                }

                $labels_mgt = json_encode($labels_temp_mgt);
                $datas_mgt = json_encode($datas_temp_mgt);
            }
            ?>
            <div class="mt-2 ms-3 text-center"><span class="fw-bold" id="title_diagram_mgt"></span></div>
            <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12">
                <canvas id="diagram_management"></canvas>
            </div>
        </div>
    </div>
    <div class="mb-2 w-100 border-top p-3">
        <h1 class="text-center">TABEL KEGIATAN</h1>
    </div>
    <div class="container d-flex justify-content-between px-4">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5 d-flex justify-content-center">
            <a href="../?pagination=home&table=mahasiswa" class="btn btn-warning d-flex justify-content-center align-items-center p-3" style="font-size: 1.7vw;"><i class="fas fa-5x fa-user-graduate"></i>
                <h2>Mahasiswa</h2>
            </a>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5 d-flex justify-content-center">
            <a href="../?pagination=home&table=pengurus" class="btn btn-warning d-flex justify-content-center align-items-center p-3" style="font-size: 1.7vw;"><i class="fas fa-5x fa-user-cog"></i>
                <h2>Pengurus</h2>
            </a>
        </div>
    </div>
    <div class="mt-5">
        <div class="mt-4">
            <?php
            if (isset($_GET['pagination'], $_GET['table'])) {
                $pagination = $_GET['pagination'];
                $table = $_GET['table'];
                if ($pagination == 'home') {
                    switch ($table) {
                        case 'mahasiswa':
                            HomeDataTables('college_student', $conn);
                            break;
                        case 'pengurus':
                            HomeDataTables('management', $conn);
                            break;
                    }
                }
            }
            ?>
        </div>
    </div>
</div>