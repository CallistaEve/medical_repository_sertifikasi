

<?php $__env->startSection('content'); ?>
    <h2>Tambah Item Baru</h2>

    <form action="<?php echo e(route('item.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" class="form-control">
                <option value="obat">Obat</option>
                <option value="peralatan">Peralatan Medis</option>
                <option value="barang_habis_pakai">Barang Habis Pakai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Tambah Item</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MSI-PC\medical-inventory\resources\views/item/create.blade.php ENDPATH**/ ?>