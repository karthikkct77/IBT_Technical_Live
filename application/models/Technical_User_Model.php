<?php
class Technical_User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*Select Project/ resource project*/

    public function Select_Project()
    {
        $user_icode = $this->session->userdata['userid'];

        $query = $this->db->query("SELECT * FROM ibt_project_table A INNER JOIN project_team B on A.Project_Icode=B.Proj_Project_Icode WHERE B.User_Icode ='$user_icode' and B.Role_Master_Icode ='1'");
        return $query->result_array();
    }
    public function Select_Resource_project()
    {
        $user_icode = $this->session->userdata['userid'];

        $query = $this->db->query("SELECT * FROM work_order A INNER JOIN work_order_resource B on A.Work_Order_Icode=B.WO_Icode  WHERE B.Member_Icode='$user_icode' and B.Role_Icode='1'");
        return $query->result_array();
    }


    /*Select Project*/


    /*Show on Select Project*/

    public function Show_On_Select_Project($id)
    {
        $query = $this->db->query("SELECT * FROM ibt_project_table A INNER JOIN ibt_client B ON A.Project_Client_Icode=B.Client_Icode INNER JOIN ibt_workcategory C ON C.WorkCategory_Icode=A.Project_Work_Category_Icode INNER JOIN ibt_work_type D ON D.Work_Icode=A.Project_Work_Type_Icode 
                                  INNER JOIN ibt_contractcategory E on A.Project_Contract_Icode=E.Contracttype_Icode  WHERE A.Project_Icode='$id'");
        return $query->result_array();
    }
    public function Show_On_Select_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM work_order A INNER JOIN ibt_client B ON A.Resource_Client_Icode=B.Client_Icode INNER JOIN ibt_workcategory C ON C.WorkCategory_Icode=A.Resource_Category_Icode INNER JOIN ibt_work_type D ON D.Work_Icode=A.Resource_Work_Type_Icode
                                   INNER JOIN ibt_contractcategory E on A.Resource_Contract_Type=E.Contracttype_Icode  WHERE A.Work_Order_Icode='$id'");
        return $query->result_array();
    }


    /*Show on Select Resource*/

    public function Select_Project_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM project_team A INNER JOIN ibt_technical_users B ON A.User_Icode=B.User_Icode WHERE A.Proj_Project_Icode = '$id'");
       // echo $this->db->last_query();
        return $query->result_array();
    }
    public function Select_Work_Order_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM work_order_resource A INNER JOIN ibt_technical_users B ON A.Member_Icode=B.User_Icode WHERE A.WO_Icode = '$id'");
        // echo $this->db->last_query();
        return $query->result_array();
    }

    /*Select Resource*/

    /*Insert Task & Attachments*/
    public function Insert_Task($task_data)
    {
        $this->db->insert('ibt_task_master', $task_data);
        return $this->db->insert_id();
    }

    public function Insert_Task_Attachment($data)
    {
        $this->db->insert('ibt_task_attachments', $data);
        return 1;
    }
    /*Insert Task & Attachments*/

    /*Assigned Tasks*/
    public function Assigned_Task_Entry()
    {
        $user_icode = $this->session->userdata['userid'];
        //print_r($user_icode);
        $query = $this->db->query("SELECT *,sum(E.Logged_Hours) as logged_hours FROM ibt_task_master A INNER JOIN ibt_client B ON A.Task_Client_Icode=B.Client_Icode 
                                  INNER JOIN ibt_project_table C on A.Task_Project_Icode=C.Project_Icode INNER JOIN ibt_technical_users D on A.Task_Created_By=D.User_Icode 
                                  INNER JOIN ibt_contractcategory F on A.Task_Contract_Type=F.Contracttype_Icode 
                                  LEFT JOIN ibt_task_entry E on A.Task_Icode = E.Task_Master_Icode WHERE A.Task_Resource_Icode ='$user_icode' AND A.Task_Status='1' 
                                  GROUP BY A.Task_Icode ");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function Assigned_Task_Entry_WO()
    {
        $user_icode = $this->session->userdata['userid'];
        //print_r($user_icode);
        $query = $this->db->query("SELECT *,sum(E.Logged_Hours) as logged_hours FROM ibt_task_master A INNER JOIN ibt_client B ON A.Task_Client_Icode=B.Client_Icode 
                                  INNER JOIN work_order C on A.Task_WO_Icode=C.Work_Order_Icode INNER JOIN ibt_technical_users D on A.Task_Created_By=D.User_Icode INNER JOIN ibt_contractcategory F on A.Task_Contract_Type=F.Contracttype_Icode 
                                  LEFT JOIN ibt_task_entry E on A.Task_Icode = E.Task_Master_Icode WHERE A.Task_Resource_Icode ='$user_icode' AND A.Task_Status='1' 
                                  GROUP BY A.Task_Icode ");
        //echo $this->db->last_query();
        return $query->result_array();
    }
    /*Assigned Tasks*/


    /*insert task entry*/
    public function save_task_entry($data)
    {
        $this->db->insert('ibt_task_entry', $data);
        return 1;
    }
    /*insert task entry*/

    public function get_project_phase($project_id,$phase_id)
    {
        $query = $this->db->query("SELECT * FROM project_phase A INNER JOIN project_phase_master B on A.Phase_Master_Icode=B.Project_Phase_Master_Icode 
                                   WHERE A.Proj_Project_Icode='$project_id' and A.Project_Phase_Icode='$phase_id'");
        //echo $this->db->last_query();
        return $query->result_array();

    }
    public  function  get_project_modules($project_id)
    {
        $query = $this->db->query("SELECT * FROM project_modules WHERE Proj_Project_Icode='$project_id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }


    public function get_task_attachments($task_id)
    {
        $query = $this->db->query("SELECT * FROM ibt_task_attachments A INNER JOIN ibt_project_table B on A.Attachment_Project_Icode=B.Project_Icode WHERE Attachment_Task_Icode ='$task_id'");
       // echo $this->db->last_query();
        return $query->result_array();
    }

    public  function  View_Manage_Task()
    {
        $user_icode = $this->session->userdata['userid'];
//        $query = $this->db->query("SELECT B.Task_Entry_Icode, B.Task_Master_Icode, B.Logged_Hours,A.Task_Estimated_Hours,B.Task_Entry_Icode,A.Task_Start_Date,A.Task_End_Date,(SELECT Work_Progress FROM ibt_task_entry WHERE Task_Master_Icode=B.Task_Master_Icode ORDER BY B.Created_On DESC LIMIT 1 OFFSET 0) as task_status,(SELECT Task_Entry_Icode FROM ibt_task_entry WHERE Task_Master_Icode = B.Task_Master_Icode ORDER BY Created_On DESC LIMIT 1 OFFSET 0) as New_Task_Entry_Icode,
//                        SUM(B.Logged_Hours) as Total_logged_Hours, C.Client_Company_Name,C.Client_Icode,D.Project_Icode,D.Project_Name,E.User_Icode,E.User_Name,B.Leader_Reviewed FROM ibt_task_master A INNER JOIN ibt_task_entry B ON A.Task_Icode=B.Task_Master_Icode INNER JOIN ibt_client C on A.Task_Client_Icode=C.Client_Icode INNER JOIN ibt_project_table D on A.Task_Project_Icode=D.Project_Icode
//                                INNER JOIN ibt_technical_users E on B.Created_By=E.User_Icode WHERE A.Task_Created_By='$user_icode' and B.Leader_Reviewed='No' and A.Task_Status='1  '
//                                GROUP BY B.task_master_icode");

        $query = $this->db->query("SELECT *  FROM ibt_task_entry A INNER JOIN ibt_task_master B on A.Task_Master_Icode=B.Task_Icode INNER JOIN ibt_technical_users C on A.Created_By=C.User_Icode INNER JOIN ibt_contractcategory D on B.Task_Contract_Type=D.Contracttype_Icode
                                   WHERE B.Task_Created_By='$user_icode' and A.Leader_Reviewed='No' and B.Task_Status='1'");
        return $query->result_array();


    }
//    public  function  View_Manage_Task()
//    {
//        $user_icode = $this->session->userdata['userid'];
//        $query = $this->db->query("SELECT *  FROM ibt_task_master A INNER JOIN ibt_task_entry B ON A.Task_Icode=B.Task_Master_Icode INNER JOIN ibt_client C on A.Task_Client_Icode=C.Client_Icode INNER JOIN ibt_project_table D on A.Task_Project_Icode=D.Project_Icode
//                                INNER JOIN ibt_technical_users E on B.Created_By=E.User_Icode WHERE A.Task_Created_By='7' and B.Leader_Reviewed='No' ");
//        return $query->result_array();
//
//
//    }
    //** Get Task Description */
    public function get_task_desc($id)
    {
        $query = $this->db->query(" SELECT * FROM ibt_task_master A LEFT JOIN ibt_task_attachments B on A.Task_Icode=B.Attachment_Task_Icode INNER JOIN ibt_project_table C on A.Task_Project_Icode=C.Project_Icode  
                                    INNER JOIN ibt_client D on A.Task_Client_Icode=D.Client_Icode  WHERE A.Task_Icode='$id'");
        return $query->result_array();
    }
    //** Get Task Billable Hour */
    public  function  Get_Task_Billable_Hours($id)
    {
        $query = $this->db->query("SELECT Task_Billable_Hours FROM ibt_task_master WHERE Task_Icode='$id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    //** Select project phase details */
    public function Select_Project_Phase($id)
    {
        $query = $this->db->query("SELECT * FROM project_phase A INNER JOIN project_phase_master B on A.Phase_Master_Icode=B.Project_Phase_Master_Icode WHERE A.Proj_Project_Icode='$id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }
    //** Get project phase details */
    public function Show_Project_Phase_Details($id)
    {
        $query = $this->db->query("SELECT * FROM project_phase WHERE Project_Phase_Icode='$id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    //** Get total Logged Hours */
    public function get_total_logged_hours($master_id,$user_id)
    {
        $query = $this->db->query("SELECT sum(Logged_Hours) as Logged_Hours FROM ibt_task_entry WHERE Task_Master_Icode='$master_id' and Created_By='$user_id' ");
        //echo $this->db->last_query();
        return $query->result_array();

    }

    //** Un Assigned User Project / WO */
    public function Un_Assigned_Project()
    {
        $user_icode = $this->session->userdata['userid'];
        $query = $this->db->query("SELECT B.Project_Icode,B.Project_Name,B.Project_Contract_Icode  FROM project_team A INNER JOIN ibt_project_table B on A.Proj_Project_Icode=B.Project_Icode 
                                   WHERE A.User_Icode='$user_icode' and A.Active ='Yes' and B.Project_Status ='1' ");
        return $query->result_array();
    }
    public function Un_Assigned_Wo()
    {
        $user_icode = $this->session->userdata['userid'];
        $query = $this->db->query("SELECT B.Work_Order_Icode,B.Project_Name,B.Resource_Contract_Type FROM work_order_resource A INNER JOIN work_order B on A.WO_Icode=B.Work_Order_Icode 
                                   WHERE A.Member_Icode='$user_icode' and A.Active='Yes' AND B.Wo_Status='1' ");
        return $query->result_array();
    }
    public function Get_User_Incharge()
    {
        $query = $this->db->query("SELECT A.User_Icode,B.User_Name FROM project_team A INNER JOIN ibt_technical_users B on A.User_Icode=B.User_Icode WHERE  Role_Master_Icode ='1' ");
        return $query->result_array();
    }

    //** get Project Incharge */
    public function Get_Project_Incharge($project_id)
    {
        $query = $this->db->query("SELECT A.User_Icode,B.User_Name FROM project_team A INNER JOIN ibt_technical_users B on A.User_Icode=B.User_Icode WHERE A.Proj_Project_Icode='$project_id' and A.Role_Master_Icode='1' ");
        return $query->result_array();
    }
    public function Get_WO_Incharge($wo_id)
    {
        $query = $this->db->query("SELECT B.User_Icode,B.User_Name FROM work_order_resource A INNER JOIN ibt_technical_users B on A.Member_Icode=B.User_Icode WHERE A.WO_Icode='$wo_id' and A.Role_Icode='1' ");
        return $query->result_array();
    }
    //** Get Task Category */
    public function Get_Task_Category()
    {
        $query = $this->db->query("SELECT * FROM task_category_master ");
        return $query->result_array();
    }
    //** get other task details view in leader */
    public function Show_Other_Task()
    {
        $user_icode = $this->session->userdata['userid'];
        $query = $this->db->query(" SELECT * FROM ibt_task_master A LEFT JOIN ibt_technical_users B on A.Task_Resource_Icode=B.User_Icode 
                                    LEFT JOIN ibt_contractcategory C on A.Task_Contract_Type=C.Contracttype_Icode 
                                    LEFT JOIN ibt_project_table D on A.Task_Project_Icode=D.Project_Icode LEFT JOIN work_order E on A.Task_WO_Icode=E.Work_Order_Icode 
                                    LEFT JOIN task_category_master F on A.Task_Category_Icode=F.Task_Category_Icode WHERE A.Task_Created_By='$user_icode' and A.Type_Of_Task='Un_Assigned' and A.Task_Status='1' ");
        return $query->result_array();
    }
    public function get_other_task_desc($id)
    {
        $query = $this->db->query(" SELECT * FROM ibt_task_master A  LEFT JOIN ibt_project_table D on A.Task_Project_Icode=D.Project_Icode LEFT JOIN work_order E on A.Task_WO_Icode=E.Work_Order_Icode LEFT JOIN ibt_client B on D.Project_Client_Icode=B.Client_Icode and E.Resource_Client_Icode=B.Client_Icode
                                    LEFT JOIN task_category_master F on A.Task_Category_Icode=F.Task_Category_Icode WHERE A.Task_Icode ='$id' ");
        return $query->result_array();
    }
    //** Get Leader Requirements */
    public function Get_Requirements()
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $user_icode = $this->session->userdata['userid'];
        $query=$DB2->query("SELECT A.*,B.Prospect_Icode,B.Company_Name,B.WebURL,C.User_Icode,C.User_Name,D.Req_Name FROM ibt_requirement_master A 
                            INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode 
                            INNER JOIN ibt_technical_user C on A.Tech_Leader_Code=C.User_Icode 
                            INNER JOIN requirement_status_types D on A.Requirement_Status=D.Req_Id 
                            WHERE A.Tech_Leader_Code ='$user_icode' ");
        return $query->result_array();
    }
    //** Select Requirement based Compnay **/

    public function Select_Req_company($req_id)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM ibt_requirement_master A INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode INNER JOIN requirement_status_types C on A.Requirement_Status = C.Req_Id where Requirement_Icode = '$req_id'  ");
        return $query->result_array();
    }
    public function Select_Requirement_Status($type,$status)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM `requirement_status_types` WHERE Req_Type='$type' and Req_Id > '$status' and Req_Id <= '4'  ");
        return $query->result_array();
    }

    //** Client Reason **//
    public function Select_Client_Reason()
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM project_loss_client_side  ");
        return $query->result_array();
    }

    //** Our Reason **//
    public function Select_Our_Reason()
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM Project_Loss_Our_Side  ");
        return $query->result_array();
    }
    //** Select lost Details **/
    public function Select_Lost_Details($req_id)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM project_lost where Requirement_Icode = '$req_id'  ");
        return $query->row_array(0);
    }

    //** Select lost Reason Details **/
    public function Select_Lost_Reason_Client($lid)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM project_loss_client_side where Project_Loss_Client_Icode = '$lid'  ");
        return $query->result_array();
    }

    //** Select lost Reason OUR Details **/
    public function Select_Lost_Reason_Our($lid)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM project_loss_our_side where Project_Loss_Our_Icode = '$lid'  ");
        return $query->result_array();
    }

    //** poroject won details **//
    public function Select_Won_Details($req_id)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT * FROM Project_Won A INNER JOIN ibt_workcategory B on A.Project_Type = B.WorkCategory_Icode INNER JOIN ibt_contractcategory C on A.Contract_Type=C.Contracttype_Icode where Requirement_Icode = '$req_id'  ");
        return $query->row_array(0);
    }
    //** Select Leaders Comments **/

    public function Select_Leader_Comments($req_id)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT A.Req_Comments,A.Tech_Leader_Cmd,A.Modified_Date,B.User_Name as Leader,C.User_Name as Bde FROM ibt_requirement_status A LEFT OUTER JOIN ibt_technical_user B on A.Tech_Leader_Code = B.User_Icode LEFT OUTER JOIN ibt_marketing_user C on A.BDE_Code=C.User_Icode WHERE A.Requirement_Icode='$req_id' ORDER by A.Modified_Date DESC   ");
        return $query->result_array();
    }



}