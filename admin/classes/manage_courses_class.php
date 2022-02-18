<?php

class manage_courses_class
{
	public $course_list;

	public function display_courses()
	{
		include("../inc/connect.php");
		$query = $con->prepare("select * from programming_languages");
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$query->execute();

		while ($row = $query->fetch()) {
			$this->course_list[] = $row;
		}
		return $this->course_list;
	}
}
