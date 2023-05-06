<?php
date_default_timezone_set('Asia/Jakarta');
function chooseActivity($conn)
{
?>
    <div class="offcanvas offcanvas-top w-100 h-100 act" id="act">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Silahkan Pilih Kegiatan</h1>
            <button class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex w-100 justify-content-between">
                <h1>Mahasiswa</h1>
            </div>
            <div class="row">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM activity WHERE eserta_act='college_student'");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="col-xl-3 d-flex justify-content-center my-2">
                        <a href="?pagination=open_camera&type=<?php echo $data['peserta_act'] ?>&act=<?php echo $data['id_act'] ?>&nim=0" class="btn btn-warning p-3" style="width: 90%;"><?php echo $data['nama_act']; ?></a>
                    </div>
                <?php
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
                        <a href="../?pagination=open_camera&type=<?php echo $data['peserta_act'] ?>&act=<?php echo $data['id_act'] ?>&nim=0" class="btn btn-warning p-3" style="width: 90%;"><?php echo $data['nama_act']; ?></a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
function getFeedbackAct()
{
?>
    <div class="offcanvas offcanvas-bottom" id="feedbackCode" style="height: 70vh;">
        <section>
            <div class="flex-column align-items-center d-none d-sm-flex">
                <div class="bg-dark mt-3 mb-3 rounded" style="min-width: 70px; max-width: 100px; width: 10vw; height: 5px;"></div>
                <div class="d-flex container align-items-center justify-content-center">
                    <img style="min-width: 350px; width: 20vw;" src="./images/feedback_code.png" alt="feedback code">
                    <div>
                        <h1 class=" p-0 m-0">HALLO Kak</h1>
                        <h1 class="ms-1"><h2 id="nickname"></h2></h1>
                        <span class="bg-warning p-2 d-block mt-4 text-center" id="alertPresence"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center d-sm-none">
                <div class="bg-dark mt-3 mb-3 rounded" style="min-width: 70px; max-width: 100px; width: 10vw; height: 5px;"></div>
                <img style="width: 150px;" src="./images/feedback_code.png" alt="feedback code">
                <div class="d-flex container align-items-center justify-content-center">
                    <div>     
                        <h1 class=" p-0 m-0">Hallo Kak</h1>
                        <h2 id="nicknameMobile"></h2>
                        <span class="bg-success text-light p-2 d-block mt-4 text-center">Absensi Berhasil.</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
}
?>

<?php
function getPresence($conn, $typeAct, $act, $nim)
{
    $time = date('l, j F Y | h:i:s', time());
    $id_admin = $_SESSION['id_admin'];
    if ($nim != '0' && $typeAct == 'management') {
        $nickname_temp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_mgt FROM management WHERE nim_mgt=$nim"));
        $nickname = $nickname_temp['nama_mgt'];

        $checkAct_temp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `$act` FROM management_presence WHERE nim_management='$nim'"));
        $checkAct = $checkAct_temp[$act];
        if ($checkAct == '0') {
            mysqli_query($conn, "UPDATE management_presence SET `$act`='1' WHERE nim_management='$nim'");
            mysqli_query($conn, "INSERT INTO activity_time (id_admin, id_activity, id_peserta, peserta_activity, time) VALUES('$id_admin', '$act', '$nim', '$typeAct', '$time')");
            $alertPresence = "Absensi Pengurus Berhasil.";
        } else {
            $alertPresence = "Pengurus Sudah Absensi.";
        }
    }
    if ($nim != '0' && $typeAct == 'college_student') {
        $nickname_temp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_colstd FROM college_student WHERE nim_colstd=$nim"));
        $nickname = $nickname_temp['nama_colstd'];
        $checkAct_temp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `$act` FROM college_student_presence WHERE nim_college_student='$nim'"));
        $checkAct = $checkAct_temp[$act];
        if ($checkAct == '0') {
            mysqli_query($conn, "UPDATE college_student_presence SET `$act`='1' WHERE nim_college_student='$nim'");
            mysqli_query($conn, "INSERT INTO activity_time (id_admin, id_activity, id_peserta, peserta_activity, time) VALUES('$id_admin', '$act', '$nim', '$typeAct', '$time')");
            $alertPresence = "Absensi Mahasiswa Berhasil.";
        } else {
            $alertPresence = "Mahasiswa Sudah Absensi.";
        }
    }
?>
    <script>
        // remove style in body
        let body = document.getElementById('body');
        // text to speech
        function textToSpeech(text) {
            let utternance = new SpeechSynthesisUtterance(text);
            utternance.rate = 0.9;
            utternance.lang = 'id-ID';
            speechSynthesis.speak(utternance);
        }
        // feedback code
        let feedbackCode = document.getElementById('feedbackCode');
        let nickname = document.getElementById('nickname');
        let nicknameMobile = document.getElementById('nicknameMobile');
        let alertPresence = document.getElementById('alertPresence');

        alertPresence.textContent = `<?php echo ($alertPresence) ?>`;

        nickname.textContent = `<?php echo ucwords(strtolower($nickname)) ?>`;
        nicknameMobile.textContent = `<?php echo ucwords(strtolower($nickname)) ?>`;

        const voiceInscription = "Halo Kakk " + " " + `<?php echo ($nickname); ?>` + ", " + `<?php echo ($alertPresence) ?>`;

        textToSpeech(voiceInscription);

        feedbackCode.classList.add("show");
        setTimeout(() => {
            feedbackCode.classList.remove("show");
            body.removeAttribute('style');
        }, 5000);
    </script>
<?php
}
?>

<?php
function HomeDataTables($participant, $conn)
{
?>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col_12 main-datatable">
            <div class="card_body">
                <div class="d-flex justify-content-end p-3">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col_12 d-flex justify-content-end align-items-center search_input">
                        <label for="filter_box">Search: </label>
                        <input type="text" class="form-control filter-box-std filter-box-mgt" placeholder=" " />
                    </div>
                </div>
                <div class="overflow-x">
                    <?php
                    if ($participant == 'college_student') {
                    ?>
                        <table class="homeActivityStd table table-hover cust-datatable dataTable no-footer" style="width: 2000px;">
                        <?php
                    } elseif ($participant == 'management') {
                        ?>
                            <table class="homeActivityMgt table table-hover cust-datatable dataTable no-footer" style="width: 1500px;">
                            <?php
                        }
                            ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIM</th>
                                    <th>Nomor Telepone</th>
                                    <?php
                                    if ($participant == 'college_student') {
                                    ?>
                                        <th>Fakultas</th>
                                        <th>Prodi</th>
                                    <?php
                                    }
                                    ?>
                                    <th>Angkatan</th>
                                    <?php
                                    if ($participant == 'college_student') {
                                    ?>
                                        <th>Alamat</th>
                                    <?php
                                    } elseif ($participant == 'management') {
                                    ?>
                                        <th>Posisi</th>
                                        <th>jabatan</th>
                                    <?php
                                    }
                                    ?>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($participant == 'college_student') {
                                    $query = mysqli_query($conn, "SELECT * FROM college_student");
                                } elseif ($participant == 'management') {
                                    $query = mysqli_query($conn, "SELECT * FROM management");
                                }
                                $no = 0;
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $no++;
                                ?>
                                    <tr>
                                        <?php
                                        $nim = NULL;
                                        $column = array();
                                        $colAttend = array();
                                        $colNotAttend = array();
                                        $queryAct = array();
                                        $countAttend = 0;
                                        $countNotAttend = -1;
                                        if ($participant == 'college_student') {
                                        ?>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo strtoupper($data['nama_colstd']); ?></td>
                                            <td><?php echo $data['nim_colstd']; ?></td>
                                            <td><?php echo $data['no_telp_colstd']; ?></td>
                                            <td><?php echo $data['fakultas_colstd']; ?></td>
                                            <td><?php echo $data['prodi_colstd']; ?></td>
                                            <td><?php echo $data['angkatan_colstd']; ?></td>
                                            <td><?php echo $data['alamat_colstd']; ?></td>
                                            <td><?php
                                                $nim = $data['nim_colstd'];
                                                $queryFields = mysqli_query($conn, "DESC college_student_presence");
                                                for ($i = 1; $i <= $queryFields->num_rows; $i++) {
                                                    $field = mysqli_fetch_array($queryFields);
                                                    $column[$i] = $field['Field'];
                                                    $queryAct = mysqli_query($conn, "SELECT * FROM college_student_presence WHERE nim_college_student=$nim");
                                                    $dataAct = mysqli_fetch_assoc($queryAct);
                                                    if ($dataAct[$column[$i]] == '1') {
                                                        $countAttend += 1;
                                                        $colAttend[$countAttend] = $field['Field'];
                                                    } else {
                                                        $countNotAttend += 1;
                                                        $colNotAttend[$countNotAttend] = $field['Field'];
                                                    }
                                                }
                                                ?>
                                                <div class="d-flex justify-content-between">
                                                    <div class="dropdown dropdown-menu-end">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                                            <?php
                                                            echo "Hadir : " . $countAttend;
                                                            ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php
                                                            for ($i = 1; $i <= $countAttend; $i++) {
                                                                $colAttendIndex = $colAttend[$i];
                                                                $namaActAttendTemp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act=$colAttendIndex"));
                                                                $namaActAttend = $namaActAttendTemp['nama_act'];
                                                            ?>
                                                                <li><a class="dropdown-item"><?php echo $namaActAttend ?></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="dropdown dropdown-menu-end">
                                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">
                                                            <?php echo "Tidak Hadir : " . $countNotAttend ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php
                                                            for ($i = 1; $i <= $countNotAttend; $i++) {
                                                                $colNotAttendIndex = $colNotAttend[$i];
                                                                $namaActNotAttendTemp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act=$colNotAttendIndex"));
                                                                $namaActNotAttend = $namaActNotAttendTemp['nama_act'];
                                                            ?>
                                                                <li><a class="dropdown-item"><?php echo $namaActNotAttend ?></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php
                                        } elseif ($participant == 'management') {
                                        ?>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo strtoupper($data['nama_mgt']); ?></td>
                                            <td><?php echo $data['nim_mgt']; ?></td>
                                            <td><?php echo $data['no_telp_mgt']; ?></td>
                                            <td><?php echo $data['angkatan_mgt']; ?></td>
                                            <td><?php echo $data['posisi_mgt']; ?></td>
                                            <td><?php echo $data['jabatan_mgt']; ?></td>
                                            <td><?php
                                                $nim = $data['nim_mgt'];
                                                $queryFields = mysqli_query($conn, "DESC management_presence");
                                                for ($i = 1; $i <= $queryFields->num_rows; $i++) {
                                                    $field = mysqli_fetch_array($queryFields);
                                                    $column[$i] = $field['Field'];
                                                    $queryAct = mysqli_query($conn, "SELECT * FROM management_presence WHERE nim_management=$nim");
                                                    $dataAct = mysqli_fetch_assoc($queryAct);
                                                    if ($dataAct[$column[$i]] == '1') {
                                                        $countAttend += 1;
                                                        $colAttend[$countAttend] = $field['Field'];
                                                    } else {
                                                        $countNotAttend += 1;
                                                        $colNotAttend[$countNotAttend] = $field['Field'];
                                                    }
                                                }
                                                ?>
                                                <div class="d-flex" style="gap: 10px;">
                                                    <div class="dropdown dropdown-menu-end">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                                            <?php echo "Hadir : " . $countAttend ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php
                                                            for ($i = 1; $i <= $countAttend; $i++) {
                                                                $colAttendIndex = $colAttend[$i];
                                                                $namaActAttendTemp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act=$colAttendIndex"));
                                                                $namaActAttend = $namaActAttendTemp['nama_act'];
                                                            ?>
                                                                <li><a class="dropdown-item" href="#"><?php echo $namaActAttend ?></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="dropdown dropdown-menu-end">
                                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">
                                                            <?php echo "TIdak Hadir : " . $countNotAttend ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php
                                                            for ($i = 1; $i <= $countNotAttend; $i++) {
                                                                $colNotAttendIndex = $colNotAttend[$i];
                                                                $namaActNotAttendTemp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_act FROM activity WHERE id_act=$colNotAttendIndex"));
                                                                $namaActNotAttend = $namaActNotAttendTemp['nama_act'];
                                                            ?>
                                                                <li><a class="dropdown-item" href="#"><?php echo $namaActNotAttend ?></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
function getDataTable($participant, $data, $conn) {
    global $exportName;
    $exportName = $data['nama_act'];
    $id_act = $data['id_act'];
?>
    <div class="offcanvas offcanvas-top w-100 h-100" id="act_<?php echo $data['id_act'] ?>">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title"><?php echo $data['nama_act']; ?></h1>
            <button class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form class="card_body" action="functions/save_presence.php" method="POST">
                <input type="text" name="id_act" value="<?php echo $id_act ?>" hidden>
                <input type="text" name="participant" value="<?php echo $participant ?>" hidden>
                <div class="d-flex justify-content-end p-3">
                    <div class="w-100 d-flex justify-content-end align-items-center search_input">
                        <label for="filter-box-activity">Search: </label>
                        <input type="text" class="form-control filter-box-std filter-box-mgt" placeholder=" " />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning" name="updatePresence">Perbarui</button>
                    </div>
                </div>
                <div class="overflow-x">
                    <?php
                    if ($participant == 'college_student') {
                    ?>
                        <table class="activityStd table table-hover cust-datatable dataTable no-footer" style="width: 2000px;">
                        <?php
                    } elseif ($participant == 'management') {
                        ?>
                            <table class="activityMgt table table-hover cust-datatable dataTable no-footer" style="width: 1300px;">
                            <?php
                        }
                            ?>
                            <thead>
                                <?php
                                if ($participant == 'college_student') {
                                ?>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu</th>
                                        <th>Admin</th>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                        <th>No Telepone</th>
                                        <th>Prodi</th>
                                        <th>Fakultas</th>
                                        <th>Angkatan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                <?php
                                } elseif ($participant == 'management') {
                                ?>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu</th>
                                        <th>Admin</th>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </thead>
                            <tbody>
                                <?php
                                $id_act = $data['id_act'];
                                if ($participant == 'college_student') {
                                    $query = mysqli_query($conn, "SELECT college_student.nim_colstd AS nim, college_student.nama_colstd AS nama, college_student.no_telp_colstd AS telepone, college_student.prodi_colstd AS prodi,  college_student.fakultas_colstd AS fakultas, college_student.angkatan_colstd AS angkatan, college_student_presence.$id_act AS keterangan, IFNULL((SELECT time FROM activity_time WHERE id_activity = $id_act AND id_peserta = college_student.nim_colstd), 'Belum Absensi') AS time, IFNULL((SELECT id_admin FROM activity_time WHERE id_activity = $id_act AND id_peserta = college_student.nim_colstd), 'Belum Absensi') AS id_admin, IFNULL((SELECT nama FROM account WHERE id_account = id_admin), 'Belum Absensi') AS id_admin FROM college_student JOIN college_student_presence ON (college_student.nim_colstd = college_student_presence.nim_college_student);");
                                } elseif ($participant == 'management') {
                                    $query = mysqli_query($conn, "SELECT management.nim_mgt AS nim, management.nama_mgt AS nama, management.angkatan_mgt AS angkatan, management.posisi_mgt AS posisi, management_presence.$id_act AS keterangan, IFNULL((SELECT time FROM activity_time WHERE id_activity = $id_act AND id_peserta = management.nim_mgt), 'Belum Absensi') AS time, IFNULL((SELECT id_admin FROM activity_time WHERE id_activity = $id_act AND id_peserta = management.nim_mgt), 'Belum Absensi') AS id_admin, IFNULL((SELECT nama FROM account WHERE id_account = id_admin), 'Belum Absensi') AS id_admin FROM management JOIN management_presence ON (management.nim_mgt = management_presence.nim_management);");
                                }
                                $no = 0;
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $no++;
                                ?>
                                    <tr>
                                        <?php
                                        if ($participant == 'college_student') {
                                        ?>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $data['time']; ?></td>
                                            <td><?php echo $data['id_admin']; ?></td>
                                            <td><?php echo $data['nim']; ?></td>
                                            <td><?php echo ucwords(strtolower($data['nama'])) ?></td>
                                            <td><?php echo $data['telepone']; ?></td>
                                            <td><?php echo $data['prodi']; ?></td>
                                            <td><?php echo $data['fakultas']; ?></td>
                                            <td><?php echo $data['angkatan']; ?></td>
                                            <td><?php
                                                if ($data['keterangan'] == 0) {
                                                ?>
                                                    <input type="checkbox" class="form-check-input p-2" name="presence[]" value="<?php echo $data['nim']; ?>">
                                                    <label> Tidak Hadir</label>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="checkbox" class="form-check-input" name="notPresence[]" value="<?php echo $data['nim']; ?>" checked>
                                                    <label> Hadir</label>
                                                <?php
                                                } ?>
                                            </td>
                                        <?php
                                        } elseif ($participant == 'management') {
                                        ?>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $data['time']; ?></td>
                                            <td><?php echo $data['id_admin']; ?></td>
                                            <td><?php echo $data['nim']; ?></td>
                                            <td><?php echo ucwords(strtolower($data['nama'])) ?></td>
                                            <td><?php echo $data['posisi']; ?></td>
                                            <td><?php
                                                if ($data['keterangan'] == 0) {
                                                ?>
                                                    <input type="checkbox" class="form-check-input p-2" name="presence[]" value="<?php echo $data['nim']; ?>">
                                                    <label> Tidak Hadir</label>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="checkbox" class="form-check-input" name="notPresence[]" value="<?php echo $data['nim']; ?>" checked>
                                                    <label> Hadir</label>
                                                <?php
                                                } ?>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            </table>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>

<?php
function addActivity($conn)
{
?>
    <div class="modal" id="add_activity">

        <div class="modal-dialog">

            <div class="modal-content">

                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">Add Activity</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <!-- Modal body -->

                <div class="modal-body">

                    <form method="POST" action="">

                        <div class="mt-3">

                            <div class="inputBox">

                                <input type="text" name="activityName" required="required" />

                                <span class="user">Activity Name</span>

                            </div>

                        </div>

                        <div class="mt-4">

                            <div class="inputBox">

                                <input type="text" name="activityPlace" required="required" />

                                <span class="user">Activity Place</span>

                            </div>

                        </div>

                        <div class="mt-4">

                            <label for="activityDate" class="h5">Activity Date:</label>

                            <input type="Date" class="form-control" id="activityDate" placeholder="Enter Activity Date" name="activityDate">

                        </div>

                        <div class="mt-4">

                            <label for="activityStatus" class="h5">Activity Status:</label>

                            <select name="activityStatus" class="form-select" id="activityStatus">

                                <option value="management">Pengurus</option>

                                <option value="college_student">Mahasiswa</option>

                            </select>

                        </div>

                        <div class="py-2 mt-5 d-flex justify-content-end border-top">

                            <button type="submit" class="btn btn-primary me-2" name="btn_add_activity">Add</button>

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
    <?php
    if (isset($_POST['btn_add_activity'])) {

        $activity_name = $_POST['activityName'];

        $activity_date = $_POST['activityDate'];

        $activity_place = $_POST['activityPlace'];

        $activity_status = $_POST['activityStatus'];



        if ($activity_status == "management") {

            mysqli_query($conn, "INSERT INTO activity VALUES (NULL, '$activity_name', '$activity_date', '$activity_place', '$activity_status', '1')");

            $act_mgt_temp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_act FROM activity WHERE peserta_act = 'management' ORDER BY id_act DESC LIMIT 1"));

            $act_mgt = strval($act_mgt_temp['id_act']);

            mysqli_query($conn, "ALTER TABLE management_presence ADD `$act_mgt` ENUM('1','0') NOT NULL DEFAULT '0'");

        } elseif ($activity_status == "college_student") {

            mysqli_query($conn, "INSERT INTO activity VALUES (NULL, '$activity_name', '$activity_date', '$activity_place', '$activity_status', '1')");

            $act_coll_std_temp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_act FROM activity WHERE peserta_act = 'college_student' ORDER BY id_act DESC LIMIT 1"));

            $act_coll_std = strval($act_coll_std_temp['id_act']);

            mysqli_query($conn, "ALTER TABLE college_student_presence ADD `$act_coll_std` ENUM('1','0') NOT NULL DEFAULT '0'");

        }

    ?>
        <script>

            window.location.replace("https://fortoring.000webhostapp.com/?pagination=code_reader");

        </script>
<?php
    }
}
?>
<?php
function showProfile($conn) {
    $id_account = $_SESSION['id_admin'];
    $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM account WHERE id_account=$id_account"));
    ?>
    <div class="modal" id="show_profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo(strtoupper($name['nama']));?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>