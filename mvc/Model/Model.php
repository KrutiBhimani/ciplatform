<?php

class Model
{

	protected $connection = '';
	protected $servername = 'localhost';
	protected $username = 'root';
	protected $password = '';
	protected $db = 'ci_platform';

	function __construct()
	{

		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$this->connection = new mysqli($this->servername, $this->username, $this->password, $this->db);
		} catch (Exception $ex) {
			echo "Connection Failed: " . $ex->getMessage();
			exit;
		}
	}
	function InsertData($tbl, $data)
	{
		$clms = implode(',', array_keys($data));
		$vals = implode("','", $data);
		$sql = "insert into $tbl ($clms) values ('$vals')";
		$sql = str_replace("''", "NULL", $sql);
		$insertEx = $this->connection->query($sql);
		if ($insertEx) {
			$response['Data'] = null;
			$response['Code'] = true;
			$response['Message'] = 'Data inserted successfully.';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Data insertion failed.';
		}
		return $response;
	}
	function GetMission()
	{
		$resetSql = "SELECT max(mission_id) as max FROM mission";
		$resetEx = $this->connection->query($resetSql);
		$userData = $resetEx->fetch_object();
		if ($resetEx) {
			$response['Data'] = $userData;
			$response['Code'] = true;
			$response['Message'] = 'user found';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'user not found';
		}
		return $response;
	}
	function LoginData($email, $password)
	{
		$loginSql = "SELECT * FROM user WHERE email = '$email' and status = '1' AND deleted_at is null";
		$loginEx = $this->connection->query($loginSql);
		$userData = $loginEx->fetch_object();
		if ($loginEx->num_rows > 0 && $password == $userData->password) {
			$response['Data1'] = $userData;
			$response['Code'] = true;
			$response['Message'] = 'Login Successful.';
		} else {
			$loginSql = "SELECT * FROM admin WHERE email = '$email'";
			$loginEx = $this->connection->query($loginSql);
			$adminData = $loginEx->fetch_object();
			if ($loginEx->num_rows > 0 && $password == $adminData->password) {
				$response['Data2'] = $adminData;
				$response['Code'] = true;
				$response['Message'] = 'Login Successful.';
			} else {
				$response['Data2'] = null;
				$response['Code'] = false;
				$response['Message'] = 'Email or password is incorrect or inactive user.';
			}
		}
		return $response;
	}
	function ResetPass($email)
	{
		$resetSql = "SELECT * FROM user WHERE email = '$email'";
		$resetEx = $this->connection->query($resetSql);
		$userData = $resetEx->fetch_object();
		if ($resetEx) {
			$response['Data'] = $userData;
			$response['Code'] = true;
			$response['Message'] = 'user found';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'user not found';
		}
		return $response;
	}
	function UpdatePass($email, $password)
	{
		$resetSql = "UPDATE user set password='$password' where email='$email'";
		$resetEx = $this->connection->query($resetSql);
		if ($resetEx) {
			$response['Data'] = null;
			$response['Code'] = true;
			$response['Message'] = 'your password is updated';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'not updated';
		}
		return $response;
	}
	function CheckHour($token)
	{
		$hoursql = "SELECT * FROM password_reset WHERE token = '$token'";
		$hourEx = $this->connection->query($hoursql);
		$hourData = $hourEx->fetch_object();
		if ($hourEx->num_rows > 0) {
			$response['Data'] = $hourData;
			$response['Code'] = true;
			$response['Message'] = 'link exist';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'link expired';
		}
		return $response;
	}
	function SelectBanner()
	{
		$selSql = "SELECT * FROM banner WHERE deleted_at is NULL ORDER BY banner.sort_order ASC";
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectData(string $tblName, int $postno = 0, int $pagecount = 0, array $where = [])
	{
		$selSql = "SELECT * FROM $tblName";
		if (!empty($where)) {
			$selSql .= " WHERE (";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' OR";
			}
			$selSql = rtrim($selSql, 'OR');
			$selSql .= ") AND deleted_at is NULL";
		} else if (empty($where)) {
			$selSql .= " WHERE deleted_at is NULL";
		}
		if ($postno != 0 || $pagecount != 0) {
			$selSql .= " LIMIT $postno,$pagecount";
		}
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectApply(string $tblName, array $where = [])
	{
		$selSql = "SELECT * FROM $tblName";
		if (!empty($where)) {
			$selSql .= " WHERE (";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' OR";
			}
			$selSql = rtrim($selSql, 'OR');
			$selSql .= ") AND deleted_at is NULL";
		} else if (empty($where)) {
			$selSql .= " WHERE deleted_at is NULL";
		}
		if ($tblName == 'mission_application') {
			$selSql .= " AND (approval_status LIKE 'APPROVE' OR approval_status LIKE 'PENDING')";
		}
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectSeat()
	{
		$selSql = "SELECT *,Count(mission_id) as count FROM `mission_application` 
		WHERE approval_status LIKE 'APPROVE'
		GROUP By mission_id";
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function GetSelectedSkill($mission_id)
	{
		$selSql = "SELECT * from mission_skill
		LEFT JOIN skill on skill.skill_id = mission_skill.skill_id
		where mission_id = $mission_id";
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectJoinApp(int $postno = 0, int $pagecount = 0, array $where = [])
	{
		$selSql = "SELECT *,mission.title as mission_title FROM mission_application
		INNER JOIN mission ON mission_application.mission_id=mission.mission_id
		INNER JOIN user On mission_application.user_id=user.user_id";
		if (!empty($where)) {
			$selSql .= " WHERE (";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' OR";
			}
			$selSql = rtrim($selSql, 'OR');
			$selSql .= ") AND approval_status='PENDING' AND mission_application.deleted_at is NULL";
		} else if (empty($where)) {
			$selSql .= " WHERE approval_status='PENDING' AND mission_application.deleted_at is NULL";
		}
		if ($postno != 0 || $pagecount != 0) {
			$selSql .= " LIMIT $postno,$pagecount";
		}
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectJoinStory(int $postno = 0, int $pagecount = 0, array $where = [])
	{
		$selSql = "SELECT *,mission.title as mission_title,story.title as story_title FROM story
		INNER JOIN mission ON story.mission_id=mission.mission_id
		INNER JOIN user ON story.user_id=user.user_id";
		if (!empty($where)) {
			$selSql .= " WHERE (";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' OR";
			}
			$selSql = rtrim($selSql, 'OR');
			$selSql .= ") AND story.status='PENDING' AND story.deleted_at is NULL";
		} else if (empty($where)) {
			$selSql .= " WHERE story.status='PENDING' AND story.deleted_at is NULL";
		}
		if ($postno != 0 || $pagecount != 0) {
			$selSql .= " LIMIT $postno,$pagecount";
		}
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectViewStory($story_id)
	{
		$selSql = "SELECT *,mission.title as mission_title,story.title as story_title,story.description as story_desc FROM story
		INNER JOIN mission ON story.mission_id=mission.mission_id
		INNER JOIN user ON story.user_id=user.user_id Where story_id = $story_id";
		$sqlEx = $this->connection->query($selSql);
		$allData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectStory(array $where = [])
	{
		$selSql = "SELECT *,mission.title as mission_title FROM mission_application
		INNER JOIN mission ON mission_application.mission_id=mission.mission_id
		INNER JOIN user On mission_application.user_id=user.user_id";
		if (!empty($where)) {
			$selSql .= " WHERE ";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' OR";
			}
			$selSql = rtrim($selSql, 'OR');
		}
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.' . $selSql;
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.' . $selSql;
		}
		return $response;
	}
	function SelectById(int $user_id)
	{
		$selSql = "SELECT *,city.name as city_name,country.name as country_name FROM user join city ON user.city_id = city.city_id join country ON user.country_id = country.country_id Where user_id = $user_id;";
		$sqlEx = $this->connection->query($selSql);
		$userData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $userData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectData1(string $tblName, array $where = [])
	{
		$selSql = "SELECT * FROM $tblName";
		if (!empty($where)) {
			$selSql .= " WHERE ";
			foreach ($where as $key => $value) {
				$selSql .= " $key = $value";
			}
		}
		$sqlEx = $this->connection->query($selSql);
		$allData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectData2($mission_id)
	{
		$selSql = "SELECT *,city.name as city_name, country.name as country_name,mission.title as mission_title, mission_theme.title as theme_title from mission
		LEFT JOIN time_mission on time_mission.mission_id = mission.mission_id 
		LEFT JOIN goal_mission on goal_mission.mission_id = mission.mission_id 
		LEFT JOIN city on city.city_id = mission.city_id
		LEFT JOIN country on country.country_id = mission.country_id
		LEFT JOIN mission_theme on mission_theme.mission_theme_id = mission.theme_id
		LEFT JOIN mission_media on mission_media.mission_id = mission.mission_id
		LEFT JOIN mission_document on mission_document.mission_id = mission.mission_id
		WHERE mission.mission_id = $mission_id";
		$sqlEx = $this->connection->query($selSql);
		$allData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectData3($postno, $pagecount,$resultString,$user_id = 0,array $where = [],$int = '')
	{
		$selSql = "SELECT *,city.name as city_name, country.name as country_name,mission.title as mission_title, mission_theme.title as theme_title,mission.mission_id as missionid,COUNT(mission_application.mission_id) as count, ROUND(AVG(mission_rating.rating)) as rating, time_mission.total_seat - COUNT(mission_application.mission_id) as seatcount from mission
		LEFT JOIN time_mission on time_mission.mission_id = mission.mission_id 
		LEFT JOIN goal_mission on goal_mission.mission_id = mission.mission_id 
		LEFT JOIN city on city.city_id = mission.city_id
		LEFT JOIN country on country.country_id = mission.country_id
		LEFT JOIN mission_theme on mission_theme.mission_theme_id = mission.theme_id
		LEFT JOIN mission_media on mission_media.mission_id = mission.mission_id
		LEFT JOIN mission_document on mission_document.mission_id = mission.mission_id
        LEFT JOIN mission_application on mission_application.mission_id = mission.mission_id
        LEFT JOIN mission_rating on mission_rating.mission_id = mission.mission_id";
		if($resultString=='Sort by my favourite'){
			$selSql .= " INNER JOIN favourite_mission on favourite_mission.mission_id = mission.mission_id Where favourite_mission.user_id = $user_id AND favourite_mission.deleted_at is null";
		}
		if($int == null)
		{
			if (!empty($where)) {
				$selSql .= " WHERE (";
				foreach ($where as $key => $value) {
					$selSql .= " $key LIKE '%$value%' OR";
				}
				$selSql = rtrim($selSql, 'OR');
				$selSql .= ") ";
			}
		}
		if($int != null)
		{
			if (!empty($where)) {
				$selSql .= " WHERE (";
				foreach ($where as $key => $value) {
					$selSql .= " $int LIKE '%$value%' OR";
				}
				$selSql = rtrim($selSql, 'OR');
				$selSql .= ") ";
			}
		}
		$selSql .= " GROUP By mission.mission_id";
		if($resultString=='Newest')
		{
			$selSql .= " ORDER BY mission.mission_id DESC ";
		}
		if($resultString=='Oldest')
		{
			$selSql .= " ORDER BY mission.mission_id ASC ";
		}
		if($resultString=='sort by deadline')
		{
			$selSql .= " ORDER BY time_mission.deadline ASC ";
		}
		if($resultString=='Lowest available seats')
		{
			$selSql .= " ORDER BY seatcount ASC ";
		}
		if($resultString=='Highest available seats')
		{
			$selSql .= " ORDER BY seatcount DESC ";
		}
		$selSql .= " LIMIT $postno,$pagecount";
		// echo $selSql;
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Row'] = $sqlEx->num_rows;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Row'] = 0;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectData4($user_id)
	{
		$selSql = "SELECT * FROM `user` 
		where user_id  != $user_id";
		echo $selSql;
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Row'] = $sqlEx->num_rows;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Row'] = 0;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function UpdateData1($tbl, $data, array $where = [])
	{
		$sql = "UPDATE $tbl SET ";
		foreach ($data as $key => $value) {
			$sql .= "$key = '$value',";
		}
		$sql = rtrim($sql, ',');
		if (!empty($where)) {
			$sql .= " WHERE ";
			foreach ($where as $key => $value) {
				$sql .= " $key = $value AND";
			}
			$sql = rtrim($sql, 'AND');
		}
		$sql = str_replace("''", "NULL", $sql);
		return $updEx = $this->connection->query($sql);
	}
	function SelectId(int $user_id)
	{
		$selSql = "SELECT * FROM user WHERE user_id = $user_id;";
		$sqlEx = $this->connection->query($selSql);
		$userData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $userData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function UpdateData($tbl, $data, $user_id)
	{
		$sql = "UPDATE $tbl SET ";
		foreach ($data as $key => $value) {
			$sql .= "$key = '$value',";
		}
		$sql = rtrim($sql, ',');
		$sql .= " WHERE user_id = $user_id";

		return $updEx = $this->connection->query($sql);
	}
	function DeleteData($tbl, $delete_user_id)
	{
		$sql = "DELETE FROM $tbl WHERE user_id = $delete_user_id";
		return $updEx = $this->connection->query($sql);
	}
	function DeleteData1($tbl, array $where = [])
	{
		$sql = "DELETE FROM $tbl";
		if (!empty($where)) {
			$sql .= " WHERE ";
			foreach ($where as $key => $value) {
				$sql .= " $key = $value";
			}
		}
		return $updEx = $this->connection->query($sql);
	}
	function Select($tbl)
	{
		$selSql = "SELECT * FROM $tbl WHERE deleted_at is NULL";
		if ($tbl == 'mission_application') {
			$selSql .= " AND approval_status = 'PENDING'";
		}
		if ($tbl == 'story') {
			$selSql .= " AND status = 'PENDING'";
		}
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $sqlEx->num_rows;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function exp($mission_id, $item)
	{
		$selSql = "INSERT INTO mission_skill (mission_id,skill_id) VALUES ($mission_id,$item)";
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx) {
			$response['Data'] = null;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function updateexp($mission_id, $item, $updated_at)
	{
		$selSql = "UPDATE mission_skill set skill_id=$item, updated_at='$updated_at' where mission_id=$mission_id";
		$sqlEx = $this->connection->query($selSql);
		echo $selSql;
		if ($sqlEx) {
			$response['Data'] = null;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
}
