

<?php $__env->startSection('content'); ?>
    <h2>Edit Item</h2>

    <form action="<?php echo e(route('item.update', $item->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo e($item->nama); ?>" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?php echo e($item->jumlah); ?>" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?php echo e($item->harga); ?>" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" disabled>
                <option value="obat" <?php echo e($item->kategori == 'obat' ? 'selected' : ''); ?>>Obat</option>
                <option value="peralatan" <?php echo e($item->kategori == 'peralatan' ? 'selected' : ''); ?>>Peralatan Medis</option>
                <option value="barang_habis_pakai" <?php echo e($item->kategori == 'barang_habis_pakai' ? 'selected' : ''); ?>>Barang Habis Pakai</option>
            </select>
            <input type="hidden" name="kategori" value="<?php echo e($item->kategori); ?>">
        </div>

        <?php if($item->kategori === 'obat'): ?>
            <div class="form-group">
                <label for="dosis">Dosis</label>
                <input type="text" name="dosis" class="form-control" value="<?php echo e($item->extra['dosis'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" class="form-control" value="<?php echo e($item->extra['tanggal_kadaluarsa'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="butuh_resep">Butuh Resep</label>
                <select name="butuh_resep" class="form-control">
                    <option value="1" <?php echo e(isset($item->extra['butuh_resep']) && $item->extra['butuh_resep'] ? 'selected' : ''); ?>>Iya</option>
                    <option value="0" <?php echo e(isset($item->extra['butuh_resep']) && !$item->extra['butuh_resep'] ? 'selected' : ''); ?>>Tidak</option>
                </select>
            </div>
        <?php elseif($item->kategori === 'peralatan'): ?>
            <div class="form-group">
                <label for="departemen">Departemen</label>
                <input type="text" name="departemen" class="form-control" value="<?php echo e($item->extra['departemen'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="status_operasional">Status Operasional</label>
                <input type="text" name="status_operasional" class="form-control" value="<?php echo e($item->extra['status_operasional'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="jadwal_pemeliharaan">Jadwal Pemeliharaan</label>
                <input type="date" name="jadwal_pemeliharaan" class="form-control" value="<?php echo e($item->extra['jadwal_pemeliharaan'] ?? ''); ?>">
            </div>
        <?php elseif($item->kategori === 'barang_habis_pakai'): ?>
            <div class="form-group">
                <label for="jenis_penggunaan">Jenis Penggunaan</label>
                <input type="text" name="jenis_penggunaan" class="form-control" value="<?php echo e($item->extra['jenis_penggunaan'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="status_sterilisasi">Status Sterilisasi</label>
                <input type="text" name="status_sterilisasi" class="form-control" value="<?php echo e($item->extra['status_sterilisasi'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" class="form-control" value="<?php echo e($item->extra['tanggal_kadaluarsa'] ?? ''); ?>">
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Perbarui Item</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MSI-PC\medical-inventory\resources\views/item/edit.blade.php ENDPATH**/ ?>