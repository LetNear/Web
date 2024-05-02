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


        <?= form_open("user/edit/" . $user_info->userID); ?>
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <input type="hidden" class="form-control form-control-user" id="UID" name="UID"
                    value="<?= $user_info->userID ?>" placeholder="User ID" readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UN" name="UN"
                    value="<?= $user_info->name ?>" placeholder="User Name" required>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UFN" name="UFN"
                    value="<?= $user_info->fullName ?>" placeholder="User Full Name"required>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-user" id="UE" name="UE"
                    value="<?= $user_info->email ?>" placeholder="User Email"required>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-User" id="UP" name="UP"
                    value="<?= $user_info->password ?>" placeholder="User Password"required>
            </div>
        </div>
       


        <button class="btn btn-warning btn-block">
            <i class="fas fa-pen"></i> Edit User
        </button>
        </form>


    </div>
</div>