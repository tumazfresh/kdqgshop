<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader4.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>SALES REPORT</h4>
                </div>
                <div class="card-body">
                    <table id="messageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>pageID</th>
                                <th>annoucementID</th>
                                <th>adsID</th>
                                <th>header</th>
                                <th>image</th>
                                <th>text</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>pageID</td>
                                <td>annoucementID</td>
                                <td>adsID</td>
                                <td>header</td>
                                <td>image</td>
                                <td>text</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="viewMessageBtn btn btn-info btn-sm" data-id=""><i class="fas fa-eye"></i> VIEW</button>
                                        <!-- added code --> 
                                        <button type="button" value="" class="updatedMessageBtn btn btn-danger btn-sm" style ="background-color: orange; hover: -1;" ><i class="fas fa-trash-alt"></i> UPDATED</button>
                                        <!-- added code --> 
                                        <button type="button" value="" class="deleteMessageBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
