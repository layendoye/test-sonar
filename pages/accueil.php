<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>  
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <div class='row diagCircl'>
            <div class='col-1'></div>
            <div class='col-4'>
                <div class="c100 p50 dark big orange">
                    <span>50%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
            <div class='col-4'>
                <div class="c100 p50 dark big orange">
                    <span>50%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
            <div class='col-3'>
                <div class="c100 p50 dark big orange">
                    <span>50%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php require("footer.php");?>