<style>
    .padding_class {
        padding: 10px 0;
    }
    h2{
        padding: 3px;
        background:#3c8dbc;
        color: white;
        font-family: initial;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Task
            <small></small>
        </h1>
        <?php if($this->session->flashdata('message')){?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('message')?>
            </div>
        <?php } ?>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Task Management</a></li>
            <li class="active">Create Task</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <form name="create_task_form" action="<?php echo site_url('User_Controller/Insert_Task'); ?>" enctype="multipart/form-data" method="post">
                        <div class="row padding_class">
                            <div class="col-md-12">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Project</label>
                                            <select name="Project_Select" class="form-control" id="Project_Select"  required >
                                                <option value="" >Select Project</option>
                                                <?php foreach ($Select_Project as $row):
                                                    {
                                                        if($row['Project_Contract_Icode'] == '1')
                                                        {
                                                            echo "<option value= " .$row['Project_Icode']._.$row['Project_Contract_Icode']. ">" . $row['Project_Name'] . "</option>";
                                                        }
                                                        else{
                                                            echo "<option value= " .$row['Work_Order_Icode']._.$row['Resource_Contract_Type'].">" . $row['Project_Name'] . "</option>";
                                                        }

                                                    }
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="show_on_project" style="display: none">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Client Name</label>
                                                <input class="form-control" type="text"  name="Client_Name" id="Client_Name" readonly  />
                                                <input class="form-control" type="hidden"  name="Client_Name_icode" id="Client_Name_icode" readonly  />
                                                <input class="form-control" type="hidden"  name="Project_Name" id="Project_Name" readonly  />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Work Category</label>
                                                <input class="form-control" type="text"  id="Work_Category" readonly  />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Work Type</label>
                                                <input class="form-control" type="text"  id="Work_Type" readonly  />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Contract Type</label>
                                                <input class="form-control" type="text"  id="Contract_Type" readonly  />
                                                <input class="form-control" type="hidden"  name="Contract_Type_icode" id="Contract_Type_icode" readonly  />
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <div id="Fixed" >
                            <div class="row padding_class" >
                                <div class="col-md-12" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Resource</label>
                                            <select name="Resource_Select" class="form-control" id="Resource_Select"  required >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="display: none" id="phase_show" >
                                        <div class="form-group">
                                            <label>Select Phase</label>
                                            <select name="Phase_Select" class="form-control" id="Phase_Select"  >
                                            </select>
                                        </div>
                                    </div>
                                    <div id="show_on_Phase" style="display: none">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input class="form-control" type="text"  id="S_date" readonly  />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input class="form-control" type="text"  id="E_date" readonly  />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Estimation Hours</label>
                                                <input class="form-control" type="text"  id="E_Hours" readonly  />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <label>Task Start Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"> </i>
                                            </div>
                                            <input class="form-control" type="text" placehoder="Task Start Date" name="task_date_start" id="startdate"/>
                                            <!--<input class="form-control" id="date_start" name="date_start" placeholder="YYYY/MM/DD" type="text"/>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Task End Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <!--<input class="form-control" id="date_end" name="date_end" placeholder="YYYY/MM/DD" type="text"/>-->
                                            <input class="form-control" type="text" placehoder="Task End Date" name="task_date_end" id="enddate"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estiamtion Hour</label>
                                        <div class="form-group">
                                            <input class="form-control" id="Task_E_Hour" name="Task_E_Hour" placeholder="Estimtion Hours" type="number" min="0" step="1"/>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Task Description</label>
                                            <textarea name="task_desc" id="task_desc" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <input class="files form-control-file" id="Task_Attachment" name="user_files[]" type="file" >
                                            <div class="contents"></div>
                                            <span><a href="javascript:void(0);" class="add btn" >Add More Files</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" name="insert_task" class="btn btn-success pull-right" >Save</button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script type="text/javascript">

    $(document).ready(function() {

        $(".add").click(function() {
            $('<div><input class="files form-control-file" name="user_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" >Remove</span></div>').appendTo(".contents");
        });
        $('.contents').on('click', '.rem', function() {
            $(this).parent("div").remove();
        });


        $("#startdate").datepicker({
            todayBtn: 1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });


        $("#enddate").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
            });


        $("#Project_Select").change(function () {         /*Selecting Project Detais And Resource*/
            //alert("hiiii");
            /*dropdown post *///
            //document.getElementById('Resource_Select').value = '';
            var result = $(this).val();
            var str_array = result.split('_');
            var id = str_array[0];
            var type = str_array[1];
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Select'); ?>",
                data: {
                    id: id,
                    Type: type
                },
                type: "POST",
                success: function (data) {
                    // alert(data);
                    $("#show_on_project").show();
                    var task_details = $.parseJSON(data);
                    //alert(task_details);
                    var client_name = task_details.Client_Details[0]['Client_Company_Name'];
                    //alert(client_name);
                    document.getElementById('Client_Name').value = client_name;

                    var Client_Name_icode = task_details.Client_Details[0]['Client_Icode'];
                    //alert(client_name);
                    document.getElementById('Client_Name_icode').value = Client_Name_icode;

                    var work_cat = task_details.Client_Details[0]['WorkCategory_Name'];
                    document.getElementById('Work_Category').value = work_cat;

                    var work_type = task_details.Client_Details[0]['Work_Name'];
                    document.getElementById('Work_Type').value = work_type;

                    var Project_Name =task_details.Client_Details[0]['Project_Name'];
                    document.getElementById('Project_Name').value = Project_Name;

                    var Contract_Name =task_details.Client_Details[0]['Contracttype_Name'];
                    document.getElementById('Contract_Type').value = Contract_Name;

                    var Contract_icode = task_details.Client_Details[0]['Contracttype_Icode'];
                    //alert(client_name);
                    document.getElementById('Contract_Type_icode').value = Client_Name_icode;

                }


            });
        });


        $("#Project_Select").change(function () {         /*Selecting Project Detais And Resource*/
            var result = $(this).val();
            var str_array = result.split('_');
            var id = str_array[0];
            var type = str_array[1];
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Resource'); ?>",
                data: {
                    id: id,
                    Type: type
                },
                type: "POST",
                success: function (data) {
                    $("#Resource_Select").html(data);
                }


            });
        });

        $("#Project_Select").change(function () {         /*Selecting Project Phase Detais */
            var result = $(this).val();
            var str_array = result.split('_');
            var id = str_array[0];
            var type = str_array[1];
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Phase'); ?>",
                data: {
                    id: id,
                    Type: type
                },
                type: "POST",
                success: function (data) {

                    if(data == '0')
                    {
                        $("#phase_show").hide();
                    }
                    else
                    {
                        $("#phase_show").show();
                        $("#Phase_Select").html(data);
                    }

                }


            });
        });
    });

    $("#Phase_Select").change(function () {         /*Selecting Project Detais And Resource*/
        $.ajax({
            url: "<?php echo site_url('User_Controller/Show_Project_Phase_Details'); ?>",
            data: {
                id: $(this).val()
            },
            type: "POST",
            success: function (data) {
                $("#show_on_Phase").show();
                var task_details = $.parseJSON(data);
                //alert(task_details);
                var client_name = task_details.Phase_Details[0]['Phase_Start_Date'];
                //alert(client_name);
                document.getElementById('S_date').value = client_name;

                var Client_Name_icode = task_details.Phase_Details[0]['Phase_End_Date'];
                //alert(client_name);
                document.getElementById('E_date').value = Client_Name_icode;

                var work_cat = task_details.Phase_Details[0]['Estimate_Hour'];
                document.getElementById('E_Hours').value = work_cat;

            }


        });
    });

</script>
