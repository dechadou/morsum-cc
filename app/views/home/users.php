<div class="col-md-8">
    <h1>Users list</h1>

    <div class="table-responsive">


        <table id="mytable" class="table table-bordred table-striped">

            <thead>

            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Edit</th>
            <th>Delete</th>
            </thead>
            <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="7">User list is empty</td>
                </tr>
            <?php endif ?>

            <?php foreach ($users as $user) { ?>
                <tr data-user="<?php echo $user->getId() ?>">

                    <td><?php echo $user->getName() ?></td>
                    <td><?php echo $user->getLastName() ?></td>
                    <td><?php echo $user->getAddress() ?></td>
                    <td><?php echo $user->getEmail() ?></td>
                    <td><?php echo $user->getPhone() ?></td>
                    <td>
                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                            <button class="btn btn-primary btn-xs edit-button" data-title="Edit" data-toggle="modal"
                                    data-id="<?php echo $user->getId() ?>"
                                    data-target="#edit"><span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </p>
                    </td>
                    <td>
                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                            <button class="btn btn-danger btn-xs delete-button" data-id="<?php echo $user->getId() ?>"
                                    data-title="Delete" data-toggle="modal"
                                    data-target="#delete"><span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </p>
                    </td>
                </tr>
            <?php } ?>


            </tbody>

        </table>

        <div class="clearfix"></div>

    </div>

</div>