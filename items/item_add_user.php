<div class="container mt-5">
    <div class="w-100 card">
        <button  type="button" class="title-signup " data-bs-toggle="collapse" data-bs-target="#administrator" aria-expanded="false" aria-controls="administrator">
            <h5>Administrator</h5>
        </button>
        <form action="./functions/save_user.php" method="POST" class="collapse multi-collapse" id="administrator">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="name" required="required" />
                    <span class="user">Nama</span>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="username" required="required" />
                    <span class="user">Username</span>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="password" required="required" />
                    <span class="user">Password</span>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <button class="add-signup" name="admBtn" >ADD</button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-100 card" style="margin-top: 80px;">
        <button  type="button" class="title-signup" data-bs-toggle="collapse" data-bs-target="#college-student" aria-expanded="false" aria-controls="college-student">
            <h5>College Student</h5>
        </button>
        <form action="./functions/save_user.php" method="POST" class="collapse multi-collapse" id="college-student">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="nim" required="required" />
                    <span class="user">NIM</span>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="name" required="required" />
                    <span class="user">Nama Lengkap</span>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="no_telepone" required="required" />
                    <span class="user">Nomor Telepone</span>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="email" name="email" required="required" />
                    <span class="user">Email</span>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 mt-4">
                    <label class="h5">Prodi</label>
                    <select class="form-select" name="prodi">
                        <option>S1 Ilmu Keperawatan</option>
                        <option>D3 Ilmu Keperawatan</option>
                        <option>S1 Tarbiyah</option>
                        <option>S1 Syariah</option>
                        <option>S1 Psikologi</option>
                        <option>S1 Ilmu Komunikasi</option>
                        <option>S1 Sastra Inggris</option>
                        <option>S1 Pendidikan Bahasa inggris</option>
                        <option>S1 Pendidikan Bahasa dan Sastra Indonesia</option>
                        <option>S1 Pendidikan Matematika</option>
                        <option>S1 Pendidikan Guru Sekolah Dasar</option>
                        <option>S1 Manajemen</option>
                        <option>S1 Akuntansi</option>
                        <option>D3 Akuntansi</option>
                        <option>S1 Ilmu Hukum</option>
                        <option>S1 Teknik Sipil</option>
                        <option>S1 Teknik Planologi</option>
                        <option>S1 Teknik Industri</option>
                        <option>S1 Teknik Elektro</option>
                        <option>S1 Teknik Informatika</option>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 mt-4">
                    <label class="h5">Fakultas</label>
                    <select class="form-select" name="fakultas">
                        <option>Fakultas Ilmu Keperawatan</option>
                        <option>Fakultas Agama Islam</option>
                        <option>Fakultas Psikologi</option>
                        <option>Fakulas Bahasa dan Ilmu Komunikasi</option>
                        <option>Fakultas Keguruan dan Ilmu Pendidikan</option>
                        <option>Fakultas Ekonomi</option>
                        <option>Fakultas Hukum</option>
                        <option>Fakultas Teknik</option>
                        <option>Fakultas Teknologi Industri</option>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 mt-4">
                    <label class="h5">Angkatan</label>
                    <select class="form-select" name="angkatan">
                        <option>2020</option>
                        <option>2021</option>
                        <option>2022</option>
                        <option>2023</option>
                    </select>
                </div>
                <div class="d-flex flex-column col-xl-10 col-lg-10 col-md-10 col-sm-10 col-11 mt-3">
                    <label class="h5">Alamat</label>
                    <textarea class="form-control" name="alamat"></textarea>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <button class="add-signup" name="collStdBtn">ADD</button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-100 card" style="margin-top: 80px;">
        <button  type="button" class="title-signup " data-bs-toggle="collapse" data-bs-target="#management" aria-expanded="false" aria-controls="management">
            <h5>management</h5>
        </button>
        <form action="./functions/save_user.php" method="POST" class="collapse multi-collapse" id="management">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="nim" required="required" />
                    <span class="user">NIM</span>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="name" required="required" />
                    <span class="user">Nama Lengkap</span>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-10 col-sm-10 col-11 inputBox mt-5">
                    <input type="text" name="no_telepone" required="required" />
                    <span class="user">Nomer Telepone</span>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-10 col-sm-10 col-11 mt-4">
                    <label class="h5">Angkatan</label>
                    <select class="form-select" name="angkatan">
                        <option>2022/2023</option>
                        <option>2023/2024</option>
                    </select>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-10 col-sm-10 col-11 mt-4">
                    <label class="h5">Posisi</label>
                    <select class="form-select" name="posisi">
                        <option>Ketua Umum</option>
                        <option>Wakil Ketua Umum</option>
                        <option>Sekretaris 1</option>
                        <option>Sekretaris 2</option>
                        <option>Bendahara 1</option>
                        <option>Bendahara 2</option>
                        <option>Koordinator Advokesma</option>
                        <option>Anggota Advokesma</option>
                        <option>Koordinator Medkom</option>
                        <option>Anggota Medkom</option>
                        <option>Koordinator Kewirausahaan</option>
                        <option>Anggota Kewirausahaan</option>
                        <option>Koordinator PSDMO</option>
                        <option>Anggota PSDMO</option>
                        <option>Koordinator Humas</option>
                        <option>Anggota Humas</option>
                        <option>Koordinator Komdis</option>
                        <option>Anggota Komdis</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <button class="add-signup" name="mgtBtn" >ADD</button>
                </div>
            </div>
        </form>
    </div>
</div>