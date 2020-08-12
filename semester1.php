<?php include"inc/header.php";?>
<?php 
    $db = new database();
    $fm = new Formate();
?>

<body>
    <!--navigation-->
    <section id="nav">
        <nav class="navbar   navbar-dark bg-dark navbar-expand-md" uk-sticky="top: 100; animation: uk-animation-slide-top; bottom: #sticky-on-scroll-up">
            <div class="container">
                <a class="navbar-brand text-light" href="index.php">
                    <img src="img/book.jpg" width="50" height="40" class="d-inline-block align-top" alt="" loading="lazy">
                    Book_Exchange
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="about.php">About us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Semester
                            </a>
                            <div class="dropdown-menu bg-dark " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-danger" href="semester1.php">Semester 01</a>
                                <a class="dropdown-item text-danger" href="semester2.php">Semester 02</a>
                                <a class="dropdown-item text-danger" href="semester2.php">Semester 03</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="else.php">Else</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sell.php">Sell</a>
                        </li>
                    <?php 
					$sql  = "select * from tbl_page where name='DMCA'";
					$page = $db->select($sql);
					if($page)
					{
						foreach($page as $result)
						{
					?>
					<li class="nav-item">
                            <a class="nav-link" href="dmca.php"><?php echo $result['name'];?></a>
                    </li>
					<?php	
						} }
					?>
                    </ul>
                    <form class="form-inline my-2 ml-2 my-lg-0" action="search.php" method="get">
                        <input class="form-control mr-sm-2" type="search" name="book" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary text-light my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </section>
    <!--Main-->
    <?php
    $per_page = 6;
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    $start_from = ($page-1)*$per_page;
    ?>
    <section id="semester">
        <div class="container">
            <div class="row my-3">
                <?php
                $sql = "select * from sell where status = '0' and semester='1' limit $start_from,$per_page";
                $show_book = $db->select($sql);
                if($show_book)
                {
                    foreach($show_book as $result)
                    {
                        
            ?>
                <div class="col-md-4 mb-sm-2">
                    <div class="card uk-animation-scale-up">
                        <div class="card-img image">
                        <?php 
						if($result['mail']=='AdminPost')
						{
						?>
					        <img src="admin/<?php echo $result['image']; ?>"   alt="book">
					    <?php
						}else {
						?>
                        <?php
						?>
							<img src="<?php echo $result['image']; ?>"   alt="book">
 						<?php } ?>
                        </div>
                        <div class="card-header">
                            <h2 class="text-center">Available</h2>
                        </div>
                        <div class="card-body">
                            Course: <?php echo $result['course'];?>
                            <br>
                            Writer: <?php echo $result['writer'];?>
                            <br>
                            Edition:<?php echo $result['edition'];?>
                            <br>
                            Semester:<?php echo $result['semester'];?>
                            <br>
                            price: <?php echo $result['price'];?>
                            <br>
                            <a href="order.php?id=<?php echo $result['id'];?>"><button class="btn btn-outline-danger  mt-2" type="submit">Order</button></a>
                        </div>
                    </div>
                </div>
                <?php } } else { header("location:404.php"); }?>
            </div>
        </div>
    </section>
    <!-- Pagination-->
    <section id="pagination">
        <?php
        $sql = "select * from sell where status = '0'";
        $pagination = $db->select($sql);
        if($pagination)
        {
            $total_row = mysqli_num_rows($pagination);
            $total_pages = ceil($total_row/$per_page);
            
    ?>
        <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="semester1.php?page=0" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php 
            for($i = 1 ; $i<=$total_pages ; $i++)
            {
                
            ?>
                <li class="page-item"><a class="page-link" href="semester1.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                <?php } } ?>
                <li class="page-item">
                    <a class="page-link" href="semester1.php?page=<?php echo $total_pages;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
    <!--Footer-->
    <?php include "inc/footer.php"?>
