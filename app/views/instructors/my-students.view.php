<?php $this->view('instructors/instructor-header', $data) ?>

<style>
    .tabs-holder {
        display: flex;
        margin-top: 10px;
        margin-bottom: 10px;
        justify-content: center;
        text-align: center;
        flex-wrap: wrap;
    }

    .my-tab {
        flex: 1;
        border-bottom: solid 2px #ccc;
        padding-top: 10px;
        padding-bottom: 10px;
        cursor: pointer;
        user-select: none;
        min-width: 150px;

    }

    .my-tab:hover {
        color: #4154f1;
    }

    .active-tab {
        color: #4154f1;
        border-bottom: solid 2px #4154f1;
    }

    .hide {
        display: none;
    }

    .loader {
        position: relative;
        width: 200px;
        height: 200px;
        left: 50%;
        top: 50%;
        transform: translateX(-50%);
        opacity: 0.5;
    }
</style>


    <div class="card">
    
        <div class="card-body">
            <h5 class="card-title">
                My students
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">image</th>
                        <th scope="col">email</th>
                        <th scope="col">Enrolled In</th>
                        <th scope="col">Join Date</th>
                    </tr>
                </thead>

                <?php if (!empty($rows)) : ?>
                    <tbody>

                        <?php
                        $count = 0;
                        foreach ($rows as $row) : ?>
                            <tr>
                                <th scope="row"><?= ++$count ?></th>
                                <td><?= esc($row->instructor_std->name)?? 'Unknown' ?></td>
                                <td><img src="<?= get_image($row->instructor_std->image) ?>" style="width: 100px;height: 100px;object-fit: cover;" /></td>
                                <td><?= esc($row->instructor_std->email ?? 'Unknown') ?></td>
                                <td><?= esc($row->course_enrolled->title ?? 'Unknown') ?></td>
                                <td><?= get_date($row->course_enrolled->date ?? 'Unknown') ?></td>
                                
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                <?php else : ?>
                    <tr>
                        <td colspan="10">No records found!</td>
                    </tr>
                <?php endif; ?>

            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>



<?php $this->view('instructors/instructor-footer', $data) ?>