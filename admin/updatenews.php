<?php
                    if (isset($_POST['submit'])) {
                        $connect = mysqli_connect("localhost", "root", "", "newspaper");
                        if (!$connect) {
                            die("database failed" . mysqli_connect_error());
                        }
                        $permited = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_tmp = $_FILES['image']['tmp_name'];
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                        $uploaded_image = "uploads/" . $unique_image;
                        move_uploaded_file($file_tmp, $uploaded_image);
                        $title = $_POST["title"];
//$date = $_POST["date"];
                        $image = $_FILES['image']['name'];
                        $details = $_POST["details"];
                        $category_id = $_POST["category_id"];
						 $currentID = $_GET['id'];
                        $query = "Update  news Set title = '$title', image = '$uploaded_image',details = '$details', category_id = '$category_id'
						 Where news_id = '$currentID ' ";
                    }
                    $result = mysqli_query($connect, $query);
                    if (!$result) {
                        echo "Query Failed" . mysqli_connect_errno();
                    } else {
                        $_SESSION["message"] = "<h3 class='text-success'>News Upadte Successfully</h3>";                    
						header("location: news.php");
                    }
                    ?>