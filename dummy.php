<?php

	$servername = "localhost";
	$username = "root";
	$password = "12345";
	$dbname = "dbelprowin";

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$i = 1;
	while($i < 17){
		$sql = "INSERT INTO hasil_belajar (nama, materi, classdir, labdir) VALUES ('213',".$i.", 'tugas', 'tugas')";

		if ($conn->query($sql) === TRUE) {
		    $last_id = $conn->insert_id;

		    $sql2 = "INSERT INTO rapor (hasil, detail_nilai, nclass, nlab, kclass, klab ) VALUES (".$last_id.", '..', 80, 80, 'L', 'L')";
		    if ($conn->query($sql2) === TRUE) {
		    	echo "Data Dummy sudah masuk";
		    }
		    else
		    {

    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		    }
		}
		else
		{

    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);	
		}
		$i++;
	}
?>