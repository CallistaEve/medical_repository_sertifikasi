

<?php $__env->startSection('content'); ?>
    <h2>Tambah Barang Habis Pakai</h2>
    <form action="<?php echo e(route('item.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="kategori" value="barang_habis_pakai">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jenis Penggunaan</label>
            <input type="text" name="jenis_penggunaan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status Sterilisasi</label>
            <input type="text" name="status_sterilisasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MSI-PC\medical-inventory\resources\views/item/create-consumable.blade.php ENDPATH**/ ?>