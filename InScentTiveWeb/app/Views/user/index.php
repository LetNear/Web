<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">USER TABLE</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url("user/create"); ?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add User</span>
        </a>


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>USER ID</th>
                        <th>USER NAME</th>
                        <th>USER FULL NAME</th>
                        <th>USER EMAIL</th>
                        <th>USER PASSWORD</th>
                        <th>FUNCTIONS</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>USER ID</th>
                        <th>USER NAME</th>
                        <th>USER FULL NAME</th>
                        <th>USER EMAIL</th>
                        <th>USER PASSWORD</th>
                        <th>FUNCTIONS</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($user_info as $user) {
                        echo "<tr>";
                        echo "<td>" . $user->userID . "</td>";
                        echo "<td>" . $user->name . "</td>";
                        echo "<td>" . $user->fullName . "</td>";
                        echo "<td>" . $user->email . "</td>";                       
                        echo "<td>" . $user->password . "</td>";
                        echo "
                            <td>
                            <a class='btn btn-warning btn-block' href='" . base_url() . "user/edit/" .
                            $user->userID . "'>
                            <i class='fas fa-pen'></i> Edit
                            </a>
                            <a class='btn btn-danger btn-block' href='" . base_url() . "user/delete/" .
                            $user->userID . "'>
                            <i class='fas fa-pen'></i> Delete
                            </a>
                            </td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>