

<?php $__env->startSection('content'); ?>
    <h2>Dashboard</h2>

    <p><strong>Logged in as:</strong> <?php echo e(ucfirst(Auth::user()->role)); ?></p>

    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    <?php
        use Carbon\Carbon;
        $today = Carbon::today();
    ?>

    
    <h3>Obat</h3>
    <?php if($obat->isEmpty()): ?>
        <p>No obat available.</p>
    <?php else: ?>
        <?php $totalObat = 0; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Dosis</th>
                    <th>Perlu Resep</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $obat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isExpired = $item->tanggal_kadaluarsa && Carbon::parse($item->tanggal_kadaluarsa)->lt($today);
                        $isLowStock = $item->jumlah <= 5;
                        $totalObat += $item->harga * $item->jumlah;
                    ?>
                    <tr <?php if($isExpired || $isLowStock): ?> class="table-danger" <?php endif; ?>>
                        <td><?php echo e($item->nama); ?></td>
                        <td><?php echo e($item->jumlah); ?></td>
                        <td>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                        <td><?php echo e(ucfirst($item->kategori)); ?></td>
                        <td><?php echo e($item->dosis); ?></td>
                        <td><?php echo e($item->butuh_resep); ?></td>
                        <td><?php echo e($item->tanggal_kadaluarsa); ?></td>
                        <td>
                            <?php if(Auth::user()->role === 'Admin' || Auth::user()->role === 'Pharmacist'): ?>
                                <a href="<?php echo e(route('item.edit', $item->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="<?php echo e(route('item.destroy', $item->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            <?php else: ?>
                                <span>Akses Ditolak</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-end fw-bold">Total Nilai Inventaris: Rp
                        <?php echo e(number_format($totalObat, 0, ',', '.')); ?></td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>

    
    <h3>Peralatan</h3>
    <?php if($peralatan->isEmpty()): ?>
        <p>No peralatan available.</p>
    <?php else: ?>
        <?php $totalPeralatan = 0; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Departemen</th>
                    <th>Status Operasional</th>
                    <th>Jadwal Pemeliharaan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $peralatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isLowStock = $item->jumlah <= 5;
                        $totalPeralatan += $item->harga * $item->jumlah;
                    ?>
                    <tr <?php if($isLowStock): ?> class="table-danger" <?php endif; ?>>
                        <td><?php echo e($item->nama); ?></td>
                        <td><?php echo e($item->jumlah); ?></td>
                        <td>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                        <td><?php echo e(ucfirst($item->kategori)); ?></td>
                        <td><?php echo e($item->departemen); ?></td>
                        <td><?php echo e($item->status_operasional); ?></td>
                        <td><?php echo e($item->jadwal_pemeliharaan); ?></td>
                        <td>
                            <?php if(Auth::user()->role === 'Admin' || Auth::user()->role === 'Technician'): ?>
                                <a href="<?php echo e(route('item.edit', $item->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="<?php echo e(route('item.destroy', $item->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            <?php else: ?>
                                <span>Akses Ditolak</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-end fw-bold">Total Nilai Inventaris: Rp
                        <?php echo e(number_format($totalPeralatan, 0, ',', '.')); ?></td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>

    
    <h3>Barang Habis Pakai</h3>
    <?php if($consumable->isEmpty()): ?>
        <p>No barang habis pakai available.</p>
    <?php else: ?>
        <?php $totalConsumable = 0; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Jenis Penggunaan</th>
                    <th>Status Sterilisasi</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $consumable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isExpired = $item->tanggal_kadaluarsa && Carbon::parse($item->tanggal_kadaluarsa)->lt($today);
                        $isLowStock = $item->jumlah <= 5;
                        $totalConsumable += $item->harga * $item->jumlah;
                    ?>
                    <tr <?php if($isExpired || $isLowStock): ?> class="table-danger" <?php endif; ?>>
                        <td><?php echo e($item->nama); ?></td>
                        <td><?php echo e($item->jumlah); ?></td>
                        <td>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                        <td><?php echo e($item->jenis_penggunaan); ?></td>
                        <td><?php echo e($item->status_sterilisasi); ?></td>
                        <td><?php echo e($item->tanggal_kadaluarsa); ?></td>
                        <td>
                            <?php if(Auth::user()->role === 'Admin'): ?>
                                <a href="<?php echo e(route('item.edit', $item->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="<?php echo e(route('item.destroy', $item->id)); ?>" method="POST"
                                    style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            <?php else: ?>
                                <span>Akses Ditolak</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" class="text-end fw-bold">Total Nilai Inventaris: Rp
                        <?php echo e(number_format($totalConsumable, 0, ',', '.')); ?></td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>

    <div class="mt-4">
        <h4>Tambah Data</h4>
        <?php if(Auth::user()->role === 'Admin'): ?>
            <a href="<?php echo e(route('item.create.obat')); ?>" class="btn btn-success">Tambah Obat</a>
            <a href="<?php echo e(route('item.create.peralatan')); ?>" class="btn btn-success">Tambah Peralatan</a>
            <a href="<?php echo e(route('item.create.consumable')); ?>" class="btn btn-success">Tambah Barang Habis Pakai</a>
        <?php elseif(Auth::user()->role === 'Technician'): ?>
            <a href="<?php echo e(route('item.create.peralatan')); ?>" class="btn btn-success">Tambah Peralatan</a>
        <?php elseif(Auth::user()->role === 'Pharmacist'): ?>
            <a href="<?php echo e(route('item.create.obat')); ?>" class="btn btn-success">Tambah Obat</a>
        <?php else: ?>
            <span>Akses Ditolak</span>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MSI-PC\medical-inventory\resources\views/dashboard.blade.php ENDPATH**/ ?>