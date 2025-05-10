

<?php $__env->startSection('content'); ?>
    <h2>Tambah Peralatan</h2>
    <form action="<?php echo e(route('item.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="kategori" value="peralatan">

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
            <label>Departemen</label>
            <input type="text" name="departemen" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status Operasional</label>
            <input type="text" name="status_operasional" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jadwal Pemeliharaan</label>
            <input type="date" name="jadwal_pemeliharaan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MSI-PC\medical-inventory\resources\views/item/create-peralatan.blade.php ENDPATH**/ ?>