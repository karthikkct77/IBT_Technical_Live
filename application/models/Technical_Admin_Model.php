<?php
class Technical_Admin_Model extends CI_Model
{
          
    public function __construct()
    {
        parent::__construct();
  
    }

    //** get auto search client **//
    public function get_client($data)
    {
    	$query = $this->db->query("SELECT * FROM ibt_client_details WHERE Company_Name LIKE '%".$data."%' LIMIT 10"); 
    	return $query->result_array();
    }

    //** get perticular client details **//
    public function get_client_details($data)
    {
    	$sql = $this->db->query("SELECT * FROM ibt_client WHERE Client_Company_Name = '$data' ");  // Client check
    	 if($sql->num_rows() == 1)
    	 {
    	 	return 1;
    	 }
    	 else
    	 {
    	 	$query = $this->db->query("SELECT * FROM ibt_client_details WHERE Company_Name = '$data' "); 
	    	//echo $this->db->last_query();
	    	return $query->result_array();
    	 }
    	
    }
    //** Get All Client */
    public function get_All_client()
    {
        $query = $this->db->query("SELECT * FROM ibt_client ");
        return $query->result_array();
    }

    //** Insert Client **//
    public function insert_client($data)
    {
    	$this->db->insert('ibt_client', $data); 
        return $this->db->insert_id();
    }

    //** Insert Client Contact **//
    public function insert_client_contact($data)
    {
    	 $this->db->insert('ibt_client_contacts', $data); 
         return TRUE;
    }
    //** Get All Contacts **//
    public function get_contacts()
    {
    	$query=$this->db->query("SELECT A.*,B.Client_Company_Name FROM ibt_client_contacts A INNER JOIN ibt_client B on A.Contact_Client_Icode = B.Client_Icode "); 
        return $query->result_array();
    }
    //** get perticular contadct**//
    public function get_perticular_contacts($id)
    {
    	$query=$this->db->query("SELECT * FROM ibt_client_contacts WHERE Contact_ID = '$id' "); 
        return $query->result_array();
    }
    /** DELETE CLIENT CONTACT **/
	public function delete_contacts($id)
	{
	     $query = $this->db->query("DELETE from ibt_client_contacts where Contact_ID = $id");
	     return 1;
	}

	/** GET ALL CONTRACT */
	public function get_contract()
	{
		$query=$this->db->query("SELECT * FROM ibt_contractcategory WHERE  Contracttype_Icode != '1'");
		return $query->result_array();
	}

	/** INSERT COntract */
	public function insert_contract($data)
	{
	      $this->db->insert('ibt_contractcategory', $data); 
	      return TRUE;
	}
	/** Delete Contract **/
	public function delete_contract($id)
	{
        $sql = $this->db->query("SELECT * FROM ibt_contract_work WHERE Contract_Type = '$id' ");  // Contract check
        if($sql->num_rows() == 1)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from ibt_contractcategory where Contracttype_Icode = $id");
            return 1;
        }
	}
	/** WORk Category **/
	public function insert_work_category($data)
	{
	    $this->db->insert('ibt_workcategory', $data); 
	     return TRUE;
	}

	/** get work category **/
	public function get_work_category()
	{
	    $query=$this->db->query("SELECT * FROM ibt_workcategory "); 
	    return $query->result_array();
	}
	/** Delete Contract **/
	public function delete_work_Category($id)
	{
        $sql = $this->db->query("SELECT * FROM ibt_contract_work WHERE Project_Type = '$id' ");  // Contract check
        if($sql->num_rows() > 0)
        {
            return 0;
        }
        else {
           // $query = $this->db->query("DELETE from ibt_workcategory where WorkCategory_Icode = $id");
            return 1;
        }

	}
	/** Select Company Details */
	public  function  Select_Company_Details($id)
    {
        $query=$this->db->query("SELECT * FROM `ibt_client` WHERE  Client_Icode ='$id' ");
        return $query->result_array();
    }

    /** Get get_Work_Type */
    public  function  get_Work_Type()
    {
        $query=$this->db->query("SELECT * FROM ibt_work_type ");
        return $query->result_array();
    }
    //** Insert Work Type */
    public function insert_Work_Type($data)
    {
        $this->db->insert('ibt_work_type', $data);
        return TRUE;
    }
    //** Delete delete_work_Type */
    public function  delete_work_Type($id)
    {
        $sql = $this->db->query("SELECT * FROM ibt_project_table WHERE Project_Work_Type_Icode = '$id' ");  // Contract check
        if($sql->num_rows() > 0)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from ibt_work_type where Work_Icode = $id");
            return 1;
        }
    }
    //** phase Master Get */
    public function get_Phase_Master()
    {
        $query=$this->db->query("SELECT * FROM project_phase_master ");
        return $query->result_array();

    }
    //** Insert phase Master */
    public function insert_Phase_Master($data)
    {
        $this->db->insert('project_phase_master', $data);
        return TRUE;
    }
    //** Delete delete_work_Type */
    public function  Delete_Phase_Master($id)
    {
        $sql = $this->db->query("SELECT * FROM project_phase WHERE Phase_Master_Icode = '$id' ");  // Contract check
        if($sql->num_rows() > 0)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from project_phase_master where Project_Phase_Icode = $id");
            return 1;
        }
    }
    //** Get get_Role_Master */
    public function get_Role_Master()
    {
        $query=$this->db->query("SELECT * FROM role_master ");
        return $query->result_array();
    }
    //** insert_Role_Master */
    public function insert_Role_Master($data)
    {
        $this->db->insert('role_master', $data);
        return TRUE;
    }
    //** Delete delete_work_Type */
    public function  Delete_Role_Master($id)
    {
        $sql = $this->db->query("SELECT * FROM project_team WHERE Role_Master_Icode = '$id' ");  // Contract check
        if($sql->num_rows() > 0)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from role_master where Role_Icode = $id");
            return 1;
        }
    }

    //** START: PROJECT */
    //** Get Client Based Contact */
    public function get_Client_Contact($client_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_client_contacts WHERE Contact_Client_Icode = '$client_id'");
        return $query->result_array();
    }
    public function get_technical_member()
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_users ");
        return $query->result_array();
    }

    //** member designation */
    public function  get_Member_Details($member_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_users WHERE  User_Icode = '$member_id'");
      //  echo $this->db->last_query();

        return $query->result_array();
    }
    //** Get Technical Platform */
    public function get_technical_platform()
    {
        $query=$this->db->query("SELECT * FROM technical_platform ");
        return $query->result_array();
    }

    //** Fixed Cost Data Inserted */
    public function Insert_Fixed_Cost($data)
    {
        $this->db->insert('ibt_project_table', $data);
        return $this->db->insert_id();
    }
    //** Insert Project Client COntact */
    public function insert_project_contact($data)
    {
        $this->db->insert('project_client_contacts', $data);
        return 1;
    }

    //** Insert Project Phase */
    public function insert_project_phase($data)
    {
        $this->db->insert('project_phase', $data);
        return $this->db->insert_id();
    }
    //** Insert Project Modules */
    public function insert_project_modules($data)
    {
        $this->db->insert('project_modules', $data);
        return 1;
    }
    //** Insert Project Modules */
    public function insert_project_member($data)
    {
        $this->db->insert('project_team', $data);
        return 1;
    }
    //** get Contract terms */
    public function get_Contract_terms()
    {
        $query=$this->db->query("SELECT * FROM ibt_contract_terms ");
        return $query->result_array();
    }
    //** END: PROJECT */

    //** Insert Resource */
    public function insert_Resource($data)
    {
        $this->db->insert('work_order', $data);
        return $this->db->insert_id();
    }
    public function Save_Contract_Resource($data)
    {
        $this->db->insert('work_order_resource', $data);
        return 1;
    }

    //** Get All Projects */
    public function Get_All_Projects($id)
    {
        $query=$this->db->query("SELECT *,sum(E.Logged_Hours) as logged_hours FROM ibt_project_table A INNER JOIN ibt_client B on A.Project_Client_Icode = B.Client_Icode INNER  JOIN  project_status_master C on A.Project_Status = C.project_status_Icode 
                                 LEFT JOIN ibt_task_entry E on A.Project_Icode = E.Task_Entry_Project_Icode WHERE A.Project_Created_By = '$id' GROUP By A.Project_Icode");
        return $query->result_array();
    }
    //** Get Project Status */
    public function Get_Project_Status()
    {
        $query=$this->db->query("SELECT * FROM project_status_master WHERE project_status_Icode != '1' ");
        return $query->result_array();
    }
    //** Search Project */
    public function Search_Project($status,$id)
    {
        $query=$this->db->query("SELECT * FROM ibt_project_table A INNER JOIN ibt_client B on A.Project_Client_Icode = B.Client_Icode
                                 INNER  JOIN  project_status_master C on A.Project_Status = C.project_status_Icode WHERE A.Project_Created_By = '$id' and A.Project_Status ='$status'  ");
       // echo $this->db->last_query();
        return $query->result_array();
    }
    //** Get Perticular Project Details */
    public function Get_Project_Details($project_id)
    {
        $query=$this->db->query(" SELECT * FROM ibt_project_table A INNER JOIN ibt_client B on A.Project_Client_Icode = B.Client_Icode
                                  INNER  JOIN  project_status_master C on A.Project_Status = C.project_status_Icode INNER  JOIN ibt_workcategory D on A.Project_Work_Category_Icode = D.WorkCategory_Icode
                                  INNER  JOIN ibt_work_type E on A.Project_Work_Type_Icode = E.Work_Icode INNER JOIN ibt_contractcategory F on A.Project_Contract_Icode = F.Contracttype_Icode 
                                  WHERE A.Project_Icode ='$project_id'  ");
        // echo $this->db->last_query();
        return $query->result_array();
    }

    //** Get Project Phase Details */
    public function Get_Project_Phase_Details($project_id)
    {
        $query=$this->db->query(" SELECT * FROM ibt_project_table A INNER JOIN project_phase B on A.Project_Icode = B.Proj_Project_Icode
                                  INNER  JOIN  project_phase_master C on B.Phase_Master_Icode = C.Project_Phase_Master_Icode WHERE A.Project_Icode ='$project_id'  ");
        // echo $this->db->last_query();
        return $query->result_array();

    }
    //** Get project phase master details */
    public function Get_Project_Phase_Master_Details($project_id)
    {
        $query=$this->db->query("SELECT * FROM  project_phase_master WHERE project_phase_master.Project_Phase_Master_Icode NOT IN (SELECT project_phase.Phase_Master_Icode FROM project_phase WHERE project_phase.Proj_Project_Icode='$project_id') ");
        return $query->result_array();
    }
    //** Save Project History */
    public function Save_Project_History($data)
    {
        $this->db->insert('Project_Date_History', $data);
        return 1;
    }
    //** Delete phase */
    public function Delete_project_phase($phase_id)
    {
        $query = $this->db->query("DELETE from project_phase where Project_Phase_Icode = '$phase_id'");
        return $this->db->insert_id();
    }
    //** Get Old Phase Values */
    public function Get_Project_Phase_Old_Details($phase_icode)
    {
        $query=$this->db->query("SELECT Phase_Master_Icode,Phase_Start_Date,Phase_End_Date,Estimate_Hour FROM project_phase WHERE  Project_Phase_Icode='$phase_icode'");
        return $query->result_array();

    }
    //** Insert phase History */
    public function insert_phase_history($data)
    {
        $this->db->insert('phase_date_history', $data);
        return 1;
    }
    //** Get Project Resource Details */
    public function Get_Project_Resource_Details($project_id)
    {
        $query=$this->db->query("SELECT * FROM project_team A INNER JOIN ibt_technical_users B on A.User_Icode=B.User_Icode INNER JOIN role_master C on A.Role_Master_Icode=C.Role_Icode WHERE A.Proj_Project_Icode='$project_id' ");
        return $query->result_array();
    }
    //** Get All Project Member Details */
    public function Get_Project_Member_Details($project_id)
    {
        $query=$this->db->query("SELECT * FROM  ibt_technical_users WHERE ibt_technical_users.User_Icode NOT IN (SELECT project_team.User_Icode FROM project_team WHERE project_team.Proj_Project_Icode='$project_id') ");
        return $query->result_array();
    }
    //** Insert Project Modules */
    public function insert_project_member_Details($data)
    {
        $this->db->insert('project_team', $data);
        return $this->db->insert_id();
    }
    //** Get_Project_Team_Old_Details */
    public function Get_Project_Team_Old_Details($team_id)
    {
        $query=$this->db->query("SELECT * FROM project_team WHERE  Project_Team_Icode='$team_id'");
        return $query->result_array();
    }
    public function insert_Resource_history($data)
    {
        $this->db->insert('project_resource_change_history', $data);
        return 1;
    }
    //** Insert Project Status */
    public function insert_Project_Status_history($data)
    {
        $this->db->insert('project_status_history', $data);
        return 1;
    }
    //** Get project Status History */
    public function get_Project_Status_History($project_id)
    {
        $query=$this->db->query("SELECT * FROM project_status_history A INNER JOIN  project_status_master B on A.History_Status_Icode=B.project_status_Icode 
                                  WHERE  A.History_Project_Icode='$project_id'");
        return $query->result_array();
    }
    //** get all industires */
    public function get_Industries()
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_industries ");
        return $query->result_array();
    }
    //** get all Domains */
    public function get_Domain()
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_domain");
        return $query->result_array();
    }
    //** Get Project Client Contacs */
    public function get_Project_Client_Contacts($project_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_client_contacts A LEFT JOIN project_client_contacts B on  A.Contact_Client_Icode=B.Project_Client_Icode AND A.Contact_ID=B.Client_Contact_Icode
                                 WHERE B.Proj_Project_Icode='$project_id' ");
        return $query->result_array();
    }
    //** Get Project Client Contacs */
    public function get_Project_Inactive_Client_Contacts($project_id,$client_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_client_contacts A WHERE A.Contact_Client_Icode='$client_id' and  A.Contact_ID 
                                 NOT IN (SELECT B.Client_Contact_Icode from project_client_contacts B WHERE B.Proj_Project_Icode='$project_id') ");
        return $query->result_array();
    }
    //** change to inactive */
    public function client_change_inactive($id)
    {
        $query = $this->db->query("DELETE from project_client_contacts where Proj_Client_Contact_Icode = $id");
        return 1;

    }
    //** Get All work order details */
    public function Get_All_Work_Order($id)
    {
       // $query=$this->db->query("SELECT * FROM work_order A INNER JOIN ibt_client B on A.Resource_Client_Icode=B.Client_Icode WHERE A.Created_By='$id'");
        $query=$this->db->query("SELECT *, COUNT(C.WO_Resource_Icode) as Resource_count FROM work_order A  INNER JOIN ibt_client B on A.Resource_Client_Icode=B.Client_Icode INNER JOIN work_order_resource C on A.Work_Order_Icode=C.WO_Icode 
                                  WHERE A.Created_By='$id'  and C.Active='Yes' GROUP by A.Work_Order_Icode");
        return $query->result_array();
    }
    //** get Perticular work order details */
    public function Get_Work_Order_Details($id)
    {
        $query=$this->db->query("SELECT * FROM work_order A INNER JOIN ibt_client B on A.Resource_Client_Icode = B.Client_Icode
                                   INNER  JOIN ibt_workcategory D on A.Resource_Category_Icode = D.WorkCategory_Icode
                                  INNER  JOIN ibt_work_type E on A.Resource_Work_Type_Icode = E.Work_Icode INNER JOIN ibt_contractcategory F on A.Resource_Contract_Type = F.Contracttype_Icode 
                                  WHERE A.Work_Order_Icode ='$id' ");
        return $query->result_array();
    }
    //** get Work Order Resource Details */
    public function Get_Work_Order_Resource_Details($id)
    {
        $query=$this->db->query("SELECT * FROM work_order_resource A INNER JOIN ibt_technical_users B on A.Member_Icode=B.User_Icode INNER JOIN role_master C on A.Role_Icode=C.Role_Icode 
                               INNER JOIN ibt_contract_terms D on A.Term_Icode=D.Contract_Term_Icode WHERE A.WO_Icode='$id' and A.Active = 'Yes' ");
        return $query->result_array();
    }
    //** Get Work Order Old Details */
    public function Get_Work_order_Old_Details($id)
    {
        $query=$this->db->query("SELECT * FROM work_order_resource WHERE WO_Resource_Icode='$id'");
        return $query->result_array();
    }
    //** Insert WO Extension History */
    public function insert_WO_Extension_history($data)
    {
        $this->db->insert('wo_resource_date_extension', $data);
        return 1;
    }

    //** Get All Resource Member Details */
    public function Get_Resource_Member_Details($project_id)
    {
        $query=$this->db->query("SELECT * FROM  ibt_technical_users WHERE ibt_technical_users.User_Icode NOT IN (SELECT work_order_resource.Member_Icode FROM work_order_resource WHERE work_order_resource.WO_Icode='$project_id') ");
        return $query->result_array();
    }
    //** Insert WorkOrder Contact */
    public function insert_WO_contact($data)
    {
        $this->db->insert('wo_client_contacts', $data);
        return 1;

    }
    //** Insert Work Order Resource Chnage History */
    public  function  Insert_WO_Resource_Change_history($data)
    {
        $this->db->insert('wo_resource_change_history', $data);
        return 1;
    }

    //** Get Project Client Contacs */
    public function get_WO_Client_Contacts($project_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_client_contacts A LEFT JOIN wo_client_contacts B on  A.Contact_Client_Icode=B.WO_Client_Icode AND A.Contact_ID=B.Client_Contact_Icode 
                                 WHERE B.WO_Icode='$project_id' ");
        return $query->result_array();
    }
    //** Get Project Client Contacs */
    public function get_WO_Inactive_Client_Contacts($project_id,$client_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_client_contacts A WHERE A.Contact_Client_Icode='$client_id' and  A.Contact_ID 
                                 NOT IN (SELECT B.Client_Contact_Icode from wo_client_contacts B WHERE B.WO_Icode='$project_id') ");
        return $query->result_array();
    }

    //** WO change to inactive */
    public function wo_client_change_inactive($id)
    {
        $query = $this->db->query("DELETE from wo_client_contacts where WO_Client_Contact_Icode = $id");
        return 1;

    }
    //** insert task category */
    public function insert_Task_Category_Master($data)
    {
        $this->db->insert('task_category_master', $data);
        return 1;
    }
    //** get_Task_Category_Master */
    public function get_Task_Category_Master()
    {
        $query=$this->db->query("SELECT * FROM task_category_master ");
        return $query->result_array();
    }

    //** Get Requirements Model **//
    public function Get_Requirements()
     {
    //     $DB2 = $this->load->database('another_db', TRUE);
    //     $query=$DB2->query("SELECT * FROM domain_data "); 
    //     return $query->result_array();

     $query=$this->db->query("SELECT * FROM ibt_requirement_details ");
        return $query->result_array();
    }
    //** Get Project Leader **//
    public function Get_Project_Leader()
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_users WHERE User_Leave_Approval_Rights = 'Yes' ");
        return $query->result_array();
    }

    //** Update Requirement Master */
    public function Assigned_Requirement_Leader($data,$id)
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $DB2->where('Requirement_Icode',$id);
        $DB2->update('ibt_requirement_master', $data);
        return 1;
    }
    public function Get_Assigned_Requirements()
    {
        $DB2 = $this->load->database('another_db', TRUE);
        $query=$DB2->query("SELECT A.*,B.Prospect_Icode,B.Company_Name,B.WebURL,C.User_Icode,C.User_Name,D.Req_Name FROM ibt_requirement_master A 
                            INNER JOIN ibt_prospect_data B on A.Prospect_Icode=B.Prospect_Icode 
                            INNER JOIN ibt_technical_user C on A.Tech_Leader_Code=C.User_Icode 
                            INNER JOIN requirement_status_types D on A.Requirement_Status=D.Req_Id 
                            WHERE A.Tech_Leader_Code !='0' ");
        return $query->result_array();
    }






    }