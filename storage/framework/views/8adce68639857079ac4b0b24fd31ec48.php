

<?php $__env->startSection('content'); ?>
    <h2>Add New Item</h2>

    <form action="<?php echo e(route('item.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" class="form-control" onchange="updateFormBasedOnCategory(this)">
                <option value="obat">Obat</option>
                <option value="peralatan">Peralatan Medis</option>
                <option value="barang_habis_pakai">Barang Habis Pakai</option>
            </select>
        </div>

        <div id="obat_fields">
            <!-- Fields for 'obat' category -->
            <div class="form-group">
                <label for="dosis">Dosis</label>
                <input type="text" name="dosis" class="form-control">
            </div>
            <div class="form-group">
                <label for="expired_date">Expired Date</label>
                <input type="date" name="expired_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="has_prescription">Prescription Required</label>
                <select name="has_prescription" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <div id="peralatan_fields" style="display:none;">
            <!-- Fields for 'peralatan' category -->
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" class="form-control">
            </div>
            <div class="form-group">
                <label for="operational_status">Operational Status</label>
                <input type="text" name="operational_status" class="form-control">
            </div>
            <div class="form-group">
                <label for="maintenance_schedule">Maintenance Schedule</label>
                <input type="date" name="maintenance_schedule" class="form-control">
            </div>
        </div>

        <div id="barang_habis_pakai_fields" style="display:none;">
            <!-- Fields for 'barang_habis_pakai' category -->
            <div class="form-group">
                <label for="usage_type">Usage Type</label>
                <input type="text" name="usage_type" class="form-control">
            </div>
            <div class="form-group">
                <label for="sterilization_status">Sterilization Status</label>
                <input type="text" name="sterilization_status" class="form-control">
            </div>
            <div class="form-group">
                <label for="expired_date">Expired Date</label>
                <input type="date" name="expired_date" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Add Item</button>
    </form>

    <script>
        function updateFormBasedOnCategory(selectElement) {
            var category = selectElement.value;
            document.getElementById('obat_fields').style.display = category === 'obat' ? '' : 'none';
            document.getElementById('peralatan_fields').style.display = category === 'peralatan' ? '' : 'none';
            document.getElementById('barang_habis_pakai_fields').style.display = category === 'barang_habis_pakai' ? '' : 'none';
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MSI-PC\medical-inventory\resources\views/item/show.blade.php ENDPATH**/ ?>