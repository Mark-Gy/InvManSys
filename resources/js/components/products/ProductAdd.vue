<template>
    <div class="card card-primary card-outline">
        <div class="card-body">
        <h5 class="card-title">Create a Product</h5><br><br>

        <!-- form start -->
        <form role="form" action=" " method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>Submit</button>
            </div>
        </form>

        </div>
    </div><!-- /.card -->
</template>

<script>
    export default {
        
    }
</script>