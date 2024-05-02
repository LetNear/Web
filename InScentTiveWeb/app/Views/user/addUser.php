
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("User"); ?>" class="btn btn-warning btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Return</span>
        </a>

        <?php
        if (isset($validation)) {
            echo '
                    <div class="alert alert-danger" role="alert">
                    <ul>  
                ';
            foreach ($validation as $validation) {
                echo "<li>" . esc($validation) . "</li>";
            }
            echo '
                        </ul>
                    </div>
                ';
        }
        ?>


        <?= form_open("user/create"); ?>
        <div class="form-group row">
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UN" name="UN" value=""
                    placeholder="User Name">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UFN" name="UFN" value=""
                    placeholder="User Full Name">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UE" name="UE" value=""
                    placeholder="User Email">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UP" name="UP" value=""
                    placeholder="User Password">
            </div>
        </div>
       


        <button class="btn btn-primary btn-block">
            <i class="fas fa-plus"></i> Add User
        </button>
        </form>


    </div>
</div>