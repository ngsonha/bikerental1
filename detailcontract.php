<?php
session_start();
include 'config.php';

// Check existence of id parameter before processing further
if(isset($_GET["idhd"]) && !empty(trim($_GET["idhd"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM rentalinfo WHERE idhd = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["idhd"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $namecus = $row["namecus"];
                $address = $row["address"];
                $frontimg = $row["frontimg"];
                $backimg = $row["backimg"];
                $datestart = $row["datestart"];
                $datefinish = $row["datefinish"];
                $note = $row["note"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: 404.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: 404.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Khang Thi's Product Info</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Khang Thi Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>B???ng ??i???u khi???n</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                T???ng quan
            </div>

            <!-- Nav Item - Store Info Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="far fa-user"></i>
                    <span>Th??ng tin c???a h??ng</span>
                </a>
                <div id="collapseInfo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="storeinfo.php">Th??ng tin</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-file-signature"></i>
                    <span>Qu???n l?? h???p ?????ng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="contract.php">Th??ng tin h???p ?????ng</a>
                        <a class="collapse-item" href="contract.php">Ch??a thanh to??n</a>
                        <a class="collapse-item" href="contract.php">???? thanh to??n</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-motorcycle"></i>
                    <span>Qu???n l?? xe</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="product.php">T???t c??? xe</a>
                        <a class="collapse-item" href="productready.php">Xe s???n s??ng</a>
                        <a class="collapse-item" href="productrented.php">Xe ??ang thu??</a>
                        <a class="collapse-item" href="productdeadline.php">Xe t???i h???n tr???</a>
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="term.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>??i???u kho???n d???ch v???</span></a>
            </li>

            <!-- Nav Item - Wallet -->
            <li class="nav-item">
                <a class="nav-link" href="property.php">
                    <i class="fas fa-wallet"></i>
                    <span>T??i s???n c???a h??ng</span></a>
            </li>
            
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="revenue.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Th???ng k?? doanh thu</span></a>
            </li>

            <!-- Nav Item - Support -->
            <li class="nav-item"  style="margin-left: 3px;">
                <a class="nav-link" href="support.php">
                    <i class="fas fa-info-circle"></i>
                    <span>H??? tr???</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->



           

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="T??m ki???m..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler ?? 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun ?? 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez ?? 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog ?? 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION["email"]); ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Th??ng tin
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    C??i ?????t
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Nh???t k?? ho???t ?????ng
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ????ng xu???t
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Th??ng tin chi ti???t v??? h???p ?????ng</h1>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Th??ng tin ??i???u kho???n -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Th??ng tin</h6>
                                </div>
                                
                                <div class="card-body card-body_config">
                                    <div class="card-image-product">
                                        <?php 
                                        echo "<img src='./img/$backimg' style='width:400px; height:400px; border-radius:5px;'>"
                                        ?>
                                    </div>
                                    <div class="card-info-product">
                                        
                                        <div class="card-info-category">
                                            <div class="card-info-item">
                                                <span style="display:inline-block;width:150px;">T??n kh??ch h??ng</span>                                          
                                                <span style="font-weight: bold;"><?php echo $row["namecus"]; ?></span>
                                                <!-- <p>SH 2020 c?? c??ng su???t v?????t tr???i h??n h???n so v???i nh???ng phi??n b???n ti???n nhi???m nh??? 3 y???u t??? ch??nh: ??p d???ng ?????ng c?? 4 van th??? h??? m???i v???i di???n t??ch b??? m???t van ???????c m??? r???ng, c???i thi???n hi???u su???t kh?? n???p v?? kh?? x???; k???t h???p v???i ???? l?? s??? gia t??ng v??? h??? s??? ???????ng k??nh x h??nh tr??nh piston c??ng thi???t k??? tr???c khuy??? m???i, c???i thi???n ????? c???ng v?? ng??n ch???n s??? l???ch do l???c qu??n t??nh v?? n??ng l?????ng ?????t ch??y ???????c t???o ra ??? v??ng tua, d???n ?????n gi???m ti???ng ???n v?? ????? rung nh???m mang l???i c??ng su???t cao cho c??? m??y.</p> -->
                                            </div>
                                            <div class="card-info-item">
                                                <span style="display:inline-block;width:150px;">?????a ch???</span>                                          
                                                <span style="font-weight: bold;"><?php echo $row["address"]; ?></span>
                                                <!-- <p>SH 2020 c?? c??ng su???t v?????t tr???i h??n h???n so v???i nh???ng phi??n b???n ti???n nhi???m nh??? 3 y???u t??? ch??nh: ??p d???ng ?????ng c?? 4 van th??? h??? m???i v???i di???n t??ch b??? m???t van ???????c m??? r???ng, c???i thi???n hi???u su???t kh?? n???p v?? kh?? x???; k???t h???p v???i ???? l?? s??? gia t??ng v??? h??? s??? ???????ng k??nh x h??nh tr??nh piston c??ng thi???t k??? tr???c khuy??? m???i, c???i thi???n ????? c???ng v?? ng??n ch???n s??? l???ch do l???c qu??n t??nh v?? n??ng l?????ng ?????t ch??y ???????c t???o ra ??? v??ng tua, d???n ?????n gi???m ti???ng ???n v?? ????? rung nh???m mang l???i c??ng su???t cao cho c??? m??y.</p> -->
                                            </div>
                                            <div class="card-info-item">
                                                <span style="display:inline-block;width:150px;">Ng??y b???t ?????u thu??</span>                                          
                                                <span style="font-weight: bold;"><?php echo $row["datestart"]; ?></span>
                                                <!-- <p>SH 2020 c?? c??ng su???t v?????t tr???i h??n h???n so v???i nh???ng phi??n b???n ti???n nhi???m nh??? 3 y???u t??? ch??nh: ??p d???ng ?????ng c?? 4 van th??? h??? m???i v???i di???n t??ch b??? m???t van ???????c m??? r???ng, c???i thi???n hi???u su???t kh?? n???p v?? kh?? x???; k???t h???p v???i ???? l?? s??? gia t??ng v??? h??? s??? ???????ng k??nh x h??nh tr??nh piston c??ng thi???t k??? tr???c khuy??? m???i, c???i thi???n ????? c???ng v?? ng??n ch???n s??? l???ch do l???c qu??n t??nh v?? n??ng l?????ng ?????t ch??y ???????c t???o ra ??? v??ng tua, d???n ?????n gi???m ti???ng ???n v?? ????? rung nh???m mang l???i c??ng su???t cao cho c??? m??y.</p> -->
                                            </div>
                                            <div class="card-info-item">
                                                <span style="display:inline-block;width:150px;">Ng??y tr??? xe</span>                                          
                                                <span style="font-weight: bold;"><?php echo $row["datefinish"]; ?></span>
                                            </div>
                                            <div class="card-info-item">
                                                <span style="display:inline-block;width:150px;" >Ghi ch??</span>
                                                <span style="font-weight: bold;" ><?php echo $row["note"]; ?></span>
                                            </div>
                                            <a href="contract.php">
                                                    <button type="button" class="btn btn-secondary">Quay l???i</button>
                                            </a>
                                            <!-- <div class="card-info-item">
                                                <span style="line-height: 38px;margin-right: 14px;">M?? t???</span>
                                                <span style="margin-left: 54px;line-height:37.27px;font-weight: bold;"><?php echo $row["description"]; ?></span>
                                            </div> -->
                                            <!-- <div class="card-info-btn">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Thanh to??n</button>
                                                <form action="rentproduct.php" method="post" enctype="multipart/form-data"  class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLongTitle">Th??ng tin kh??ch h??ng thu?? "<?php echo $row["namecus"]; ?>"</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class="card-body_item">
                                                                <label for="">Nh???p t??n kh??ch h??ng<sup>*</sup></label>
                                                                <input class="card-body_input" type="text" id="namecus" name="namecus" required>
                                                            </div>
                                                            <div class="card-body_item">
                                                                <label for="">?????a ch???<sup>*</sup></label>
                                                                <input class="card-body_input" type="text" id="address" name="address" required>
                                                            </div>
                                                            <div class="card-body_item">
                                                                <label for="">Ng??y thu?? xe<sup>*</sup></label>
                                                                <input class="card-body_input" type="date" id="datestart" name="datestart" required>
                                                            </div>
                                                            <div class="card-body_item">
                                                                <label for="">Ng??y tr??? xe<sup>*</sup></label>
                                                                <input class="card-body_input" type="date" id="datefinish" name="datefinish" required>
                                                            </div>
                                                            <div class="card-body_item">
                                                                <label for="">CMND m???t tr?????c<sup>*</sup></label>
                                                                <input class="card-body_input" type="file" id="frontimg" name="frontimg" required>
                                                            </div>
                                                            <div class="card-body_item">
                                                                <label for="">CMND m???t sau<sup>*</sup></label>
                                                                <input class="card-body_input" type="file" id="backimg" name="backimg" required>
                                                            </div>
                                                            <div class="card-body_item payment">
                                                                <label for="">H??nh th???c thanh to??n<sup>*</sup></label>
                                                                <select name="payment" id="select_item-bank">
                                                                    <option value="Thanh to??n tr???c tuy???n">Thanh to??n tr???c tuy???n</option>
                                                                    <option value="Thanh to??n tr???c ti???p">Thanh to??n tr???c ti???p</option>
                                                                </select>
                                                            </div>
                                                            <div class="card-body_item">
                                                                <label for="">Ghi ch??<sup>*</sup></label>
                                                                <input style="margin-left:1px" class="card-body_input" type="text" id="note" name="note" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">????ng</button>
                                                          <button type="submit" id="submit" name="submit" class="btn btn-primary">X??c nh???n</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </form>
                                                  <a href="contract.php">
                                                    <button type="button" class="btn btn-secondary">Quay l???i</button>
                                                </a>
                                            </div> -->
                                            
                                        </div>
                                    </div>
                                    <!-- <ul class="card-body-list">              
                                    </ul> -->
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
                        <span>B???n quy???n &copy; Khang Th??? Company</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>