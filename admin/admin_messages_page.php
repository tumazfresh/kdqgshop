<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader5.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php');
?>

<!-- View Message Modal -->
<div class="modal fade" id="messageViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VIEW MESSAGE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>User ID: </strong><span id="view_id"></span></p>
                <p><strong>Name: </strong><span id="view_name"></span></p>
                <p><strong>Email: </strong><span id="view_email"></span></p>
                <p><strong>Phone Number: </strong><span id="view_phone_number"></span></p>
                <p><strong>Message: </strong><span id="view_message"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Message Modal -->
<div class="modal fade" id="messageDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE MESSAGE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this message?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDelete">DELETE</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </div>
</div>

<!-- Table for Messages -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>CONTACT MESSAGES</h4>
                </div>
                <div class="card-body">
                    <table id="messageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
require '../dbcon.php';

$query = "SELECT * FROM tb_messages"; // Updated table name
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $message)
    {
        ?>
        <tr>
            <td><?= $message['id'] ?></td>
            <td><?= $message['name'] ?></td>
            <td><?= $message['email'] ?></td>
            <td><?= $message['phone_number'] ?></td>
            <td><?= $message['message'] ?></td>
            <td class="text-center">
         <div class="btn-group" role="group">
        <button type="button" class="viewMessageBtn btn btn-info btn-sm" data-id="<?= $message['id']; ?>"><i class="fas fa-eye"></i> VIEW</button>
        <button type="button" value="<?= $message['id']; ?>" class="deleteMessageBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
    </div>
</td>

            </td>
        </tr>
        <?php
    }
}
?>

</tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
$(document).on('click', '.viewMessageBtn', function () {
    var id = $(this).data('id');
    console.log("View button clicked. ID: " + id);

    $.ajax({
        type: "GET",
        url: "manager_messages_code.php?id=" + id,
        success: function (response) {
            try {
                var res = jQuery.parseJSON(response);
                console.log("Parsed response object:", res); 
                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $('#view_id').text(res.data.id); 
                    $('#view_name').text(res.data.name);
                    $('#view_email').text(res.data.email);
                    $('#view_phone_number').text(res.data.phone_number);
                    $('#view_message').text(res.data.message);
                    $('#messageViewModal').modal('show'); // Show the modal
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
});




$(document).on('click', '.deleteMessageBtn', function (e) {
    e.preventDefault();
    var deleteBtn = $(this); 

    if (confirm('Are you sure you want to delete this data?')) {
        var id = deleteBtn.val();
        $.ajax({
            type: "POST",
            url: "manager_messages_code.php",
            data: {
                'delete_message': true,
                'id': id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 500) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(res.message);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);
                    // Disable the delete button temporarily to prevent multiple clicks
                    deleteBtn.prop('disabled', true);
                    
                    // Autoload function
                    $('#messageTable').load(location.href + " #messageTable", function () {
                        // Re-enable the delete button after the content is reloaded
                        deleteBtn.prop('disabled', false);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('An error occurred while deleting the message.');
            }
        });
    }
});




</script>

</body>
</html>


