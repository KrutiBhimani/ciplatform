<?php
require_once('Config/db.php');
class loginModel extends Model
{
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
			$response['Message'] = 'Data inserted successfully.' . $sql;
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Data insertion failed.' . $sql;
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
	function GetStory()
	{
		$resetSql = "SELECT max(story_id) as max FROM story";
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
	function DraftStory($user_id)
	{
		$hoursql = "SELECT * FROM `story` WHERE user_id = $user_id AND status = 'DRAFT'";
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
	function AppliedMissions1($user_id)
	{
		$selSql = "SELECT * FROM `mission_application` WHERE user_id = $user_id AND approval_status = 'APPROVE'";
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
	function timesheethour($user_id)
	{
		$selSql = "SELECT * FROM `timesheet` 
		JOin mission on mission.mission_id = timesheet.mission_id
		WHERE timesheet.action is null AND timesheet.deleted_at is null AND timesheet.user_id = $user_id";
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
	function timesheetgoal($user_id)
	{
		$selSql = "SELECT * FROM `timesheet` 
		JOin mission on mission.mission_id = timesheet.mission_id
		WHERE timesheet.action != 'NULL' AND timesheet.deleted_at is null AND timesheet.user_id = $user_id";
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
	function Story(int $postno = 0, int $pagecount = 0)
	{
		$selSql = "SELECT *,story.title as story_title,story.description as sdescription FROM `story`
		JOIN user on user.user_id = story.user_id
		JOIN mission on mission.mission_id = story.mission_id
		JOIN mission_theme on mission.theme_id = mission_theme.mission_theme_id
		JOIN story_media on story_media.story_id = story.story_id
		WHERE story.status = 'PUBLISHED'
		GROUP BY story.story_id";
		if ($postno > 0 || $pagecount > 0) {
			$selSql .= " LIMIT $postno,$pagecount";
		}
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
	function Storys($story_id)
	{
		$selSql = "SELECT *,story.title as story_title,story.description as sdescription FROM `story`
		JOIN user on user.user_id = story.user_id
		JOIN mission on mission.mission_id = story.mission_id
		JOIN mission_theme on mission.theme_id = mission_theme.mission_theme_id
		JOIN story_media on story_media.story_id = story.story_id
		WHERE story.story_id = $story_id
		GROUP BY story.story_id";
		$sqlEx = $this->connection->query($selSql);
		$allData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
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
		if ($tblName == 'mission_media') {
			$selSql .= " AND mission_media_id>=47";
		}
		if ($tblName == 'story_media') {
			$selSql .= " AND story_media_id>=10";
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
	function SelectApply2(string $tblName, array $where = [])
	{
		$selSql = "SELECT * FROM $tblName";
		if (!empty($where)) {
			$selSql .= " WHERE (";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' AND";
			}
			$selSql = rtrim($selSql, 'AND');
			$selSql .= ") AND deleted_at is NULL";
		} else if (empty($where)) {
			$selSql .= " WHERE deleted_at is NULL";
		}
		if ($tblName == 'mission_application') {
			$selSql .= " AND (approval_status LIKE 'APPROVE' OR approval_status LIKE 'PENDING')";
		}
		$sqlEx = $this->connection->query($selSql);
		$allData = $sqlEx->fetch_object();
		if ($sqlEx->num_rows > 0) {
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.' . $selSql;
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;
	}
	function SelectComment($mission_id)
	{
		$selSql = "SELECT *,comment.created_at as comment_date FROM comment 
		Join user on user.user_id = comment.user_id
		WHERE comment.mission_id = $mission_id AND comment.deleted_at is NULL AND approval_status LIKE 'PUBLISHED' ORDER BY comment.comment_id DESC";
		$sqlEx = $this->connection->query($selSql);
		if ($sqlEx->num_rows > 0) {
			while ($FetchData = $sqlEx->fetch_object()) {
				$allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Row'] = $sqlEx->num_rows;
			$response['Message'] = 'Data retrieved successfully.' . $selSql;
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Row'] = 0;
			$response['Message'] = 'Data not retrieved.' . $selSql;
		}
		return $response;
	}
	function SelectSkill($mission_id)
	{
		$selSql = "SELECT * FROM mission_skill 
		Join skill on skill.skill_id = mission_skill.skill_id
        Where mission_id = $mission_id";
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
	function Selectrateduser($mission_id)
	{
		$selSql = "SELECT *,COUNT(mission_id) as count FROM `mission_rating` 
		WHERE mission_id = $mission_id
		GROUP By mission_id";
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
	function Selectvols($mission_id)
	{
		$selSql = "SELECT * FROM `mission_application` 
		JOIN user on user.user_id = mission_application.user_id
		WHERE mission_id = $mission_id AND approval_status = 'APPROVE'";
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
	function SelectData12(string $tblName, array $where = [])
	{
		$selSql = "SELECT * FROM $tblName";
		if (!empty($where)) {
			$selSql .= " WHERE ";
			foreach ($where as $key => $value) {
				$selSql .= " $key = '$value'";
			}
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
	function SelectedSkill(string $tblName, array $where = [])
	{
		$selSql = "SELECT * FROM $tblName join skill on skill.skill_id = user_skill.skill_id";
		if (!empty($where)) {
			$selSql .= " WHERE ";
			foreach ($where as $key => $value) {
				$selSql .= " $key = '$value'";
			}
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
	function StoryMedia($story_id)
	{
		$selSql = "SELECT * FROM `story_media` WHERE story_id = $story_id";
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
	function SelectData3($postno, $pagecount, $order, $user_id = 0, array $where = [], $int = '', array $country = [], array $city = [], array $theme = [], array $skill = [])
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
        LEFT JOIN mission_rating on mission_rating.mission_id = mission.mission_id
		LEFT JOIN mission_skill on mission_skill.mission_id = mission.mission_id
		LEFT JOIN skill on skill.skill_id = mission_skill.skill_id";
		if ($order == 'Sort by my favourite') {
			$selSql .= " INNER JOIN favourite_mission on favourite_mission.mission_id = mission.mission_id Where favourite_mission.user_id = $user_id AND favourite_mission.deleted_at is null";
		}
		if ($int != null) {
			if (!empty($country) || !empty($city) || !empty($theme) || !empty($skill) || !empty($where) || !empty($order)) {
				if ((!empty($country) || !empty($city) || !empty($theme) || !empty($skill) || !empty($where)) && $order != 'Sort by my favourite') {
					$selSql .= " WHERE ( ";
				}
				if ($order == 'Sort by my favourite') {
					$selSql .= " AND ";
				}
				if (!empty($theme)) {
					$selSql .= " (";
					foreach ($theme as $key => $value) {
						$selSql .= " mission_theme.title LIKE '%$value%' OR";
					}
					$selSql = rtrim($selSql, 'OR');
					$selSql .= ") ";
				}
				if (!empty($theme) && !empty($city)) {
					$selSql .= " AND";
				}
				if (!empty($city)) {
					$selSql .= " (";
					foreach ($city as $key => $value) {
						$selSql .= " city.name LIKE '%$value%' OR";
					}
					$selSql = rtrim($selSql, 'OR');
					$selSql .= ") ";
				}
				if ((!empty($theme) || !empty($city)) && !empty($skill)) {
					$selSql .= " AND";
				}
				if (!empty($skill)) {
					$selSql .= " (";
					foreach ($skill as $key => $value) {
						$selSql .= " skill.skill_name LIKE '%$value%' OR";
					}
					$selSql = rtrim($selSql, 'OR');
					$selSql .= ") ";
				}
				if ((!empty($theme) || !empty($city) || !empty($skill)) && !empty($country)) {
					$selSql .= " AND";
				}
				if (!empty($country)) {
					$selSql .= " (";
					foreach ($country as $key => $value) {
						$selSql .= " $key LIKE '%$value%' )";
					}
				}
				if ((!empty($theme) || !empty($city) || !empty($skill) || !empty($country)) && !empty($where)) {
					$selSql .= " AND";
				}
				if (!empty($where)) {
					$selSql .= " (";
					foreach ($where as $key => $value) {
						$selSql .= " $key LIKE '%$value%' OR";
					}
					$selSql = rtrim($selSql, 'OR');
					$selSql .= ") ";
				}
				if ((!empty($country) || !empty($city) || !empty($theme) || !empty($skill) || !empty($where)) && $order != 'Sort by my favourite') {
					$selSql .= " )";
				}
				$selSql .= " GROUP By mission.mission_id";
				if (!empty($order)) {
					if ($order == 'Newest') {
						$selSql .= " ORDER BY mission.mission_id DESC ";
					}
					if ($order == 'Oldest') {
						$selSql .= " ORDER BY mission.mission_id ASC ";
					}
					if ($order == 'sort by deadline') {
						$selSql .= " ORDER BY time_mission.deadline ASC ";
					}
					if ($order == 'Lowest available seats') {
						$selSql .= " ORDER BY seatcount ASC ";
					}
					if ($order == 'Highest available seats') {
						$selSql .= " ORDER BY seatcount DESC ";
					}
				}
			} else {
				$selSql .= " GROUP By mission.mission_id";
			}
		} else {
			$selSql .= " GROUP By mission.mission_id";
		}
		if ($postno > 0 || $pagecount > 0) {
			$selSql .= " LIMIT $postno,$pagecount";
		}
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
	function SelectData34(array $where = [], $mission_id)
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
        LEFT JOIN mission_rating on mission_rating.mission_id = mission.mission_id
		LEFT JOIN mission_skill on mission_skill.mission_id = mission.mission_id
		LEFT JOIN skill on skill.skill_id = mission_skill.skill_id";
		if (!empty($where)) {
			$selSql .= " WHERE (";
			foreach ($where as $key => $value) {
				$selSql .= " $key LIKE '%$value%' AND mission.mission_id != $mission_id";
			}
			$selSql = rtrim($selSql, 'OR');
			$selSql .= ") ";
		}
		$selSql .= " GROUP By mission.mission_id";
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
	function SelectData5(string $tblName)
	{
		$selSql = "SELECT * from mission";
		if ($tblName == 'city') {
			$selSql .= " LEFT JOIN city on city.city_id = mission.city_id GROUP By city.city_id ";
		}
		if ($tblName == 'country') {
			$selSql .= " LEFT JOIN country on country.country_id = mission.country_id GROUP By country.country_id";
		}
		if ($tblName == 'mission_theme') {
			$selSql .= " LEFT JOIN mission_theme on mission_theme.mission_theme_id = mission.theme_id GROUP By mission_theme.mission_theme_id ";
		}
		if ($tblName == 'skill') {
			$selSql .= " LEFT JOIN mission_skill on mission_skill.mission_id = mission.mission_id LEFT JOIN skill on skill.skill_id = mission_skill.skill_id GROUP By skill.skill_id ";
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
	function UpdateData1($tbl, $data, array $where = [])
	{
		$sql = "UPDATE $tbl SET ";
		foreach ($data as $key => $value) {
			$sql .= "$key = '$value',";
		}
		$sql = rtrim($sql, ',');
		if (!empty($where)) {
			$sql .= " WHERE ( ";
			foreach ($where as $key => $value) {
				$sql .= " $key = '$value' AND";
			}
			$sql = rtrim($sql, 'AND');
			$sql .= " ) ";
		}
		$sql = str_replace("''", "NULL", $sql);
		$updEx = $this->connection->query($sql);
		if ($updEx) {
			$response['Data'] = null;
			$response['Code'] = true;
			$response['Message'] = 'your password is updated' . $sql;
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'not updated' . $sql;
		}
		return $response;
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
	function DeleteData2($tbl, $delete_user_id, $type)
	{
		$sql = "DELETE FROM $tbl WHERE story_id = $delete_user_id AND type ";
		if ($type == 'video') {
			$sql .= " = 'video'";
		} else {
			$sql .= " != 'video'";
		}
		return $updEx = $this->connection->query($sql);
	}
	function DeleteData3($tbl, $mission_id)
	{
		$sql = "DELETE FROM $tbl WHERE mission_id = $mission_id ";
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
	function exp1($user_id, $item)
	{
		$selSql = "INSERT INTO user_skill (user_id,skill_id) VALUES ($user_id,$item)";
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
