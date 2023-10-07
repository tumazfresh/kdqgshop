<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record in Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal" data-id="212">
        Open Update Modal
    </button>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="recordId" name="id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Description</label>
                            <input type="text" class="form-control" id="product_desc" name="product_desc">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#updateModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');

                // Make an AJAX request to fetch item details using the itemId
                $.ajax({
                    url: 'fetch_item_details.php',
                    type: 'POST',
                    data: {id: itemId},
                    success: function(response){
                        var data = JSON.parse(response);
                        $('#recordId').val(data.id);
                        $('#name').val(data.name);
                        $('#product_desc').val(data.product_desc);
                    }
                });
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'update_record.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response){
                        $('#updateModal').modal('hide');
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
