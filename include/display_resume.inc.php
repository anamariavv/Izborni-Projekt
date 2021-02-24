<?php

    require_once "include/database_connect.inc.php";

    $sql = 'SELECT * FROM resume INNER JOIN student ON (student.oib = resume.id) WHERE id = "' . $_SESSION['oib'] . '"';
    $sql_education = 'SELECT * FROM resume_education INNER JOIN education ON (education.id = education_id) WHERE resume_id = "'.$_SESSION['oib'].'" GROUP BY education_id, resume_id';
    $sql_work = 'SELECT * FROM work_experience WHERE resume_id = "'.$_SESSION['oib'].'"';
    $sql_skill = 'SELECT * FROM resume_skill INNER JOIN skill ON (skill.id = skill_id) WHERE resume_id ="'.$_SESSION['oib'] .'" GROUP BY skill_id, resume_id';
    $sql_language = 'SELECT * FROM resume_language INNER JOIN language ON (language.id = language_id) WHERE resume_id = "'.$_SESSION['oib'].'" GROUP BY language_id, resume_id';
    $sql_keyword = 'SELECT * FROM resume_keyword INNER JOIN keyword ON (keyword.id = keyword_id) WHERE resume_keyword.resume_id = "'.$_SESSION['oib'].'" GROUP BY keyword_id, resume_keyword.resume_id';

    //resume and student inffo result
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //education result
    $result_education = $conn->query($sql_education);
    $array_education = $result_education->fetch_all(MYSQLI_ASSOC);

    //work experience result
    $result_work = $conn->query($sql_work);
    $array_work = $result_work->fetch_all(MYSQLI_ASSOC);

    //skill result
    $result_skill = $conn->query($sql_skill);
    $array_skill = $result_skill->fetch_all(MYSQLI_ASSOC);

    //language result
    $result_language = $conn->query($sql_language);
    $array_language = $result_language->fetch_all(MYSQLI_ASSOC);

    //keyword result
    $result_keyword = $conn->query($sql_keyword);
    $array_keyword = $result_keyword->fetch_all(MYSQLI_ASSOC);