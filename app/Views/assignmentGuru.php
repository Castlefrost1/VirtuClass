                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Assignment History</h1>
                    <!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#uploadModal">
                                    <i class="fas fa-download fa-sm text-white-50"></i> 
                                    Upload Assignment
                                </a>
                            </div>
                            <div class="col-xl-13">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th>Deadline</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th>Deadline</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $x = 0;
                                                foreach ($data->getResult() as $row) { 
                                            ?>
                                                <tr>
                                                    <td><?php echo $row->namaKelas?></td>
                                                    <td><?php echo $row->namaMatkul?></td>
                                                    <td><?php echo $row->deadline?></td>
                                                    <td>
                                                        <form id="<?php echo "f" . $x?>" method="POST" action="<?php echo base_url();?>/home/download">
                                                            <input type='hidden' name="Path" value ="<?php echo $row->pathSoal?>">
                                                        </form>
                                                        <i class="download fas fa-file-download fa-fw" value="<?php echo $x?>"></i>
                                                        <i name="uploadList" class="uploadList fas fa-edit fa-fw" data-toggle="modal" data-target="#listModal" value="<?php echo $row->assignmentID?>"></i>
                                                    </td>
                                                </tr>
                                            <?php $x += 1; }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>


<!-- Upload Modal-->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan File Yang Inging Anda Upload</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error"></div>
                <form method="POST" action="<?php echo base_url();?>/home/upload" id="form" enctype="multipart/form-data">
                    Kelas
                    <select name="kelas" class="form-select" aria-label="Default select">
                        <?php foreach ($dataKelas->getResult() as $row) { ?>
                            <option value="<?php echo $row->kelasID;?>"><?php echo $row->namaKelas;?></option>
                        <?php } ?>
                    </select><br><br>
                    Deadline
                    <input type='date' name="date" id="date"><br><br>
                    File&nbsp;&nbsp;<input id="fileUpload" type='file' name="fileUpload"><br><br>
                    <input id="assginemntID" type="hidden" name="assignmentId" value="Guru"><br>
                    <button id="buttonUpload" class="btn btn-primary" type="submit" form="form">Upload</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- List Upload Modal-->
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File Yang Telah Anda Upload</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errorList"></div>
                <div class="table-responsive">
                    <form name='nilaiForm' id="nilaiForm" method="POST" action="<?php echo base_url();?>/home/uploadNilaiAssignment">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <input type="hidden" value="" id="assginemntIDUN" name="assginemntIDUN">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Uploaded At</th>
                                    <th>Nilai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Uploaded At</th>
                                    <th><button id="buttonUploadNilai" class="btn btn-primary" type="submit" form="nilaiForm">Submit Nilai</button></th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody id="tbody">
                            
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        $(document).on("click", ".download", function()
        {
            event.preventDefault();
            var id = "#f" + $(this).attr("value");
            console.log(id);
            $(id).submit();
        })

        $("#buttonUpload").click(function(e)
        {
            if( document.getElementById("fileUpload").files.length == 0 )
            {
                e.preventDefault();
                $("#error").html('<font color="red">File Is Empty! Please Input File To Upload</font>');
            }
            if($("#date").val() == "")
            {
                e.preventDefault();
                $("#error").html('<font color="red">Please Input Due Date</font>');
            }
        })

        $(".close").click(function(e)
        {
            $("#error").html('');
        })

        $(".uploadList").click(function(e)
        {
            var assignmentId = $(this).attr("value")
            var data = new Array();
            console.log(assignmentId);
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>/Home/uploadList",
                    data:{"assignmentId": assignmentId},
                    dataType:"json",
                    success:function(response)
                    {
                        $("#assginemntIDUN").val(assignmentId);
                        data = response;
                        var html = "";
                        console.log(response);
                        for (var i = 0; i <= data.length - 1; i++) 
                        {
                             html = html + "<tr><td>" + data[i]["name"] + "</td><td>" +
                             data[i]["dateUploaded"] + "</td><td>" + 
                             "<input type='number' name='nilai[]' value='" + data[i]["nilai"] + "'>" + "</td><td>" + 
                             "<form id='f" + i + "ul' method='POST' action='<?php echo base_url();?>/home/download'>" +
                            "<input type='hidden' name='Path' value ='" + data[i]["pathJawaban"] +"'></form>" + 
                            "<i class='download fas fa-file-download fa-fw' value='" + i + "ul'></i></td></tr>"
                            console.log(data[i])
                        }
                        $("#tbody").html(html);
                        
                    },
                    error: function() 
                    {
                        $("#errorList").html('<font color="red">Failed Connecting To The Back-end Server</font>');
                    }
                }
            );
        })
    })
</script>
</html>