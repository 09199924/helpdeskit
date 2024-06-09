<div class="container bg-white rounded-20 p-4">
    <h3>New Request</h3>
    <form action="<?= base_url('request/sendrequest'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nama Pelapor</label>
            <input type="text" name="nama" class="form-control" readonly value="<?= $user['nama']?>" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Judul Laporan</label>
            <input type="text" name="judul" class="form-control" id="exampleFormControlInput1" placeholder="Judul Laporan..">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Departemen</label>
            <input type="text" name="departemen" class="form-control" id="exampleFormControlInput1" placeholder="Departemen..">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Sub Kategori</label>
            <select name="sub" class="form-control" id="exampleFormControlSelect1">
                <option>Laptop</option>
                <option>Printer</option>
                <option>PC</option>
                <option>Handphone</option>
                <option>Software</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Tingkat Urgency</label>
            <select name="tingkat" class="form-control" id="exampleFormControlSelect2">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">No. Ext / No. Handphone</label>
            <input name="nomor" type="number" class="form-control" id="exampleFormControlInput2" placeholder="No Ext...">
        </div>
        <div class="form-group">
            <label for="validatedInputGroupCustomFile">Upload Gambar</label>
            <div class="input-group is-invalid">
                <div class="custom-file">
                    <input name="gambar" type="file" class="custom-file-input" id="validatedInputGroupCustomFile" required>
                    <label class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-outline-primary btn-sm-primary">Send Request</button>
    </form>
</div>
